<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
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
        .btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <main>
        <section>
            <h2>¿Estás seguro de que quieres eliminar este personaje?</h2>
            <form action="index.php?c=PanelControl&m=cEliminarPersonaje" method="POST">
                <input type="hidden" name="idPersonaje" value="<?php $idPersonaje ?>">
                <button type="submit" name="confirmar" class="btn btn-confirmar">Confirmar</button>
                <a href="listar.php" name ="cancelar" class="btn btn-cancelar">Cancelar</a>
            </form>
        </section>
    </main>
    
</body>
</html>
