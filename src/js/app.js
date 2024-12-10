import C_validarNPC from "./controllers/c_validarNPC.js";

formulario.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(formulario);
    const data = Object.fromEntries(formData.entries());

    const c_validarNPC = new C_validarNPC(data);

    // Validar datos
    if (c_validarNPC.validar()) {
        console.log("Datos válidos:", data);
        document.getElementById('resultado').innerText = "NPC registrado correctamente.";
    } else {
        mostrarErrores(c_validarNPC.errores);
    }
});

function mostrarErrores(errores) {
    const campos = ['nombre', 'descripcion', 'mensaje'];

    campos.forEach(campo => {
        const errorSpan = document.getElementById(`error-${campo}`);
        if (errores[campo]) {
            errorSpan.textContent = errores[campo];
        } else {
            errorSpan.textContent = '';
        }
    });
}