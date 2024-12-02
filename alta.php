<?php
    require_once 'src/php/controllers/cPanelControl.php';

    $objcPanelControl = new cPanelControl();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($objcPanelControl->cValidarDatosPersonaje($_POST)) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $urlImagen = $_POST['imagen'];
            $tipo = $_POST['tipo'];
    
            if ($objcPanelControl->cAltaPersonaje($nombre, $descripcion, $tipo, $urlImagen)) {
                echo "Personaje dado de alta.";
            } else {
                echo "Error al dar de alta el personaje.";
            }
        } else {
            echo $objcPanelControl->mensajeEstado;
        }
    }
    
?>
