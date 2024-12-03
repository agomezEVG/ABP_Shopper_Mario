<?php
    require_once 'app/config/config.php';

    if(!isset($_GET['controlador'])) $_GET['controlador'] = CONTROLADOR_POR_DEFECTO;
    if(!isset($_GET['metodo'])) $_GET['metodo'] = METODO_POR_DEFECTO;

    $rutaControlador = 'app/controllers/c_' . $_GET['controlador'] . '.php';

    require_once $rutaControlador;

    $nombreControlador = 'C_' . $_GET['controlador'];

    $objControlador = new $nombreControlador();

    $datos = [];

    if(method_exists($objControlador, $_GET['metodo'])) {
        $datos = $objControlador->{$_GET['metodo']}();
        echo json_encode($datos);
    }
?>