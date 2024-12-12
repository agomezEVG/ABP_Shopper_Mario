<?php

    Class M_listarTipos{

        private $conexion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR2,USUARIO2,PASSWORD2,BBDD2);
            $this->conexion->set_charset("utf8");
            
        }

        public function tipos() {

          $datos = [];
          
          $queryTipos = 'SELECT tipo, nombre FROM tipos_personaje;' ;
          $result = $this->conexion->query($queryTipos);
          $datos = $result->fetch_all(MYSQLI_ASSOC);

          return $datos;

        }
}
