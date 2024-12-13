<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOPPER MARIO</title>

        <!-- ESTILOS E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <main>
            <button id="volver" onclick='window.location.href="index.php?c=PanelControl&m=inicio"'>Volver</button>
            <div id="mensaje de error">
                <?php 
                    $mensajeEstado = $datos;
                    echo '<p>'.$mensajeEstado.'</p>';
                ?>
            </div>
        </main>
    </body>
</html>