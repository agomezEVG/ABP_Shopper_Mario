<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listado de Personajes</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f4f4f4;
                color: #333;
            }
            h2 {
                text-align: center;
                color: #007BFF;
            }
            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #007BFF;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            .action-buttons {
                text-align: center;
                white-space: nowrap;
            }
            .btn {
                padding: 8px 16px;
                margin-left: 10px;
                border: none;
                border-radius: 5px;
                font-size: 14px;
                cursor: pointer;
                color: white;
                transition: background-color 0.3s ease;
            }
            .btn-eliminar {
                background-color: #FF4D4D;
            }
            .btn-eliminar:hover {
                background-color: #CC0000;
            }
            .btn-modificar {
                background-color: #4CAF50;
            }
            .btn-modificar:hover {
                background-color: #357a38;
            }
        </style>
    </head>
    <body>
        <h2>Listado de Personajes</h2>

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
    </body>
</html>
