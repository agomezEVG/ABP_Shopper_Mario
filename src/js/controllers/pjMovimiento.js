 // Creamos el fondo

    let div = document.createElement('div');
    div.style.backgroundColor = 'lightblue';
    div.style.width = '100vw';
    div.style.height = '100vh';
    document.querySelector('main').appendChild(div);

// Variables para las imágenes del personaje

let pjBase = null; // Imagen base
let pjWalk1 = null; // Imagen 1 del caminar
let pjWalk2 = null; // Imagen 2 del caminar
let pjCrouch = null; // Imagen agachado
let pjJump = null; // Imagen saltando
let pj = null; // Elemento imagen del personaje
let imagenesCargadas = 0; // Para contar cuántas imágenes se han cargado

// Función para cargar las imágenes asíncronamente (con AJAX)

function cargarImagen(url, callback) {
    let peticion_http = new XMLHttpRequest();
    peticion_http.onreadystatechange = function() {
        if (peticion_http.readyState === 4 && peticion_http.status === 200) {
            let img = new Image();
            img.src = URL.createObjectURL(peticion_http.response);
            callback(img);
        }
    };
    peticion_http.open('GET', url, true);
    peticion_http.responseType = 'blob';
    peticion_http.send();
}

// Función para verificar si todas las imágenes están cargadas
function verificarImagenes() {
    imagenesCargadas++;
    if (imagenesCargadas === 5) {
        inicializarPersonaje(); 
    }
}

// Cargar las imágenes del personaje

cargarImagen('../../img/pj/mario_base.png', function(img) {
    pjBase = img;
    if (pjBase && pjWalk1 && pjWalk2 && pjCrouch && pjJump) inicializarPersonaje(); // Si ya se cargaron todas las imágenes
});
cargarImagen('../../img/pj/mario_walk1.png', function(img) {
    pjWalk1 = img;
    if (pjBase && pjWalk1 && pjWalk2 && pjCrouch && pjJump) inicializarPersonaje(); 
});
cargarImagen('../../img/pj/mario_walk2.png', function(img) {
    pjWalk2 = img;
    if (pjBase && pjWalk1 && pjWalk2 && pjCrouch && pjJump) inicializarPersonaje(); 
});
cargarImagen('../../img/pj/mario_crouch.png', function(img) {
    pjCrouch = img;
    if (pjBase && pjWalk1 && pjWalk2 && pjCrouch && pjJump) inicializarPersonaje(); 
});
cargarImagen('../../img/pj/mario_jump.png', function(img) {
    pjJump = img;
    if (pjBase && pjWalk1 && pjWalk2 && pjCrouch && pjJump) inicializarPersonaje(); 
});

// Posición inicial del personaje

let posX = 100;
let posY = 400;

let velocidad = 4; // Velocidad de movimiento
let imagenActual = 0; // Para alternar entre imágenes

// Función para inicializar el personaje en la página

function inicializarPersonaje() {
    // Creamos el elemento de imagen
    pj = document.createElement('img');
    pj.src = pjBase.src; // Inicialmente usa la imagen base
    pj.style.position = 'absolute';
    pj.style.top = `${posY}px`;
    pj.style.left = `${posX}px`;
    div.appendChild(pj);
}

// Función principal de actualización de movimiento
function actualizarMovimiento() {
    if (direccionMovimiento === 'izquierda') {
        posX -= velocidad; // Mover a la izquierda
        pj.style.transform = 'scaleX(-1)';
    } else if (direccionMovimiento === 'derecha') {
        posX += velocidad; // Mover a la derecha
        pj.style.transform = 'scaleX(1)';
    }

    // Actualizamos la posición horizontal del personaje
    pj.style.left = `${posX}px`;

    // Solo alternamos las imágenes si el personaje se está moviendo y no está saltando
    if (direccionMovimiento !== null && !saltando){
        moverPersonaje(); 
    }
}

// Función para alternar la imagen y mover el personaje
let alternandoImagen = false; // Para saber si estamos esperando a alternar la imagen

