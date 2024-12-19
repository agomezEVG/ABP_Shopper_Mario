<?php 

class M_Dialogos{


  private $conexion ;

  public function __construct()
  {
    require_once 'app/config/configDb.php';

    $this->conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,BBDD);
            
    if ($this->conexion->connect_error) {
        error_log('Error de conexión: ' . $this->conexion->connect_error);
        throw new Exception('No se pudo conectar a la base de datos.');
    }
    $this->conexion->set_charset("utf8");
  }


  public function obtenerDialogos() {
    try {

      $sql = 'SELECT * FROM dialogo;';
      $resultado = $this->conexion->query($sql);

      if (!$resultado) {
          throw new Exception("Error en la consulta: " . $this->conexion->error);
      }
      $datos = $resultado->fetch_all(MYSQLI_ASSOC);

      return $datos;

    } catch (Throwable $th) {

      error_log($th->getMessage());
    }

  }

  public function __destruct(){

    $this->conexion->close();
  }
}
