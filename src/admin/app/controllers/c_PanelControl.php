<?php

    Class C_panelcontrol {

        private $objMPanelControl;
        public $mensajeEstado;
        public $vista;

        public function __construct(){
            require_once 'app/models/m_PanelControl.php';
            $this->objMPanelControl = new M_panelcontrol();
        }

        public function inicio (){
            $this->vista = 'inicioSesion.html';
        }

        public function dasboard() {
            $this->vista = 'v_panelAdmin.php';
        }

        public function cValidarDatosPersonaje($arrayPOST) {
            if (empty($arrayPOST['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($arrayPOST['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($arrayPOST['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (!isset($arrayPOST['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido tipo de personaje';
                return false;
            }
    
            return true;
        }
    
        public function cAltaPersonaje($nombre, $descripcion, $tipo, $urlImagen) {

            $idPersonaje = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            
            if(!$idPersonaje)
                return false;
            else
                $resultado = $this->objMPanelControl->mAltaImagen($idPersonaje, $urlImagen);

            return $resultado;
        }

        public function cListarPersonajes() {
            
            $personajes = $this->objMPanelControl->mListarPersonajes();
            
            return $personajes;
        }
        
        public function cEliminarPersonaje($idPersonaje) {
            
            if(!empty($idPersonaje)) {
                $estado = $this->objMPanelControl->mEliminarPersonaje($idPersonaje);
                return $estado;
            }
            
            return false;
        }
        
        public function cModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo, $urlImagen) {
            
            if(!empty($idPersonaje) && !empty($nombre) && !empty($descripcion) && !empty($tipo) && !empty($urlImagen)) {
                $estado = $this->objMPanelControl->mModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo, $urlImagen);
                return $estado;
            }
            
            return false;
        }        
    }
?>