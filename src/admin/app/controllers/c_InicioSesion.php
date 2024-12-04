<?php
    Class C_InicioSesion {
        private $objMInicioSesion;
        public $vista;

        public function __construct() {
            require_once 'app/models/m_InicioSesion.php';
            $this->objMInicioSesion = new M_InicioSesion();
        }

        public function inicio (){
            $this->vista = 'InicioSesion.html';
        }
        
        public function validarInicioSesion($datosIS) {

            var_dump($datosIS);

            if(!empty($datosIS['user']) && !empty($datosIS['passwd'])){
                $estado = $this->objMInicioSesion->validarInicioSesion($datosIS);

                if($estado) {
                    
                    $this->vista = 'panelAdmin.php';
                    return $estado;
                }
                else {
                    $this->vista = 'error.php';
                    return 'Datos inválidos';
                }
                
            }
        }
    }
?>