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
                $nombreArchivo = $datosPersonaje['nombreArchivo'];
                
                $idPersonaje = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            } else {
                $this->vista = 'Error';
                return false;
            }
            
            if($idPersonaje =! false) {

                if($tipo == 'N')
                    $this->objMPanelControl->mAltaNPC($idPersonaje);
                if($tipo == 'J')
                    // $this->objMPanelControl->mAltaJugador($idPersonaje);
                if($tipo == 'E')
                    // $this->objMPanelControl->mAltaEnemigo($idPersonaje);

                $estado = $this->objMPanelControl->mAltaImagen($idPersonaje, $nombreArchivo);
                
                if($estado) {
                    $this->vista = 'ListarPersonajes';
                    return true;
                } else {
                    $this->vista = 'Error';
                    return false;
                }
            } else {
                $this->vista = 'Error';
                $this->vista = 'Error';
                return false;
            }

        }
        public function cEliminarPersonaje($datosEliminar) {
            if(isset($datosEliminar['confirmar'])) {
                
                $idPersonaje = $datosEliminar['idPersonaje'];
                    
                $estado = $this->objMPanelControl->mEliminarPersonaje($idPersonaje);

                if($estado) {
                    $datos = $this->cListarPersonajes();
                    return $datos;
                }
                return false;
            

            } else {
                $this->vista = 'EliminarPersonajes';
                return $datosEliminar;
            }
        }
        public function cModificarPersonaje($datos) {
            if(!isset($datosEliminar['guardarCambios'])) {
                $this->vista = 'ModificarPersonajes'; 
                return $datos;
            }    
                $estado = $this->vDatosPersonaje($datos);

                if($estado) {
                    
                    $idPersonaje = $datos['idPersonaje'];
                    $nombre = $datos['nombre'];
                    $descripcion = $datos['descripcion'];
                $tipo = $datos['tipo'];
                $nombreArchivo = $datos['nombreArchivo'];

                $idPersonaje = $this->objMPanelControl->mModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo);
                
                if($idPersonaje != false) {

                    $estado = $this->objMPanelControl->mModificarImagen($idPersonaje, $nombreArchivo);
                    
                    if($estado) {
                        $datos = $this->cListarPersonajes();
                        return $datos;
                    } else {
                        echo 'error';
                        $mensajeEstado = 'Imagen no insertada';
                        $this->vista  = 'Error';
                        return $mensajeEstado;
                    }
                }
            
            }
        }

        public function cListarPersonajes() {
            
            $personajes = $this->objMPanelControl->mListarPersonajes();

            if($personajes != false) {
                $this->vista = 'ListarPersonajes';
                return $personajes;
            }
            else {
                $this->mensajeEstado = 'No hay personajes';
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
    
            if (empty($datosPersonaje['nombreArchivo'])) {
                $this->mensajeEstado = 'No se ha añadido el nombre del archivo de la imagen';
                return false;
            }

            if (empty($datosPersonaje['tipo'])) {
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
                
                
                if($estado) {
                    
                    
                    $nombre = $datosNPC['nombre'];
                    $descripcion = $datosNPC['descripcion'];
                    $tipo = 'N';
                    $nombreArchivo = $datosNPC['nombreArchivo'];
                    
                    $idNPC = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
                } else {
                    return false;
                }
                
                if(!$idNPC) {
                    $this->vista = 'Error';
                    return false;
                } else {
                    $this->objMPanelControl->mAltaNPC($idNPC);
                    $this->objMPanelControl->mAltaImagen($idNPC, $nombreArchivo);
                    
                    $datos = $this->cListarNPC();

                    if($datos) {
                        $this->vista = 'ListarNPC';
                        return $datos;
                    }

                    $this->vista = 'Error';
                    return false;
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
                    
                    $estado = $this->objMPanelControl->mModificarPersonaje($idNPC, $nombre, $descripcion, $tipo);
                    
                    if($estado) {

                        $estado = $this->objMPanelControl->mModificarImagen($idNPC, $nombreArchivo);

                        if($estado) {
                            $datos = $this->cListarNPC();
                            return $datos;
                        }
                    } else {
                        $this->vista = 'Error';
                        return 'El NPC no ha sido modificado';
                        
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
                $datos = $this->cListarNPC();
                return $datos;
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
        public function cAltaDialogos ($datosDialogo) {

            if(empty($datosDialogo['anadirDialogo'])) {
                $this->vista = 'AltaDialogo';
                return $datosDialogo;
            }

            $estado = $this->vDatosDialogo($datosDialogo);
            if($estado) {

                $mensaje = $datosDialogo['mensaje'];

                $estado = $this->objMPanelControl->mAltaDialogos($mensaje);
                
                if($estado) {
                    $datos =$this->objMPanelControl->mListarDialogos();
                    if($datos != false) {
                        $this->vista = 'ListarDialogos';
                        return $datos;
                    }
                    $this->vista = 'Error';
                    return false;
                }
                $this->vista = 'Error';
                    return false;
            }
            $this->vista = 'Error';
            return false;
        }
        public function cModificarDialogos ($datosDialogo) {

            if(empty($datosDialogo['guardarCambios'])) {
                $this->vista = '';
            }

            $estado = $this->vDatosDialogo($datosDialogo);

            if($estado){

                $idDialogo = $datosDialogo['idDialogo']; 
                $mensaje = $datosDialogo['mensaje']; 

                $estado = $this->objMPanelControl->mModificarDialogos($idDialogo, $mensaje);

                if($estado)
                    return true;
                else
                    return false;
            }
            else
                return false;

        }
        public function cEliminarDialogos ($idDialogo) {
            
            $estado = $this->objMPanelControl->mEliminarDialogos($idDialogo);

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

            if(empty($datosDialogo['mensaje'])){

                echo 'mensaje vacio';
                return false;
            }
            return true;
        }
    }
?>