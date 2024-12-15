<?php 

class M_Modificar {

    private $conexion;

    public function __construct() {
        require_once 'app/config/configDb.php';
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
        
        if ($this->conexion->connect_error) {
            error_log('Error de conexión: ' . $this->conexion->connect_error);
            throw new Exception('No se pudo conectar a la base de datos.');
        }

        $this->conexion->set_charset("utf8");
    }

    public function consultaModificacion($dato) {
        $modificado = false;

        try {
            // Paso 1: Actualizar los datos del personaje
            if (isset($dato['nombre']) || isset($dato['descripcion']) || isset($dato['tipo'])) {
                $sqlUpdate = "UPDATE personaje SET nombre = ?, descripcion = ?, tipo = ? WHERE idPersonaje = ?";
                $stmt = $this->conexion->prepare($sqlUpdate);
                
                if ($stmt === false) {
                    error_log('Error en la preparación de la consulta SQL: ' . $this->conexion->error);
                    return false;
                }

                $stmt->bind_param("sssi", $dato['nombre'], $dato['descripcion'], $dato['tipo'], $dato['idPersonaje']);
                $executeResult = $stmt->execute();
                if (!$executeResult) {
                    error_log('Error al ejecutar la consulta SQL para actualizar: ' . $stmt->error);
                    return false;
                }
                $stmt->close();
            }

            // Paso 2: Eliminar las imágenes marcadas para eliminación
            if (isset($dato['deletedImages'])) {
                $deletedImages = $dato['deletedImages'];
                foreach ($deletedImages as $image) {
                    $sqlDelete = "DELETE FROM imagen WHERE idPersonaje = ? AND url = ?";
                    $stmt = $this->conexion->prepare($sqlDelete);
                    if ($stmt === false) {
                        error_log('Error en la preparación de la consulta SQL para eliminar imagen: ' . $this->conexion->error);
                        return false;
                    }

                    $stmt->bind_param("is", $dato['idPersonaje'], $image);
                    $executeResult = $stmt->execute();
                    if (!$executeResult) {
                        error_log('Error al ejecutar la consulta SQL para eliminar imagen: ' . $stmt->error);
                        return false;
                    }
                    $stmt->close();
                }
                $modificado = true;
            }

            // Paso 3: Subir las nuevas imágenes
           if (isset($dato['newImages']) && count($dato['newImages']) > 0) {
    foreach ($dato['newImages'] as $imageName) {
        if (!empty($imageName)) {
            // Aquí puedes insertar las nuevas imágenes en la base de datos
            $sqlInsert = "INSERT INTO imagen (idPersonaje, url) VALUES (?, ?)";
            $stmt = $this->conexion->prepare($sqlInsert);
            if ($stmt === false) {
                error_log('Error en la preparación de la consulta SQL para insertar imagen: ' . $this->conexion->error);
                return false;
            }
            
            $stmt->bind_param("is", $dato['idPersonaje'], $imageName);
            $executeResult = $stmt->execute();
            if (!$executeResult) {
                error_log('Error al ejecutar la consulta SQL para insertar imagen: ' . $stmt->error);
                return false;
            }
            $stmt->close();
        } else {
            // Si el nombre de la imagen es vacío, loguear un error
            error_log('Nombre de imagen vacio, no se puede insertar');
            return false;
        }
    }
    $modificado = true;
} 
            return $modificado;

        } catch (Throwable $th) {
            error_log('Excepcion: ' . $th->getMessage());
            return false;
        }
    }
}
