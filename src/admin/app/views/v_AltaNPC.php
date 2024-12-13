<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alta de Personaje</title>
        
        <!-- ESTILOS E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body id="panelAdmin">
        <aside>
            <a href="index.php?c=PanelControl&m=Dashboard"><button><h3>DASHBOARD</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarPersonajes"><button><h3>PERSONAJES</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarImagenes"><button><h3>IMAGENES</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarObjetos"><button><h3>OBJETOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarDialogos"><button><h3>DIÁLOGOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarRanking"><button><h3>RANKING</h3></button></a>
        </aside>
        <main>
            <section id="sectionInsertar">
                <h2>Alta del NPC</h2>
                <form action="index.php?c=PanelControl&m=cAltaNPC" method="POST">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del NPC"/>
                    <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripcion del NPC"></textarea>
                    <select id="tipo" name="tipo">
                        <option disabled >Selecciona un tipo de personaje</option>
                        <option disable value="J">Jugador</option>
                        <option disble value="E">Enemigo</option>
                        <option selected value="N">NPC</option>
                    </select>
                    <input type="text" name="nombreArchivo" placeholder="Nombre de la imagen"/>
                <input type="submit" name="anadirNPC" value="Añadir NPC"/>
                </form>
            </section>
        </main>

    </body>
</html>
