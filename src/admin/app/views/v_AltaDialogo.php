<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alta de Dialogo</title>
        
        <!-- ESTILOS E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body id="panelAdmin">
        <aside>
            <a href="index.php?c=PanelControl&m=Dashboard"><button><h3>DASHBOARD</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarPersonajes"><button><h3>PERSONAJES</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarObjetos"><button><h3>OBJETOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarDialogos"><button><h3>DIÁLOGOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=cListarRanking"><button><h3>RANKING</h3></button></a>
        </aside>
        <main>
            <section id="sectionInsertar">
                <h2>Alta del Dialogo</h2>
                <form action="index.php?c=PanelControl&m=cAltaDialogos" method="POST">
                    <div>
                        <input type="text" name="mensaje" id="dialogo" placeholder="Nuevo Dialogo"/>
                    </div>
                <input type="submit" name="anadirDialogo" value="Añadir NPC"/>
                </form>
            </section>
        </main>

    </body>
</html>
