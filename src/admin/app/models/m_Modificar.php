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
        if (isset($dato['nombre']) || isset($dato['descripcion']) || isset($dato['tipo'])) {
            $sqlUpdate = "UPDATE personaje SET nombre = ?, descripcion = ?, tipo = ? WHERE idPersonaje = ?";
            $stmt = $this->conexion->prepare($sqlUpdate);
            
            if ($stmt === false) {
                throw new Exception('Error al preparar la consulta SQL: ' . $this->conexion->error);
            }

            $stmt->bind_param("sssi", $dato['nombre'], $dato['descripcion'], $dato['tipo'], $dato['idPersonaje']);
            if (!$stmt->execute()) {
                throw new Exception('Error al ejecutar la consulta SQL de actualización: ' . $stmt->error);
            }
            $stmt->close();
            $modificado = true;
        }

        if (isset($dato['deletedImages']) && !empty($dato['deletedImages'])) {
            $sqlDelete = "DELETE FROM imagen WHERE idPersonaje = ? AND nombreArchivo = ?";
            $stmt = $this->conexion->prepare($sqlDelete);

            if ($stmt === false) {
                throw new Exception('Error al preparar la consulta SQL para eliminar imagen: ' . $this->conexion->error);
            }

            foreach ($dato['deletedImages'] as $image) {
                $stmt->bind_param("is", $dato['idPersonaje'], $image);
                if (!$stmt->execute()) {
                    throw new Exception('Error al ejecutar la consulta SQL para eliminar imagen: ' . $stmt->error);
                }
            }
            $stmt->close();
            $modificado = true;
        }

        if (isset($dato['newImages']) && !empty($dato['newImages'])) {
            $sqlInsert = "INSERT INTO imagen (idPersonaje, nombreArchivo) VALUES (?, ?)";
            $stmt = $this->conexion->prepare($sqlInsert);

            if ($stmt === false) {
                throw new Exception('Error al preparar la consulta SQL para insertar imagen: ' . $this->conexion->error);
            }

            foreach ($dato['newImages'] as $imageName) {
                if (!empty($imageName)) {
                    $stmt->bind_param("is", $dato['idPersonaje'], $imageName);
                    if (!$stmt->execute()) {
                        throw new Exception('Error al ejecutar la consulta SQL para insertar imagen: ' . $stmt->error);
                    }
                } else {
                    throw new Exception('El nombre de la imagen está vacío y no se puede insertar.');
                }
            }
            $stmt->close();
            $modificado = true;
        }

        return $modificado;

    } catch (Throwable $th) {
        // Loguear cualquier excepción
        error_log('Excepción: ' . $th->getMessage());
        return false;
    }
} 

    public function consultaEliminar($id){
      if (isset($id) && !empty($id)) {
        $sqlDelete = "DELETE FROM personaje WHERE idPersonaje = ?";
        
        $stmt = $this->conexion->prepare($sqlDelete);
        
        if ($stmt === false) {
            error_log('Error al preparar la consulta SQL: ' . $this->conexion->error);
            return false;
        }
        
        $stmt->bind_param("i", $id['idPersonaje']); 
        
        $executeResult = $stmt->execute();
        
        if (!$executeResult) {
            error_log('Error al ejecutar la consulta SQL: ' . $stmt->error);
            return false;
        }
        
        $stmt->close();
        
        return true;
    } else {
        error_log('El idPersonaje no está definido o es vacío.');
        return false;
    }
    }


/* Isa al final le añadí begin transaction porque no tiene sentido que se pueda insertar una imagen sin personaje asociado,
 */
public function consultaInsertar($dato) {
    if (isset($dato['nombre']) && !empty($dato['nombre']) && isset($dato['descripcion']) && !empty($dato['descripcion'])) {
        
        $this->conexion->begin_transaction();

        try {
            // Insertar en la tabla personaje
            $sqlInsert = "INSERT INTO personaje (nombre, descripcion, tipo) VALUES (?, ?, ?)";
            $stmt = $this->conexion->prepare($sqlInsert);

            if ($stmt === false) {
                throw new Exception('Error al preparar la consulta SQL: ' . $this->conexion->error);
            }

            $stmt->bind_param("sss", $dato['nombre'], $dato['descripcion'], $dato['tipo']);

            if (!$stmt->execute()) {
                throw new Exception('Error al ejecutar la consulta SQL de personaje: ' . $stmt->error);
            }

            // Obtener el ID del personaje recién insertado
            $idPersonaje = $this->conexion->insert_id;

            if ($idPersonaje <= 0) {
                throw new Exception('No se pudo obtener el ID del personaje insertado.');
            }

            // Insertar las imágenes asociadas, si existen
            if (isset($dato['newImages']) && !empty($dato['newImages'])) {
                $sqlInsertImages = "INSERT INTO imagen (idPersonaje, nombreArchivo) VALUES (?, ?)";
                $stmtImage = $this->conexion->prepare($sqlInsertImages);

                if ($stmtImage === false) {
                    throw new Exception('Error al preparar la consulta SQL para imágenes: ' . $this->conexion->error);
                }

                // Iterar sobre las imágenes y guardarlas en la base de datos
                foreach ($dato['newImages'] as $imageUrl) {
                    $stmtImage->bind_param("is", $idPersonaje, $imageUrl); // 'i' para el ID del personaje, 's' para la URL
                    
                    if (!$stmtImage->execute()) {
                        throw new Exception('Error al insertar la imagen: ' . $stmtImage->error);
                    }
                }

                $stmtImage->close();
            }

            // Confirmar la transacción si todo ha ido bien
            $this->conexion->commit();

            // Cerrar el stmt de personaje
            $stmt->close();

            return true;

        } catch (Exception $e) {
            // En caso de error, revertir la transacción
            $this->conexion->rollback();
            error_log($e->getMessage());
            return false;
        }
    } else {
        error_log('Los datos necesarios no están completos.');
        return false;
    }
}}
