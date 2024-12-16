import C_validarNPC from "./controllers/c_validarNPC.js";

formulario.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(formulario); // Obtener datos del formulario
    const data = Object.fromEntries(formData.entries()); // Convertir a objeto

    const c_validarNPC = new C_validarNPC(data); // Instanciar controlador

    // Validar datos
    if (c_validarNPC.validar()) { // Si los datos son válidos
        console.log("Datos válidos:", data); 
        document.getElementById('resultado').innerText = "NPC registrado correctamente.";
    } else { // Si los datos no son válidos
        mostrarErrores(c_validarNPC.errores);
    }
});

function mostrarErrores(errores) {
    const campos = ['nombre', 'descripcion', 'mensaje']; // Campos del formulario

    campos.forEach(campo => { // Recorrer campos
        const errorSpan = document.getElementById(`error-${campo}`); // Obtener span de error
        if (errores[campo]) { // Si hay error en el campo
            errorSpan.textContent = errores[campo]; // Mostrar mensaje de error
        } else { // Si no hay error en el campo
            errorSpan.textContent = ''; // Ocultar mensaje de error
        }
    });
}