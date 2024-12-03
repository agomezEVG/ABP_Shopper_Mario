<?php

    Class M_InicioSesion {

        private $objMInicioSesion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
            $this->conexion->set_charset("utf8");
            // $controlador = new mysqli_driver();
            // $controlador->report_mode = MYSQLI_REPORT_OFF;
            $texto_error=$this->conexion->errno;
        }

        public function comprobar() {
            
            $sql = 'SELECT * FROM administrador WHERE correo = '..';';

        }
    }
?>