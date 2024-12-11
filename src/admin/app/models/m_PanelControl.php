<?php
    class M_PanelControl {

        private $conexion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
            $this->conexion->set_charset("utf8");
            // $controlador = new mysqli_driver();
            // $controlador->report_mode = MYSQLI_REPORT_OFF;
            // $texto_error=$this->conexion->errno;
        }

        /* ------------------------------- MÉTODOS DE PERSONAJES ------------------------------- */
        public function mAltaPersonaje($nombre, $descripcion, $tipo) {

            $sql = 'INSERT INTO personaje (nombre, descripcion, tipo) VALUES ("'.$nombre.'", "'.$descripcion.'", "'.$tipo.'");';
            $resultado = $this->conexion->query($sql);
            
            if ($resultado) {

                $idPersonaje = $this->conexion->insert_id;
                return $idPersonaje;
            } else {
                return false;
            }
        }        
        public function mEliminarPersonaje($idPersonaje) {
            
            $sql = 'DELETE FROM personaje WHERE idPersonaje = '.$idPersonaje.';';
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                return false;
            }

            $filasAfectadas = $this->conexion->affected_rows;
        
            if ($filasAfectadas > 0) {
                return $filasAfectadas;
            }
            return false;
        }        
        public function mModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo, $url) {
            
            $sqlPersonaje = "UPDATE personaje SET nombre = '".$nombre."', descripcion = '".$descripcion."', tipo = '".$tipo."' WHERE idPersonaje = ".$idPersonaje.";";
            $resultadoPersonaje = $this->conexion->query($sqlPersonaje);
        
            if (!$resultadoPersonaje) {
                return false; 
            }

            $sqlImagen = "UPDATE imagen SET url = '".$url."' WHERE idPersonaje = ".$idPersonaje.";";
            $resultadoImagen = $this->conexion->query($sqlImagen);
        
            if (!$resultadoImagen) {
                return false;
            }
        
            return true; 
        }
        public function mListarPersonajes() {
            $sql = 'SELECT personaje.idPersonaje, personaje.nombre, personaje.descripcion, personaje.tipo, imagen.url
                    FROM personaje LEFT JOIN imagen ON personaje.idPersonaje = imagen.idPersonaje';
        
            $resultado = $this->conexion->query($sql);
        
            if ($resultado->num_rows > 0) {
                $personajes = [];
                while ($fila = $resultado->fetch_assoc()) {
                    $personajes[] = $fila;
                }
                return $personajes;
            } else {
                return false;
            }
        }
        /* ------------------------------- FIN MÉTODOS DE PERSONAJES ------------------------------- */


        /* ------------------------------- MÉTODOS DE IMAGENES ------------------------------- */
        public function mAltaImagen($idPersonaje, $urlImagen) {
            
            $sql = 'INSERT INTO imagen (idPersonaje, url) VALUES ("'.$idPersonaje.'", "'.$urlImagen.'");';
            
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        }
        /* ------------------------------- FIN MÉTODOS DE IMAGENES ------------------------------- */


        /* ------------------------------- MÉTODOS DE NPCs ------------------------------- */
        public function mAltaNPC ($idNPC) {

            $sql = 'INSERT INTO npc (idNPC) VALUES ("'.$idNPC.'");';
            
            $resultado = $this->conexion->query($sql);

            $sqlMultiple = 'SELECT GROUP_CONCAT(
                    CONCAT(INSERT INTO npc_dialogo (idNPC, idDialogo) VALUES ('.$idNPC.', idDialogo, );))
                    FROM dialogo;';

            $resultado = $this->conexion->multi_query($sqlMultiple);

            if($resultado) 
                return true;
            else
                return false;

        }
        // public function mModificarNPC () { 
            // LAS MODIFICACIONES SE HARÁN AL PERSONAJE DE TIPO NPC
        // }
        // public function mEliminarNPC () {
            // EL BORRADO DEL NPC SE HARÁ EN LA TABLA PERSONAJE Y MEDIANTE EL BORRADO EN CASCADE SE ELIMINARÁ EN LA TABLA NPC
        // }
        public function mListarNPC () {
            
            $sql = 'SELECT idNPC, nombre, descripcion FROM personaje INNER JOIN npc ON idNPC = idPersonaje;';

            $resultado = $this->conexion->query($sql);
            if($resultado->num_rows > 0) {

                $datosNPC = [];

                while($fila = $resultado->fetch_assoc())
                    $datosNPC[] = $fila;

                
                return $datosNPC;
            } else {
                return false;
            }
        }
        /* ------------------------------- FIN MÉTODOS DE NPCs ------------------------------- */


        /* ------------------------------- MÉTODOS DE DIÁLOGOS ------------------------------- */
        public function mAltaDialogo ($mensaje) {

                $sql = 'INSERT INTO dialogo (mensaje) VALUES ("'.$mensaje.'");';
                
                $resultado = $this->conexion->query($sql);
                
                if($resultado){
                    
                    $idDialogo = $this->conexion->insert_id;

                    $sqlMultiple = 'SELECT GROUP_CONCAT(
                            CONCAT(INSERT INTO npc_dialogo (idNPC, idDialogo) VALUES (idNPC, '.$idDialogo.', ); ) )
                            FROM npc;';

                    $resultado = $this->conexion->multi_query($sqlMultiple);

                    if($resultado) 
                        return true;
                    else
                        return false;
                } else {   
                    return false;
                }
        }
        public function mModificarDialogo ($idDialogo, $mensaje) {
            
            $sql = 'UPDATE dialogo SET mensaje = "'.$mensaje.'" WHERE idDialogo = '.$idDialogo.');';

            $resultado = $this->conexion->query($sql);

            if($resultado){

                $filas = $this->conexion->affected_rows;
                
                if($filas > 0)
                    return true;

                return false;
            }

            return false;
        }
        public function mEliminarDialogo ($idDialogo) {
            
            $sql = 'DELETE FROM dialogo WHERE idDialogo = '.$idDialogo.';';
            
            $resultado = $this->conexion->query($sql);

            if ($resultado) {

                $filas = $this->conexion->affected_rows;

                if ($filas > 0) {
                    return true;
                }
                return false;
                
            } else {
                return false;
            } 
        }
        public function mListarDialogo () {
            
            $sql = 'SELECT * FROM dialogo;';

            $resultado = $this->conexion->query($sql);

            if($resultado->num_rows > 0) {

                $datosDialogo = [];

                while($fila = $resultado->fetch_assoc())
                    $datosDialogo[] = $fila;
                
                return $datosDialogo;
            } else {
                return false;
            }
        }
        /* ------------------------------- FIN MÉTODOS DE DIÁLOGOS ------------------------------- */
    }
?>