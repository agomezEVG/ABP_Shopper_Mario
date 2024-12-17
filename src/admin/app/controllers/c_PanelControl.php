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

                $estado = $this->objMPanelControl->mModificarPersonaje($idJugador, $nombre, $descripcion, $tipo);

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

            // if($datosNPC != false) {
                $this->vista = 'ListarNPC';
                return $datosNPC;
            // } else {
            //     $this->vista = 'Error';
            //     return 'No hay ningun NPC que visualizar';
            // }
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
        /* ------------------------------- FIN VALIDACION DE DATOS NPC ------------------------------- */


        /* ------------------------------- CRUD DE ENEMIGO ------------------------------- */

        public function c_AltaEnemigo ($datosEnemigo) {

            $estado = $this->vDatosEnemigo($datosEnemigo);
            
            $this->objMPanelControl->mAltaEnemigo($datosEnemigo);

            if($estado) {

                $nombre = $datosEnemigo['nombre'];
                $descripcion = $datosEnemigo['descripcion'];
                $tipo = 'E';
                $urlImagen = $datosEnemigo['url'];
                
                $idEnemigo = $this->objMPanelControl->mAltaPersonaje($nombre, $descripcion, $tipo);
            } else {
                return false;
            }
            
            if(!$idEnemigo) {
                $this->vista = 'Error';
                return false;
            } else {
                $this->objMPanelControl->mAltaImagen($idEnemigo, $urlImagen);
                return true;
            }
        }

        public function c_ModificarEnemigo ($datosEnemigo) {

            $estado = $this->vDatosEnemigo($datosEnemigo);

            if($estado) {

                $idEnemigo = $datosEnemigo['idPersonaje'];
                $nombre = $datosEnemigo['nombre'];
                $descripcion = $datosEnemigo['descripcion'];
                $tipo = 'E';
                $urlImagen = $datosEnemigo['url'];

                $estado = $this->objMPanelControl->mModificarPersonaje($idEnemigo, $nombre, $descripcion, $tipo);

            } else {
                return false;
            }            
        }

        public function c_EliminarEnemigo ($idEnemigo) {
            
            $estado = $this->objMPanelControl->mEliminarPersonaje($idEnemigo);

            if($estado) {
                $this->vista = 'PanelAdmin';
            } else {
                $this->vista = 'Error';
            }

        }
        public function c_ListarEnemigo () {
            
            $datos = $this->objMPanelControl->mListarEnemigo();
        }

        /* ------------------------------- VALIDACION DE DATOS ENEMIGO ------------------------------- */

        public function vDatosEnemigo($datosEnemigo) {
            if (empty($datosEnemigo['nombre'])) {
                $this->mensajeEstado = 'No se ha rellenado el nombre';
                return false;
            }
    
            if (empty($datosEnemigo['descripcion'])) {
                $this->mensajeEstado = 'No se ha rellenado la descripción';
                return false;
            }
    
            if (empty($datosEnemigo['imagen'])) {
                $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
                return false;
            }

            if (!isset($datosEnemigo['tipo'])) {
                $this->mensajeEstado = 'No se ha añadido tipo de personaje';
                return false;
            }
    
            return true;
        }

        /* ------------------------------- FIN VALIDACION DE DATOS ENEMIGO ------------------------------- */


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

    /* ------------------------------- CRUD DE OBJETOS ------------------------------- */

        public function cAltaObjeto($datosObjeto) {

            if(!empty($datosObjeto)) {

                
                $estado = $this->vDatosObjeto($datosObjeto);

                /* urlImagen puede no valer aquí */
                if($estado) {
                    $nombre = $datosObjeto['nombre'];
                    $descripcion = $datosObjeto['descripcion'];
                    // $urlImagen = $datosObjeto['url'];

                    $idObjeto = $this->objMPanelControl->mAltaObjeto($nombre, $descripcion);

                } else {
                    return false;
                }

                /* Hay que modificar mAltaImgObjeto en m_PanelControl */
                if($idObjeto) {
                    // $estado = $this->objMPanelControl->mAltaImgObjeto($idObjeto, $urlImagen);
                    $datosObjeto = $this->objMPanelControl->mListarObjetos();
                    $this->vista = 'ListarObjetos';
                    return $datosObjeto;
                } else {
                    $this->vista = 'Error';
                    return false;
                }
            } else {
                $this->vista = 'AltaObjeto';
                return $datosObjeto;
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

            if(isset($datosNPC['guardarCambios'])) {

                $estado = $this->vDatosObjeto($datosObjeto);

                if($estado) {
                    $idObjeto = $datosObjeto['idObjeto'];
                    $nombre = $datosObjeto['nombre'];
                    $descripcion = $datosObjeto['descripcion'];
                    // $urlImagen = $datosObjeto['url'];

                    $estado = $this->objMPanelControl->mModificarObjeto($idObjeto, $nombre, $descripcion);

                    if($estado) {
                        $this->vista = 'ListarObjetos';
                        return true;
                    }            
                    else {
                        $this->vista = 'Error';
                        return false;
                    }
                }
                return false;
            } else {
                $this->vista = 'ModificarObjeto';
                return $datosObjeto;
            }
        }

        public function cListarObjetos() {
            
            $datosObjetos = $this->objMPanelControl->mListarObjetos();

            if($datosObjetos != false) {
                $this->vista = 'ListarObjetos';
                return $datosObjetos;
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

            // if (empty($datosObjeto['imagen'])) {
            //     $this->mensajeEstado = 'No se ha añadido la URL de la imagen';
            //     return false;
            // }
            return true;
        }

    /* ------------------------------- FIN VALIDACION DE DATOS OBJETOS ------------------------------- */

    }
?>