<?php
    require_once 'src/php/controllers/cPanelControl.php';
    
    if (isset($_POST['idPersonaje']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['tipo']) && isset($_POST['url'])) {
        $idPersonaje = $_POST['idPersonaje'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $tipo = $_POST['tipo'];
        $urlImagen = $_POST['url'];

        $objcPanelControl = new cPanelControl();

        $personajes = $objcPanelControl->cModificarPersonaje($idPersonaje, $nombre, $descripcion, $tipo, $urlImagen);

        if ($personajes == false) {
            $mensaje = "No se ha encontrado ningún personaje.";
            require_once 'src/php/views/vistaError.php';
        } else {
            require_once 'listar.php';
        }
    } else {
        $mensaje = "Datos incorrectos.";
        require_once 'src/php/views/vistaError.php';
    }
?>