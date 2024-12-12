CREATE TABLE administrador (
    idAdmin TINYINT NOT NULL AUTO_INCREMENT,
    nombre varchar(60) NOT null,
    correo varchar(125) NOT NULL, 
    passwd varchar(255) NOT NULL,
    CONSTRAINT pk_idAdmin PRIMARY KEY (idAdmin),
    CONSTRAINT usk_correo UNIQUE (correo)
);

CREATE TABLE personaje (
    idPersonaje TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(75) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    tipo CHAR (1) NOT NULL,
    CONSTRAINT pk_idPersonaje PRIMARY KEY (idPersonaje),
    CONSTRAINT ck_tipo CHECK (tipo IN ('E', 'J', 'N', 'O'))
);

CREATE TABLE jugador (
    idJugador TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_idJugador PRIMARY KEY (idJugador),
    CONSTRAINT fk_idJugador FOREIGN KEY (idJugador) REFERENCES personaje(idPersonaje) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE enemigo (
    idEnemigo TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_idEnemigo PRIMARY KEY (idEnemigo),
    CONSTRAINT fk_idEnemigo FOREIGN KEY (idEnemigo) REFERENCES personaje(idPersonaje) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE npc (
    idNPC TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    CONSTRAINT pk_idNPC PRIMARY KEY (idNPC),
    CONSTRAINT fk_personaje_idNPC FOREIGN KEY (idNPC) REFERENCES personaje(idPersonaje) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE dialogo (
    idDialogo TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    mensaje VARCHAR(125) NOT NULL,
    CONSTRAINT pk_idDialogo PRIMARY KEY (idDialogo)
);

CREATE TABLE npc_dialogo (
    idNPC TINYINT UNSIGNED NOT NULL,
    idDialogo TINYINT UNSIGNED NOT NULL,
    CONSTRAINT fk_NPC_idNPC FOREIGN KEY (idNPC) REFERENCES npc(idNPC) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_Dialogo_idDialogo FOREIGN KEY (idDialogo) REFERENCES dialogo(idDialogo) ON UPDATE CASCADE ON DELETE CASCADE
);

-- CREATE table partida (
--     idPartida SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
--     duracion TIME NOT NULL,
--     fechaHora DATETIME NOT NULL,
--     nickname char(3) NOT NULL,
--     puntuacion SMALLINT NOT NULL,
--     idJugador TINYINT UNSIGNED NOT NULL,
--     CONSTRAINT pk_idPartida PRIMARY KEY (idPartida),
--     CONSTRAINT fk_Partida_idJugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)
-- );

CREATE TABLE imagen (
    idImagen TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreArchivo VARCHAR(255) NOT NULL,
    posicion VARCHAR (45) NOT NULL,
    idPersonaje TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_idImagen PRIMARY KEY (idImagen),
    CONSTRAINT fk_idPersonaje FOREIGN KEY (idPersonaje) REFERENCES personaje(idPersonaje) ON UPDATE CASCADE ON DELETE CASCADE
);

-- CREATE TABLE objeto ();

-- CREATE TABLE habilidad ();

-- CREATE TABLE objeto_habilidad ();

-- CREATE TABLE enemigo_habilidad ();


// Consulta 1

SELECT Personaje.nombre, Posicion.posicion, Imagen.url
FROM Personaje
INNER JOIN Posicion ON Personaje.idPersonaje = Posicion.idPersonaje
INNER JOIN Imagen ON Imagen.idImagen = Posicion.idImagen;