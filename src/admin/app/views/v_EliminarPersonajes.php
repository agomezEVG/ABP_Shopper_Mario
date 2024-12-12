<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    
    <!-- ENLACES DE DISEÑO E ICONOS -->
    <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <h2>¿Estás seguro de que quieres eliminar este personaje?</h2>
    <form action="eliminar.php" method="POST">
        <input type="hidden" name="idPersonaje" value="<?php $idPersonaje ?>">
        <button type="submit" name="confirmar" class="btn btn-confirmar">Confirmar</button>
        <a href="listar.php" class="btn btn-cancelar">Cancelar</a>
    </form>
</body>
</html>
