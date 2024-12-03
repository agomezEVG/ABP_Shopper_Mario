<?php

    Class C_InicioSesion {

        private $objMInicioSesion;

        public function __construct() {
            require_once 'app/models/m_InicioSesion.php';
            $this->objMInicioSesion = new M_InicioSesion();
        }

        public function () {
            


        }
    }
?>