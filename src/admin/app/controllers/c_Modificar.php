<?php 

Class C_Modificar{

  public function  __construct()
  {
    require_once './app/models/m_Modificar.php';

  }

  public function modificar($dato){

    $obj = new M_Modificar();

    if($obj->consultaModificacion($dato)){
      echo json_encode(['success' => '1', "mensaje" => 'modificación ejecutada correctamente']);
    }else{

      echo json_encode(['success' => '0', "mensaje" => 'error en la modificacion']);
    }
    }

}
