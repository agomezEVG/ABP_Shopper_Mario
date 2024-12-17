
// Validación formulario alta objetos
function validarFormularioAlta(event) {
    let isValid = true;

    const nombre = document.getElementById("nombre");
    const nombreError = document.getElementById("nombreError");
    if (!nombre.value.trim()) {
        if (!nombreError) { //Crea el elemento si no existe ya un campo error
            const error = document.createElement("p");
            error.id = "nombreError";
            error.style.color = "red";
            error.textContent = "El nombre del objeto es obligatorio.";
            nombre.insertAdjacentElement("afterend", error); // Añade el campo justo despues del campo "nombre"
        }
        isValid = false;
    } else {
        if (nombreError) nombreError.remove();
    }

    if (!isValid) event.preventDefault();
}

// Validación formulario modificar objetos
function validarFormularioModificar(event) {
    let isValid = true;

    const descripcion = document.getElementById("descripcionMod");
    const descripcionError = document.getElementById("descripcionModError");
    if (!descripcion.value.trim()) {
        if (!descripcionError) {
            const error = document.createElement("p");
            error.id = "descripcionModError";
            error.style.color = "red";
            error.textContent = "La descripción no ha sido rellenada.";
            descripcion.insertAdjacentElement("afterend", error);
        }
        isValid = false;
    } else {
        if (descripcionError) descripcionError.remove();
    }

    if (!isValid) event.preventDefault();
}

// Inicializar validación según formulario
document.addEventListener("DOMContentLoaded", () => {
    const formAlta = document.querySelector("#formAlta");
    const formModificar = document.querySelector("#formModificar");

    if (formAlta) {
        formAlta.addEventListener("submit", validarFormularioAlta);
    }

    if (formModificar) {
        formModificar.addEventListener("submit", validarFormularioModificar);
    }
});
