-- INSERCIONES EN ADMINISTRADOR
INSERT INTO administrador (correo, passwd)
VALUES ('mpena@gmail.com', '$2y$10$GYWDloBLDdgQ5B0HnS6FfeiG4QnJOEo9BreJ0fl3MArG94qOpEWPO'),
('phernandez@gmail.com', '$2y$10$vJ3x7v0Ki32b1O4oR3nHKevm.x.vYAmuvBh9w8T56RUeoZNLs7wOi'),
('asanchez@gmail.com', '$2y$10$SFyPDrbFSkUPdMI6yVcl0ey5xToY1dETQEJaSOrYLq2JH.yBWawm6'),
('agomez@gmail.com', '$2y$10$byzD7jEXT.GRm1CQbDzx6uBI2RDItBLvzYzP5wPfSKChW2j0Tt8vK');

-- Insertar personajes
INSERT INTO personaje (nombre, descripcion, tipo)
VALUES 
('Guerrero Valiente', 'Un guerrero con gran habilidad en combate cuerpo a cuerpo.', 'J'), -- idPersonaje 1
('Maga Elemental', 'Controla los elementos con hechizos poderosos.', 'J'),               -- idPersonaje 2
('Ladrón Sigiloso', 'Especialista en sigilo y ataques rápidos.', 'J'),                   -- idPersonaje 3
('Troll del Bosque', 'Un enemigo peligroso que acecha en el bosque.', 'E'),              -- idPersonaje 4
('Brujo Oscuro', 'Un hechicero que practica magia negra.', 'E'),                         -- idPersonaje 5
('Dragón Anciano', 'Una criatura mítica que guarda tesoros.', 'E'),                      -- idPersonaje 6
('Aldeano Sabio', 'Un NPC que ofrece información crucial al jugador.', 'N'),             -- idPersonaje 7
('Comerciante Ambulante', 'Un NPC que vende útiles objetos a los jugadores.', 'N');      -- idPersonaje 8

-- Insertar jugadores
INSERT INTO jugador (idJugador)
VALUES 
(1),
(2),
(3);

-- Insertar enemigos
INSERT INTO enemigo (idEnemigo)
VALUES 
(4),
(5),
(6);

-- Insertar NPCs
INSERT INTO npc (idNPC)
VALUES 
(7),
(8);

-- Insertar diálogos
INSERT INTO dialogo (mensaje)
VALUES 
('¡Bienvenido, aventurero! ¿Qué buscas?'), -- idDialogo 1
('¿Has escuchado los rumores sobre el Dragón?'), -- idDialogo 2
('Cuidado en el bosque, hay muchos peligros.'), -- idDialogo 3
('Tengo cosas interesantes para ti.'), -- idDialogo 4
('Gracias por tu ayuda, héroe.'); -- idDialogo 5

-- Relación NPC-Dialogo
INSERT INTO npc_dialogo (idNPC, idDialogo)
VALUES 
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5);

-- Insertar imágenes para jugadores (5 imágenes por jugador)
INSERT INTO imagen (nombreArchivo, posicion, idPersonaje)
VALUES 
('guerrero_frente', 'J', 'Frente', 1),
('guerrero_espalda', 'J', 'Espalda', 1),
('guerrero_lateral_izq', 'J', 'Lateral Izquierdo', 1),
('guerrero_lateral_der', 'J', 'Lateral Derecho', 1),
('guerrero_combate', 'J', 'En combate', 1),

('maga_frente', 'J', 'Frente', 2),
('maga_espalda', 'J', 'Espalda', 2),
('maga_lateral_izq', 'J', 'Lateral Izquierdo', 2),
('maga_lateral_der', 'J', 'Lateral Derecho', 2),
('maga_hechizo', 'J', 'Lanzando hechizo', 2),

('ladron_frente.png', 'J', 'Frente', 3),
('ladron_espalda.png', 'J', 'Espalda', 3),
('ladron_lateral_izq', 'J', 'Lateral Izquierdo', 3),
('ladron_lateral_der', 'J', 'Lateral Derecho', 3),
('ladron_sigiloso', 'J', 'Modo sigiloso', 3);

-- Insertar imágenes para enemigos (3 imágenes por enemigo)
INSERT INTO imagen (nombreArchivo, posicion, idPersonaje)
VALUES 
('troll_frente.png', 'E', 'Frente', 4),
('troll_combate.png', 'E', 'En combate', 4),
('troll_derrota.png', 'E', 'Derrotado', 4),

('brujo_frente.png', 'E', 'Frente', 5),
('brujo_atacando.png', 'E', 'Atacando', 5),
('brujo_derrota.png', 'E', 'Derrotado', 5),

('dragon_volando.png', 'E', 'Volando', 6),
('dragon_atacando.png', 'E', 'Atacando', 6),
('dragon_descansando.png', 'E', 'Descansando', 6);

-- Insertar imágenes para NPCs (1 imagen por NPC)
INSERT INTO imagen (nombreArchivo, posicion, idPersonaje)
VALUES 
('aldeano_frente.png', 'N', 'Frente', 7),
('comerciante_frente.png', 'N', 'Frente', 8);

-- Insertar objetos
INSERT INTO objeto (nombre, descripcion)
VALUES 
('Poción de Salud', 'Restaura 50 puntos de vida.'),
('Espada Antigua', 'Una espada poderosa con historia.'),
('Anillo Místico', 'Incrementa el poder mágico del portador.'),
('Escudo del Guardián', 'Aumenta la defensa del jugador.');

-- Insertar imágenes para objetos
INSERT INTO imagen (url, tipo, posicion, idPersonaje)
VALUES 
('https://example.com/images/pocion.png', 'O', 'Objeto', NULL),
('https://example.com/images/espada.png', 'O', 'Objeto', NULL),
('https://example.com/images/anillo.png', 'O', 'Objeto', NULL),
('https://example.com/images/escudo.png', 'O', 'Objeto', NULL);

