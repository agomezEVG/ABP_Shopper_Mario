<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOPPER MARIO</title>
        
        <!-- ENLACES DE DISEÑO E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="src\css\style.css" type="text/css">
    </head>
    <body id="panelAdmin">
        <aside>
            <button><h3>DASHBOARD</h3></button>
            <button><h3>PERSONAJES</h3></button>
            <button onclick='window.location.href="index.html"'><h3>IMAGENES</h3></button>
            <button><h3>OBJETOS</h3></button>
            <button><h3>DIÁLOGOS</h3></button>
            <button><h3>RANKING</h3></button>
        </aside>
        <main>
            <section>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>URL de la imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($personajes as $personaje) {
                                echo '<tr>';
                                echo '<td>' . $personaje['idPersonaje'] . '</td>';
                                echo '<td>' . $personaje['nombre'] . '</td>';
                                echo '<td>' . $personaje['descripcion'] . '</td>';
                                echo '<td>' . $personaje['tipo'] . '</td>';
                                echo '<td>' . $personaje['url'] . '</td>';
                                echo '<td class="action-buttons">';
                                echo '<form action="eliminar.php" method="POST" style="display:inline;">';
                                echo '<input type="hidden" name="idPersonaje" value="' . $personaje['idPersonaje'] . '">';
                                echo '<button type="submit" class="btn btn-eliminar" value="'.$personaje['idPersonaje'].'">Eliminar</button>';
                                echo '</form>';
                                echo '<form action="src/php/views/vistaModificar.php" method="POST" style="display:inline;">';
                                echo '<input type="hidden" name="idPersonaje" value="' . $personaje['idPersonaje'] . '">';
                                echo '<button type="submit" class="btn btn-modificar" value="'.$personaje['idPersonaje'].'">Modificar</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <button onclick='window.location.href="index.html"' id="buttonLogout">
                    <h3>CERRAR SESIÓN</h3>
                </button>
            </section>
        </main>
    </body>
</html>
