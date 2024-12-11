<?php

    Class C_panelcontrol {

        private $objMPanelControl;
        public $mensajeEstado;
        public $vista;

        public function __construct(){
            require_once 'app/models/m_PanelControl';
            $this->objMPanelControl = new M_PanelControl();
        }

        /* ------------------------------- METODO POR DEFECTO ------------------------------- */
        public function inicio() {
            $this->vista = 'PanelAdmin';
        }

        /* ------------------------------- CRUD DE PERSONAJES ------------------------------- */
        public function c_AltaPersonaje($datosPersonaje) {

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
                $this->vista = 'Listar';
                return true;
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

        
        /* ------------------------------- CRUD DE JUGADOR ------------------------------- */

        public function c_AltaJugador ($datosJugador) {

            $estado = $this->vDatosJugador($datosJugador);
            
            $this->objMPanelControl->mAltaJugador($datosJugador);

            if($estado) {

                $nombre = $datosJugador['nombre'];
                $descripcion = $datosJugador['descripcion'];
                $tipo = 'J';
                $urlImagen = $datosJugador['url'];
                
                $idJugador = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            } else {
                return false;
            }
            
            if(!$idJugador) {
                $this->vista = 'Error';
                return false;
            } else {
                $this->objMPanelControl->mAltaImagen($idJugador, $urlImagen);
                return true;
            }
        }

        public function c_ModificarJugador ($datosJugador) {

            $estado = $this->vDatosJugador($datosJugador);

            if($estado) {

                $idJugador = $datosJugador['idPersonaje'];
                $nombre = $datosJugador['nombre'];
                $descripcion = $datosJugador['descripcion'];
                $tipo = 'J';
                $urlImagen = $datosJugador['url'];

                $estado = $this->objMPanelControl->mModificarPersonaje($idJugador, $nombre, $descripcion, $tipo, $urlImagen);

            } else {
                return false;
            }            
        }

        public function c_EliminarJugador ($idJugador) {
            
            $estado = $this->objMPanelControl->mEliminarPersonaje($idJugador);

            if($estado) {
                $this->vista = 'PanelAdmin';
            } else {
                $this->vista = 'Error';
            }

        }
        public function c_ListarJugador () {
            
            $datos = $this->objMPanelControl->mListarJugador();
        }

        /* ------------------------------- VALIDACION DE DATOS JUGADOR ------------------------------- */

        public function vDatosJugador($datosJugador) {
            if (empty($datosJugador['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($datosJugador['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($datosJugador['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (!isset($datosJugador['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido tipo de personaje';
                return false;
            }
    
            return true;
        }

        /* ------------------------------- FIN VALIDACION DE DATOS JUGADOR ------------------------------- */


        /* ------------------------------- CRUD DE NPC ------------------------------- */
        public function c_AltaNPC ($datosNPC) {

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
        }
        public function c_ModificarNPC ($datosNPC) {

            $estado = $this->vDatosNPC($datosNPC);

            if($estado) {

                $idNPC = $datosNPC['idPersonaje'];
                $nombre = $datosNPC['nombre'];
                $descripcion = $datosNPC['descripcion'];
                $tipo = 'N';
                $urlImagen = $datosNPC['url'];

                $estado = $this->objMPanelControl->mModificarPersonaje($idNPC, $nombre, $descripcion, $tipo, $urlImagen);


            } else {
                return false;
            }

            
        }
        public function c_EliminarNPC ($idNPC) {
            
            $estado = $this->objMPanelControl->mEliminarPersonaje($idNPC);

            if($estado) {
                $this->vista = 'PanelAdmin';
            } else {
                $this->vista = 'Error';
            }
        }
        public function c_ListarNPC () {
            
            $datos = $this->objMPanelControl->mListarNPC();
        }
        /* ------------------------------- VALIDACION DE DATOS NPC ------------------------------- */
        public function vDatosNPC($datosNPC) {
            if (empty($datosNPC['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($datosNPC['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($datosNPC['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (!isset($datosNPC['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido tipo de personaje';
                return false;
            }
    
            return true;
        }
        /* ------------------------------- FIN VALIDACION DE DATOS NPC ------------------------------- */


        /* ------------------------------- CRUD DE DIALOGO ------------------------------- */
        public function c_AltaDialogo ($datosDialogo) {

            $estado = $this->vDatosDialogo($datosDialogo);

            if($estado) {

                $mensaje = $datosDialogo['mensaje'];

                $estado = $this->objMPanelControl->mAltaDialogo($mensaje);
            }
        }
        public function c_ModificarDialogo ($datosDialogo) {

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
        public function c_EliminarDialogo ($idDialogo) {
            
            $estado = $this->objMPanelControl->mEliminarDialogo($idDialogo);

            if($estado){
                $this->vista = 'Modificar';
                return true;
            } else {   
                $this->vista = 'Error';
                return false;
            }
        }
        public function c_ListarDialogo () {
            
            $datos = $this->objMPanelControl->mListarDialogo();

            if(is_array($datos)){
                $this->vista = 'Listar';
            } else {
                $this->vista = 'Error';
            }

        }
        public function vDatosDialogo($datosDialogo) {

            if(!empty($datosDialogo['mensaje']))
                return false;
        }

    /* ------------------------------- CRUD DE OBJETOS ------------------------------- */

        public function c_AltaObjeto($datosObjeto) {

            $estado = $this->vDatosObjeto($datosObjeto);

            /* urlImagen puede no valer aquí */
            if($estado) {
                $nombre = $datosObjeto['nombre'];
                $descripcion = $datosObjeto['descripcion'];
                $urlImagen = $datosObjeto['url'];

                $idObjeto = $this->objMPanelControl->mAltaObjeto($nombre, $descripcion);
            } else {
                return false;
            }

            /* Hay que modificar mAltaImgObjeto en m_PanelControl */
            if($idObjeto) {
                $estado = $this->objMPanelControl->mAltaImgObjeto($idObjeto, $urlImagen);
                $this->vista = 'Alta';
                return true;
            } else {
                $this->vista = 'Error';
                return false;
            }
        }

        public function cEliminarObjeto($idObjeto) {
            
            if(!empty($idObjeto)) {
                $estado = $this->objMPanelControl->mEliminarObjeto($idObjeto);
                return $estado;
            }
            
            return false;
        }

        public function cModificarObjeto($datosObjeto) {

            $estado = $this->vDatosObjeto($datosObjeto);

            if($estado) {
                $idObjeto = $datosObjeto['idObjeto'];
                $nombre = $datosObjeto['nombre'];
                $descripcion = $datosObjeto['descripcion'];
                $urlImagen = $datosObjeto['url'];

                $estado = $this->objMPanelControl->mModificarObjeto($idObjeto, $nombre, $descripcion, $urlImagen);

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

        public function cListarObjetos() {
            
            $objetos = $this->objMPanelControl->mListarObjetos();

            if($objetos != false) {
                $this->vista = 'Listar';
                return true;
            }
            else {
                $this->vista = 'Error';
                return false;
            }
        }
        
    /* ------------------------------- VALIDACION DE DATOS OBJETOS ------------------------------- */

        public function vDatosObjeto($datosObjeto) {
            if (empty($datosObjeto['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }

            if (empty($datosObjeto['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }

            if (empty($datosObjeto['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }
            return true;
        }

    /* ------------------------------- FIN VALIDACION DE DATOS OBJETOS ------------------------------- */

    }
?>