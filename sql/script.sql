CREATE TABLE personaje (
    idPersonaje TINYINT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(75) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    tipo CHAR (1) NOT NULL,
    CONSTRAINT pk_idPersonaje PRIMARY KEY (idPersonaje)
);

CREATE TABLE imagen (
    idImagen TINYINT NOT NULL AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL,
    tipo CHAR(1) NOT NULL,
    posicion VARCHAR (45) NOT NULL,
    idPersonaje TINYINT NOT NULL,
    CONSTRAINT pk_idImagen PRIMARY KEY (idImagen),
    CONSTRAINT fk_idPersonaje FOREIGN KEY (idPersonaje) REFERENCES personaje(idPersonaje),
    CONSTRAINT ck_tipo CHECK (tipo IN ('E', 'J', 'N', 'O'))
);


// Consulta 1

SELECT Personaje.nombre, Posicion.posicion, Imagen.url
FROM Personaje
INNER JOIN Posicion ON Personaje.idPersonaje = Posicion.idPersonaje
INNER JOIN Imagen ON Imagen.idImagen = Posicion.idImagen;