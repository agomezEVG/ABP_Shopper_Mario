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

            // Paso 3: Insertar las nuevas imágenes
           if (isset($_FILES['newImages'])) {
              // Si existen archivos en 'newImages'
             $newImages = $_FILES['newImages'];

              // Itera sobre los archivos si hay más de uno
              foreach ($newImages['name'] as $key => $imageName) {
                  $imageTmpName = $newImages['tmp_name'][$key];  // Nombre temporal del archivo
                  $imageSize = $newImages['size'][$key];  // Tamaño del archivo
                  $imageType = $newImages['type'][$key];  // Tipo MIME del archivo

                  // Define el directorio de destino para las imágenes
                  $targetDir = "/shopperMario/src/admin/img";  
                  $targetFile = $targetDir . basename($imageName);  // Ruta completa del archivo a subir

                  // Verificar si el archivo es una imagen (por ejemplo, tipo 'image/png', 'image/jpeg', etc.)
                  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                  // Verificar si el archivo es una imagen
                  $validImageTypes = ['jpg', 'jpeg', 'png', 'gif'];  // Tipos de imágenes permitidos
                  if (in_array($imageFileType, $validImageTypes)) {
                      // Verificar si el archivo ya existe
                      if (!file_exists($targetFile)) {
                          // Mover el archivo a la carpeta de destino
                          if (move_uploaded_file($imageTmpName, $targetFile)) {
                              // Insertar solo el nombre del archivo en la base de datos
                              $sqlInsert = "INSERT INTO imagen (idPersonaje, url) VALUES (?, ?)";
                              $stmt = $this->conexion->prepare($sqlInsert);

                              if ($stmt === false) {
                                  error_log('Error en la preparación de la consulta SQL para insertar imagen: ' . $this->conexion->error);
                                  return false;
                              }

                              // Insertar solo el nombre del archivo (sin la ruta completa)
                              $stmt->bind_param("is", $dato['idPersonaje'], basename($targetFile));
                              $executeResult = $stmt->execute();
                              if (!$executeResult) {
                                  error_log('Error al ejecutar la consulta SQL para insertar imagen: ' . $stmt->error);
                                  return false;
                              }

                              $stmt->close();
                          } else {
                              error_log('Error al mover la imagen ' . $imageName);
                              return false;
                          }
                      } else {
                          error_log('La imagen ' . $imageName . ' ya existe.');
                          return false;
                      }
                  } else {
                      error_log('El archivo ' . $imageName . ' no es una imagen válida.');
                      return false;
                  }
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