function moverPersonaje() {
    // Si ya se está alternando, no hacemos nada
    if (alternandoImagen) return;

    // Marca que estamos alternando la imagen
    alternandoImagen = true;

    // Alternamos entre las tres imágenes con un retraso
    imagenActual = (imagenActual + 1) % 3;  // Para alternar entre 3 imágenes

    if (imagenActual === 0) {
        pj.src = pjBase.src; // Imagen base
    } else if (imagenActual === 1) {
        pj.src = pjWalk1.src; // Imagen de caminar 1
    } else {
        pj.src = pjWalk2.src; // Imagen de caminar 2
    }

    // Después de alternar la imagen, volvemos a permitir que se alternen
    setTimeout(() => {
        alternandoImagen = false;
    }, 100);  // Aquí definimos el retraso en milisegundos para la alternancia de imagen
}

// Movimiento horizontal cuando las teclas A y D se presionan
let direccionMovimiento = null;

document.addEventListener('keydown', function(event) {
    if (event.key === 'a' || event.key === 'A' || event.code === 'ArrowLeft') {
        direccionMovimiento = 'izquierda'; // Establecer la dirección
    }
    if (event.key === 'd' || event.key === 'D' || event.code === 'ArrowRight') {
        direccionMovimiento = 'derecha'; // Establecer la dirección
    }
    if (event.key === 's' && !saltando || event.key === 'S' && !saltando || event.code === 'ArrowDown' && !saltando) {
        pj.src = pjCrouch.src; // Imagen agachado
    }
});

// Detectamos que deja de pulsar las teclas A, D o S
document.addEventListener('keyup', function(event) {
    if (event.key === 'a' || event.key === 'A' || event.code === 'ArrowLeft' || event.key === 'd' || event.key === 'D' || event.code === 'ArrowRight') {
        direccionMovimiento = null; // Deja de moverse cuando se suelta la tecla
    }
    if (event.key === 's' || event.key === 'S' || event.code === 'ArrowDown') {
        pj.src = pjBase.src; // Regresamos a la imagen base
    }
});

// Llamar a actualizarMovimiento
intervaloMovimiento = setInterval(actualizarMovimiento, 10);

// SALTO

// Variables adicionales para el salto

let saltando = false;
let velocidadSalto = 12; // Velocidad inicial de subida
let alturaMaximaSalto = 150;
let gravedad = 0.6; // La "gravedad" de caída (aceleración)
let direccionSalto = 'subiendo';
let intervaloSalto = null;

// Función para detener el salto una vez el personaje regrese al suelo
function detenerSalto() {
    clearInterval(intervaloSalto); // Detenemos el intervalo del salto
    saltando = false;
    pj.src = pjBase.src;
}

function saltoPersonaje() {
    if (direccionSalto === 'subiendo') {
        if (posY > 400 - alturaMaximaSalto) {
            posY -= velocidadSalto; 
            velocidadSalto -= gravedad; // Reducir la velocidad de ascenso

            // Movimiento horizontal mientras saltamos
            if (direccionMovimiento === 'izquierda') posX -= (velocidadSalto/4);
            if (direccionMovimiento === 'derecha') posX += (velocidadSalto/4);

            pj.style.top = `${posY}px`;
        } else {
            direccionSalto = 'bajando';
            velocidadSalto = 12; // Restablecemos la velocidad para la caída
        }
    } else if (direccionSalto === 'bajando') {
        if (posY < 400) {
            posY += velocidadSalto;
            velocidadSalto += gravedad; // Aumentar la velocidad de caída

            if (direccionMovimiento === 'izquierda') posX -= (velocidadSalto / 4);
            if (direccionMovimiento === 'derecha') posX += (velocidadSalto / 4);

            pj.style.top = `${posY}px`;
        } else {
            detenerSalto();
        }
    }
}

document.addEventListener('keydown', function(event) {
    // Si la barra espaciadora se presiona y el personaje no está saltando
    if (event.code === 'Space' && !saltando) {
        saltando = true;
        direccionSalto = 'subiendo';
        pj.src = pjJump.src;
        intervaloSalto = setInterval(saltoPersonaje, 20);
    }
});