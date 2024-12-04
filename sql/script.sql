CREATE TABLE administrador (
    idAdmin TINYINT NOT NULL AUTO_INCREMENT,
    nombre varchar(60) NOT null,
    correo varchar(125) NOT NULL, 
    passwd varchar(255) NOT NULL,
    CONSTRAINT pk_idAdmin PRIMARY KEY (idAdmin),
    CONSTRAINT USK_correo UNIQUE (correo)
);

CREATE TABLE personaje (
    idPersonaje TINYINT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(75) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    tipo CHAR (1) NOT NULL,
    CONSTRAINT pk_idPersonaje PRIMARY KEY (idPersonaje) 
);

-- CREATE TABLE jugador (
--     idJugador TINYINT NOT NULL,
--     CONSTRAINT fk_Jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador)
-- );

-- CREATE TABLE enemigo (
--     idEnemigo TINYINT NOT NULL,
--     CONSTRAINT fk_Jugador FOREIGN KEY (idJugador) REFERENCES jugador(idJugador),
-- );

CREATE TABLE npc (
    idNPC TINYINT NOT NULL AUTO_INCREMENT,
    CONSTRAINT fk_personaje_idNPC FOREIGN KEY (idNPC) REFERENCES personaje(idPersonaje),
    CONSTRAINT pk_idNPC PRIMARY KEY (idNPC)
);

CREATE TABLE dialogo (
    idDialogo TINYINT NOT NULL AUTO_INCREMENT,
    mensaje VARCHAR(125) NOT NULL,
    CONSTRAINT pk_idDialogo PRIMARY KEY (idDialogo)
);

CREATE TABLE npc_dialogo (
    idNPC TINYINT NOT NULL,
    idDialogo TINYINT NOT NULL,
    CONSTRAINT fk_NPC_idNPC FOREIGN KEY (idNPC) REFERENCES npc(idNPC),
    CONSTRAINT fk_Dialogo_idDialogo FOREIGN KEY (idDialogo) REFERENCES dialogo(idDialogo),
);

-- CREATE table partida ();

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

-- CREATE TABLE objeto ();

-- CREATE TABLE habilidad ();

-- CREATE TABLE objeto_habilidad ();

-- CREATE TABLE enemigo_habilidad ();


// Consulta 1

SELECT Personaje.nombre, Posicion.posicion, Imagen.url
FROM Personaje
INNER JOIN Posicion ON Personaje.idPersonaje = Posicion.idPersonaje
INNER JOIN Imagen ON Imagen.idImagen = Posicion.idImagen;