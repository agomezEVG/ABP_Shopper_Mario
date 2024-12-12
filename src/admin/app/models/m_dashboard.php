<?php

    Class M_dashboard{

        private $conexion;

        public function __construct() {

            require_once 'app/config/configDb.php';

            $this->conexion = new mysqli(SERVIDOR2,USUARIO2,PASSWORD2,BBDD2);
            $this->conexion->set_charset("utf8");
            
        }

        public function datosAdmin() {

          $datos = [];

          $queryTotalPartidas = 'SELECT COUNT(*) AS total_partidas FROM partida';
          $result = $this->conexion->query($queryTotalPartidas);
          $datos['total_partidas'] = $result->fetch_assoc()['total_partidas'];


          $queryPromedioPuntuaciones = 'SELECT ROUND(AVG(puntuacion),0)  AS promedioPuntuacion FROM partida';
          $result = $this->conexion->query($queryPromedioPuntuaciones);
          $datos['promedioPuntuacion'] = $result->fetch_assoc()['promedioPuntuacion'];


          $queryDuracionPromedio = 'SELECT ROUND(AVG(TIME_TO_SEC(duracion)),0) AS promedio_duracion FROM partida;';
          $result = $this->conexion->query($queryDuracionPromedio);
          $datos['promedio_duracion'] = $result->fetch_assoc()['promedio_duracion'];

          $queryMaximaPuntuacion = 'SELECT nombreUsuario, puntuacion FROM partida  ORDER BY puntuacion DESC LIMIT 1';
          $result = $this->conexion->query($queryMaximaPuntuacion);
          $datos['maxima_puntuacion'] = $result->fetch_assoc();
          

          $queryFrecuenciaPersonajes = 'SELECT nombre , COUNT(*) AS frecuencia FROM partida INNER JOIN personaje ON personaje.idPersonaje = partida.idPersonaje GROUP BY nombre ORDER BY frecuencia DESC;';
          $result = $this->conexion->query($queryFrecuenciaPersonajes);
          $datos['frecuencia_personajes'] = $result->fetch_all(MYSQLI_ASSOC);


         $queryBasedeDatos= "SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS tamano_mb
              FROM information_schema.tables
              WHERE table_schema = 'shopperMario'";
              $result = $this->conexion->query($queryBasedeDatos);
          $datos['tamano_mb'] = $result->fetch_assoc()['tamano_mb'];
          
          return $datos;

        }
}