<?php
    Class C_Juego {
        private $objMJuego;
        
        public $vista;
        public function __construct() {
            require_once 'app/models/m_Juego.php';
            $this->objMJuego = new M_Juego();
        }

        public function inicio(){
            $this->vista = 'Empezar.html';
        }
        
        
    }
?>