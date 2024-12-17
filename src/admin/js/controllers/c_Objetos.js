// Validar el formulario de Alta de Objetos
function validarFormularioAlta(event) {
    event.preventDefault(); // Interrumpe el envío por defecto del formulario
    let valido = true; // Se crea una variable booleana para validar que todo los campos están rellenos

    // Obtener campos del formulario de alta
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");

    // Limpiar mensajes de error previos
    eliminarErrores();

    // Validar nombre
    if (!nombre.value.trim()) {
        mostrarError(nombre, "El nombre del objeto es obligatorio.");
        valido = false;
    } else if (nombre.value.length > 50) {
        mostrarError(nombre, "El nombre no debe exceder los 50 caracteres.");
        valido = false;
    }

    // Validar descripción 
    if (!descripcion.value.trim()) {
        mostrarError(descripcion, "La descripción es obligatoria.");
        valido = false;
    } else if (descripcion.value.length > 255) {
        mostrarError(descripcion, "La descripción no debe exceder los 255 caracteres.");
        valido = false;
    }

    if (valido) {
        event.target.submit(); // Enviar el formulario tras comprobar que los campos se han validado
    }
}

// Validar el formulario de Modificación de Objetos
function validarFormularioModificar(event) {
    event.preventDefault(); // Evitar el envío por defecto
    let valido = true;

    // Obtener campos del formulario de modificación
    const idObjeto = document.getElementById("idObjeto");
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");

    // Limpiar mensajes de error previos
    eliminarErrores();

    // Validar ID del objeto (debería ser solo numérico)
    if (!idObjeto.value.trim() || isNaN(idObjeto.value)) {
        mostrarError(idObjeto, "El ID del objeto debe ser un número válido.");
        valido = false;
    }

    // Validar nombre
    if (!nombre.value.trim()) {
        mostrarError(nombre, "El nombre del objeto es obligatorio.");
        valido = false;
    } else if (nombre.value.length > 50) {
        mostrarError(nombre, "El nombre no debe exceder los 50 caracteres.");
        valido = false;
    }

    // Validar descripción
    if (!descripcion.value.trim()) {
        mostrarError(descripcion, "La descripción es obligatoria.");
        valido = false;
    } else if (descripcion.value.length > 255) {
        mostrarError(descripcion, "La descripción no debe exceder los 255 caracteres.");
        valido = false;
    }

    // Si el formulario es válido, enviarlo
    if (valido) {
        event.target.submit(); // Enviar el formulario
    }
}

/* Mensajes generales de los formularios */

// Mostrar errores 
function mostrarError(elemento, mensaje) {
    const error = document.createElement("p");
    error.classList.add("mensajeError");
    error.style.color = "yellow";
    error.textContent = mensaje;
    elemento.insertAdjacentElement("afterend", error);
}

// Eliminar errores 
function eliminarErrores() {
    const errores = document.querySelectorAll("mensajeError");
    errores.forEach(error => error.remove());
}

// Escucha de los formularios y comienzo de las validaciones
document.addEventListener("DOMContentLoaded", () => {
    // Formulario de alta
    const formAlta = document.getElementById("formAlta");
    if (formAlta) {
        formAlta.addEventListener("submit", validarFormularioAlta);
    }

    // Formulario de modificación
    const formModificar = document.getElementById("formModificar");
    if (formModificar) {
        formModificar.addEventListener("submit", validarFormularioModificar);
    }
});
