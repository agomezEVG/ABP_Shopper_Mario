<?php
    require_once 'config/config.php';

    if(!isset($_GET['controlador'])) $_GET['controlador'] = CONTROLADOR_POR_DEFECTO;
    if(!isset($_GET['metodo'])) $_GET['metodo'] = METODO_POR_DEFECTO;

    $rutaControlador = 'controllers/c' . $_GET['controlador'] . '.php';

    require_once $rutaControlador;

    $nombreControlador = 'C' . $_GET['controlador'];

    $objControlador = new $nombreControlador();

    $datos = [];

    if(method_exists($objControlador, $_GET['metodo'])) {
        $datos = $objControlador->{$_GET['metodo']}(); // Quizá pasamos $_POST como parámetro
    }

    require_once 'views/vista' . $objControlador->vista . '.php';
?>