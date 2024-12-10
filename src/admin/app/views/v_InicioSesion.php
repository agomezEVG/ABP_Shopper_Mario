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
            <button id="volver" onclick='window.location.href="../juego/index.php"'>Volver</button>
            <h1>
                <span>I</span><span>N</span><span>I</span><span>C</span><span>I</span><span>O</span>
                <span>S</span><span>E</span><span>S</span><span>I</span><span>Ó</span><span>N</span>
            </h1>
            <section id="sectionLogin">
                <form action="index.php?c=InicioSesion&m=validarInicioSesion" method="POST">
                    <input type="email" name="email" id="email" placeholder="Email"/>
                    <input type="password" name="passwd" id="passwd" placeholder="Password"/>
                    <div>
                        <input type="checkbox" name="mostrarPassword"/>
                        <label for="mostrarPassword">Mostrar Contraseña</label>
                    </div>
                    <p><a href="forgotPassword.html">¿Has olvidado la contraseña?</a></p>
                    <input type="submit" value="Iniciar Sesion"/>
                </form>
            </section>
        </main>
    </body>
</html>