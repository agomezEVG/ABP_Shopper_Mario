<?php
    require_once 'src/php/controllers/cPanelControl.php';

    $objcPanelControl = new Cpanelcontrol();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPersonaje = $_POST['idPersonaje']; // ID del personaje a eliminar

        if (isset($_POST['confirmar'])) {
            $estado = $objcPanelControl->cEliminarPersonaje($idPersonaje);

            header("Location: listar.php?estado=$estado");
            exit;
        } else {
            $personajes = $objcPanelControl->cListarPersonajes();
            require_once 'src/php/views/vistaEliminar.php';
        }
    }
?>
