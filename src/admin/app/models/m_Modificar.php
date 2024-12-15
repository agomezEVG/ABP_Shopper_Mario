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
            if (isset($dato['deletedImages[]'])) {
          
                $deletedImages = $dato['deletedImages[]'];
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


           return $modificado;

        } catch (Throwable $th) {
            error_log('Excepción durante la modificación: ' . $th->getMessage());
            return false;
        }
    }
}
