<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOPPER MARIO - ALTA OBJETO</title>
        
        <!-- ESTILOS E ICONOS -->
        <link rel="shortcut icon" href="img/iconoRedondo.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body id="panelAdmin">
        <aside>
            <a href="index.php?c=PanelControl&m=Dashboard"><button><h3>DASHBOARD</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarPersonajes"><button><h3>PERSONAJES</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarObjetos"><button><h3>OBJETOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarDialogos"><button><h3>DIÁLOGOS</h3></button></a>
            <a href="index.php?c=PanelControl&m=ListarRanking"><button><h3>RANKING</h3></button></a>
        </aside>
        <main>
            <section id="sectionInsertar">
                <h2>Alta del Objeto</h2>
                <form action="index.php?c=PanelControl&m=cAltaObjeto" method="POST" id="formAlta">
                    <div>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Objeto"/>
                        <!-- <input type="text" name="nombreArchivo" placeholder="Nombre de la imagen"/> -->
                    </div>
                    <textarea name="descripcion" id="descripcion" rows="4" placeholder="Descripcion del NPC"></textarea>
                    <input type="submit" name="anadirObjeto" value="Añadir Objeto"/>
                </form>
            </section>
        </main>
        <script src="js/controllers/c_Objetos.js"></script>
    </body>
</html>