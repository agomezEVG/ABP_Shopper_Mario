<?php

    Class C_panelcontrol {

        private $objMPanelControl;
        public $mensajeEstado;
        public $vista;

        public function __construct(){
            require_once 'app/models/m_PanelControl.php';
            $this->objMPanelControl = new M_PanelControl();
        }

        /* ------------------------------- METODO POR DEFECTO ------------------------------- */
        public function inicio() {
            $this->vista = 'PanelAdmin.php';
        }

        /* ------------------------------- CRUD DE IMAGENES ------------------------------- */
        public function c_AltaPersonaje($datosPersonaje) {

            $estado = $this->c_ValidarDatosPersonaje($datosPersonaje);

            if($estado) {

                $nombre = $datosPersonaje['nombre'];
                $descripcion = $datosPersonaje['descripcion'];
                $tipo = $datosPersonaje['tipo'];
                $urlImagen = $datosPersonaje['url'];
                
                $idPersonaje = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            } else {
                return false;
            }
            
            if($idPersonaje) {
                $estado = $this->objMPanelControl->mAltaImagen($idPersonaje, $urlImagen);
                $this->vista = 'Alta.php';
            } else {
                $this->vista = 'Error.php';
                return false;
            }

            return $estado;
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
        public function cListarPersonajes() {
            
            $personajes = $this->objMPanelControl->mListarPersonajes();
            
            return $personajes;
        }

        /* ------------------------------- VALIDACION DE PERSONAJES ------------------------------- */
        public function c_ValidarDatosPersonaje($datosPersonaje) {
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

        /* ------------------------------- CRUD DE NPC ------------------------------- */
        public function c_AltaNPC ($datosNPC) {

            $this->objMPanelControl->mAltaNPC($datosNPC);


            $estado = $this->c_ValidarDatosPersonaje($datosNPC);

            if($estado) {

                $nombre = $datosNPC['nombre'];
                $descripcion = $datosNPC['descripcion'];
                $tipo = 'N';
                $urlImagen = $datosNPC['url'];
                
                $idNPC = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            } else {
                return false;
            }
            
            if(!$idNPC) {
                $this->vista = 'Error.php';
                return false;
            } else {
                $this->objMPanelControl->mAltaImagen($idNPC, $urlImagen);
                return true;
            }
        }

        public function c_ModificarNPC ($idNPC) {
            
            $estado = $this->objMPanelControl->mModificarNPC($idNPC);
        }
        public function c_EliminarNPC ($idNPC) {
            
            $estado = $this->objMPanelControl->mEliminarNPC($idNPC);
        }
        public function c_ListarNPC ($datosNPC) {
            
            $datos = $this->objMPanelControl->mListarNPC($datosNPC);
        }
    }
?>