<?php

    Class M_dashboard{

        private $conexion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR2,USUARIO2,PASSWORD2,BBDD2);
            $this->conexion->set_charset("utf8");
            
        }

        public function datosAdmin() {
             return 'Hola a todos vengo de viaje';
        }

        
    }
