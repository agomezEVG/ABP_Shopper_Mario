<?php 

Class C_Entidades{

  public function  __construct()
  {
    require_once './app/models/m_panelAdmin.php';
    
  }

public function listarTipos($dato){
      header('Content-Type: application/json');
      echo json_encode($dato);

  }

}
