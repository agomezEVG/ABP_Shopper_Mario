<?php

    class C_PanelControl {

        private $objMPanelControl;
        public $mensajeEstado;
        public $vista;

        public function __construct() {
            require_once 'app/models/m_PanelControl.php';
            $this->objMPanelControl = new M_PanelControl();
        }

        /* ------------------------------- METODO POR DEFECTO ------------------------------- */
        public function inicio() {
            $this->vista = 'PanelAdmin';
        }

        /* ------------------------------- CRUD DE PERSONAJES ------------------------------- */
        public function cAltaPersonaje($datosPersonaje) {

            $estado = $this->vDatosPersonaje($datosPersonaje);

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
                $this->vista = 'Alta';
                return true;
            } else {
                $this->vista = 'Error';
                return false;
            }

        }
        public function cEliminarPersonaje($idPersonaje) {  
            
            if(!empty($idPersonaje)) {
                $estado = $this->objMPanelControl->mEliminarPersonaje($idPersonaje);
                return $estado;
            }
            
            return false;
        }
        public function cModificarPersonaje($datosPersonaje) {

            $estado = $this->vDatosPersonaje($datosPersonaje);

            if($estado) {
                $idPersonaje = $datosPersonaje['idPersonaje'];
                $nombre = $datosPersonaje['nombre'];
                $descripcion = $datosPersonaje['descripcion'];
                $tipo = $datosPersonaje['tipo'];
                $urlImagen = $datosPersonaje['url'];

                $estado = $this->objMPanelControl->mModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo, $urlImagen);

                if($estado) {
                    $this->vista = 'PanelAdmin';
                    return true;
                }            
                else {
                    $this->vista = 'Error';
                    return false;
                }
            }
            return false;
        }
        public function cListarPersonajes() {
            
            $personajes = $this->objMPanelControl->mListarPersonajes();

            if($personajes != false) {
                $this->vista = 'ListarPersonajes';
                return $personajes;
            }
            else {
                $this->vista = 'Error';
                return false;
            }
        }

        /* ------------------------------- VALIDACION DE DATOS PERSONAJES ------------------------------- */
        public function vDatosPersonaje($datosPersonaje) {
            if (empty($datosPersonaje['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($datosPersonaje['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($datosPersonaje['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (!isset($datosPersonaje['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido tipo de personaje';
                return false;
            }
    
            return true;
        }
        /* ------------------------------- FIN VALIDACION DE DATOS PERSONAJES ------------------------------- */


        /* ------------------------------- CRUD DE NPC ------------------------------- */
        public function cAltaNPC ($datosNPC) {

            if (isset($datosNPC['anadirNPC'])) {
                    
                $estado = $this->vDatosNPC($datosNPC);
                
                $this->objMPanelControl->mAltaNPC($datosNPC);
                
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
                    $this->vista = 'Error';
                    return false;
                } else {
                    $this->objMPanelControl->mAltaImagen($idNPC, $urlImagen);
                    return true;
                }
            } else {
                $this->vista = 'AltaNPC';
            }
        }
        public function cModificarNPC ($datosNPC) {
            
            if(isset($datosNPC['guardarCambios'])) {

                $estado = $this->vDatosNPC($datosNPC);
                
                if($estado) {

                    $idNPC = $datosNPC['idNPC'];
                    $nombre = $datosNPC['nombre'];
                    $descripcion = $datosNPC['descripcion'];
                    $tipo = 'N';
                    $nombreArchivo = $datosNPC['nombreArchivo'];
                    
                    $estado = $this->objMPanelControl->mModificarPersonaje($idNPC, $nombre, $descripcion, $tipo, $nombreArchivo);

                    if($estado) {
                        $datos = $this->cListarNPC();
                        return $datos;
                    } else {
                        $this->vista = 'Error';
                        return 'El NPC ha sido borrado';
                        
                    }
                    
                    
                } else {
                    return false;
                }
            } else  {
                $this->vista = 'ModificarNPC';
                return $datosNPC;
            }

            
        }
        public function cEliminarNPC ($datosNPC) {
            $estado = $this->objMPanelControl->mEliminarPersonaje($datosNPC['idNPC']);

            if($estado) {
                $this->vista = 'PanelAdmin';
            } else {
                $mensaje = 'No hay ningun NPC que borrar';
                $this->vista = 'Error';
                return $mensaje;
            }
        }
        public function cListarNPC() {

            $datosNPC = $this->objMPanelControl->mListarNPC();
            if($datosNPC != false) {
                $this->vista = 'ListarNPC';
                return $datosNPC;
            } else {
                $this->vista = 'Error';
                return 'No hay ningun NPC que visualizar';
            }
        }
        /* ------------------------------- VALIDACION DE DATOS PERSONAJES ------------------------------- */
        public function vDatosNPC($datosNPC) {
            if (empty($datosNPC['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($datosNPC['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($datosNPC['nombreArchivo'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (empty($datosNPC['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido el tipo de personaje';
                return false;
            }
            return true;
        }
        /* ------------------------------- FIN VALIDACION DE DATOS PERSONAJES ------------------------------- */


        /* ------------------------------- CRUD DE DIALOGO ------------------------------- */
        public function cAltaDialogo ($datosDialogo) {

            $estado = $this->vDatosDialogo($datosDialogo);

            if($estado) {

                $mensaje = $datosDialogo['mensaje'];

                $estado = $this->objMPanelControl->mAltaDialogo($mensaje);
            }
        }
        public function cModificarDialogo ($datosDialogo) {

            $estado = $this->vDatosDialogo($datosDialogo);

            if($estado){

                $idDialogo = $datosDialogo['idDialogo']; 
                $mensaje = $datosDialogo['mensaje']; 

                $estado = $this->objMPanelControl->mModificarDialogo($idDialogo, $mensaje);

                if($estado)
                    return true;
                else
                    return false;
            }
            else
                return false;

        }
        public function cEliminarDialogo ($idDialogo) {
            
            $estado = $this->objMPanelControl->mEliminarDialogo($idDialogo);

            if($estado){
                $this->vista = 'Modificar';
                return true;
            } else {   
                $this->vista = 'Error';
                return false;
            }
        }
        public function cListarDialogos () {
            
            $datosDialogo = $this->objMPanelControl->mListarDialogos();

            if($datosDialogo != false) {
                $this->vista = 'ListarDialogos';
                return $datosDialogo;
            } else {
                $this->vista = 'Error';
                return false;
            }

        }
        public function vDatosDialogo($datosDialogo) {

            if(!empty($datosDialogo['mensaje']))
                return false;
        }
    }
?>