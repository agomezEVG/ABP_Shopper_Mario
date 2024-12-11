<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Personajes</title>

        <!-- ENLACES DE DISEÑO E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body id="panelAdmin">
        <aside>
            <a href="index.php?c=PanelControl&m=inicio"><button><h3>DASHBOARD</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarPersonajes"><button><h3>PERSONAJES</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarImagenes"><button><h3>IMAGENES</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarObjetos"><button><h3>OBJETOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarDialogos"><button><h3>DIÁLOGOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarRanking"><button><h3>RANKING</h3></button></a>
        </aside>
        <main>
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>Mensaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($datos) {
                            foreach ($datos as $dialogo) {
                                echo '<tr>';
                                echo '<td>' . $dialogo['mensaje'] . '</td>';
                                echo '<td class="action-buttons">';
                                echo '<form action="eliminar.php" method="POST" style="display:inline;">';
                                echo '<input type="hidden" name="idPersonaje" value="' . $dialogo['idDialogo'] . '">';
                                echo '<button type="submit" class="btn btn-eliminar" value="'.$dialogo['idDialogo'].'">Eliminar</button>';
                                echo '</form>';
                                echo '<form action="src/php/views/vistaModificar.php" method="POST" style="display:inline;">';
                                echo '<input type="hidden" name="idPersonaje" value="' . $dialogo['idDialogo'] . '">';
                                echo '<button type="submit" class="btn btn-modificar" value="'.$dialogo['idDialogo'].'">Modificar</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }else
                            echo '<h1>NO HAY PERSNAJES</h1>';
                        
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </body>
</html>
