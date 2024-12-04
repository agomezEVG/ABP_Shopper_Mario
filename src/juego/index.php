<?php
    require_once 'app/config/config.php';

    // Si el controlador y el metodo llegan sin valor, el programa envia los datos por defecto
    if(!isset($_GET['controlador'])) $_GET['controlador'] = CONTROLADOR_POR_DEFECTO;
    if(!isset($_GET['metodo'])) $_GET['metodo'] = METODO_POR_DEFECTO;

    // Ruta del archivo, incluye el controlador
    $rutaControlador = 'app/controllers/c_' . $_GET['controlador'] . '.php';
    require_once $rutaControlador;

    // Ruta del controlador, instancia la clase
    $nombreControlador = 'C_' . $_GET['controlador'];
    $objControlador = new $nombreControlador();

    $datos = [];

    // Si el metodo existe llama al metodo del controlador
    if(method_exists($objControlador, $_GET['metodo'])) {
        $datos = $objControlador->{$_GET['metodo']}($_POST);
    }

    // Incluye la vista del controlador correspondiente
    require_once 'app/views/v_' . $objControlador->vista;

?>