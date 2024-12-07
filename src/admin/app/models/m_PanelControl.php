<?php
    Class M_PanelControl {

        private $conexion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
            $this->conexion->set_charset("utf8");
            // $controlador = new mysqli_driver();
            // $controlador->report_mode = MYSQLI_REPORT_OFF;
            // $texto_error=$this->conexion->errno;
        }

        /* ------------------------------- MODELOS DE PERSONAJES ------------------------------- */
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
        public function mAltaImagen($idPersonaje, $urlImagen) {
            
            $sql = 'INSERT INTO imagen (idPersonaje, url) VALUES ("'.$idPersonaje.'", "'.$urlImagen.'");';
            
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
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

        /* ------------------------------- MODELOS DE NPCs ------------------------------- */

        public function mAltaNPC ($datosNPC) {

            $this->mAltaPersonaje($)
            
            $sql = 'INSERT INTO npc (idNPC) VALUES ('.$idNPC.');';

            $resultado = $this->conexion->query($sql);

            if($resultado->num_rows > 0)
                return true;

            return false;
            
        }
        public function mModificarNPC ($idNPC) {
            
            $sql = 'INSERT INTO npc (idNPC) VALUES ('.$idNPC.');';

            $resultado = $this->conexion->query($sql);

            if($resultado->num_rows > 0)
                return true;

            return false;
            
        }
        public function mEliminarNPC ($idNPC) {
            
            $sql = 'DELETE FROM personaje WHERE idPersonaje = '.$idNPC.';';
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                return false;
            }

            $filas = $this->conexion->affected_rows;
        
            if ($filas > 0) {
                return true;
            }
            return false;
        }
        public function mListarNPC () {
            
            $sql = 'SELECT * FROM personaje RIGHT JOIN npc ON idNPC = idPersonaje;';

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
    }
?>