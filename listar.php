<?php
    require_once 'src/php/controllers/cPanelControl.php';
    $objcPanelControl = new cPanelControl();

    $personajes = $objcPanelControl->cListarPersonajes();

    if($personajes == false) {
        $mensaje = "No se han encontrado personajes.";
        require_once 'src/php/views/vistaError.php';
    } else {
        require_once 'src/php/views/panelAdmin.php';    
    }
?>