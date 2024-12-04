<?php
    require_once 'app/config/config.php';

    // Si el controlador y el metodo llegan sin valor, el programa envia los datos por defecto
    if(!isset($_GET['c'])) $_GET['c'] = CONTROLADOR_POR_DEFECTO;
    if(!isset($_GET['m'])) $_GET['m'] = METODO_POR_DEFECTO;
    // Ruta del archivo, incluye el controlador
    $rutaControlador = 'app/controllers/c_' . $_GET['c'] . '.php';
    require_once $rutaControlador;

    // Ruta del controlador, instancia la clase
    $nombreControlador = 'C_' . $_GET['c'];
    $objControlador = new $nombreControlador();

    $datos = [];

    // Si el metodo existe llama al metodo del controlador
    if(method_exists($objControlador, $_GET['m'])) {
        $datos = $objControlador->{$_GET['m']}($_POST);
    }

    // Incluye la vista del controlador correspondiente
    require_once 'app/views/v_' . $objControlador->vista;

?>