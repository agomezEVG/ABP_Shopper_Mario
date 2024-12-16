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
            <a href="index.php?c=PanelControl&m=cListarObjetos"><button><h3>OBJETOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarDialogos"><button><h3>DIÁLOGOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarRanking"><button><h3>RANKING</h3></button></a>
        </aside>
        <main>
            <section class="datos">
                <a href="index.php"><img src="img/logout.png" alt="LOGOUT" id="Logout"/></a>
                <a href="index.php?c=PanelControl&m=cAltaNPC"><img src="img/btnAnadir.svg" alt="Boton Añadir" id="btnAnadir"/></a>
                <form id="tipoPersonaje" method="POST">
                    <select name="tipoPersonaje" id="tipoPersonaje">
                        <option value="Personajes" hidden disable>Personaje</option>
                        <option value="J">Jugador</option>
                        <option value="E">Enemigo</option>
                        <option value="N">NPC</option>
                    </select>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Imagenes</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($datos) {
                            foreach ($datos as $personaje) {
                                echo '<tr>';
                                echo '<td>' . $personaje['nombre'] . '</td>';
                                echo '<td>' . $personaje['descripcion'] . '</td>';
                                echo '<td>' . $personaje['tipo'] . '</td>';
                                echo '<td>' . $personaje['imagenes'] . '</td>';
                                echo '<td class="action-buttons">';
                                echo '<form action="index.php?c=PanelControl&m=cEliminarPersonaje" method="POST" style="display:inline;">';
                                echo '<button type="submit" class="btn btn-eliminar" name="idPersonaje" value="'.$personaje['idPersonaje'].'">Eliminar</button>';
                                echo '</form>';
                                echo '<form action="index.php?c=PanelControl&m=cModificarPersonaje" method="POST" style="display:inline;">';
                                echo '<button type="submit" class="btn btn-modificar" name="idPersonaje" value="'.$personaje['idPersonaje'].'">Modificar</button>';
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