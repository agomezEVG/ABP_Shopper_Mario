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

            if(!empty($datosIS['email']) && !empty($datosIS['passwd'])){
                $estado = $this->objMInicioSesion->validarInicioSesion($datosIS);

                if($estado) {
                    $this->vista = 'PanelAdmin.php';
                    return true;
                }
                else {
                    $this->vista = 'Error.php';
                    return 'Datos inválidos';
                }
                
            }
        }
    }
?>