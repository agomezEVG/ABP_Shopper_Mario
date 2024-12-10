/**
 * Función para validar los campos de correo y contraseña. 
 * Recibe un campo de entrada, un elemento para mostrar el mensaje de error, 
 * un valor booleano que indica si el campo es válido y el mensaje de error.
 */
function validarCampos(inputElement, messageElement, isValid, message) {
    messageElement.textContent = isValid ? '' : message; // Se muestra vacío si es válido, si no lo es, muestra el mensaje de error
}

/**
 * Función para validar el campo de correo.
 * Esta función verifica si el correo introducido cumple con el formato estándar.
 * Se utiliza una expresión regular para validar el correo en tiempo real mientras el usuario escribe.
 */
function validarEmail() { 
    const emailInput = document.getElementById('user'); // Obtiene el campo de correo
    const message = document.getElementById('message'); // Obtiene el elemento donde se muestra el mensaje de error
    const emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/; // Expresión regular para validar el formato del correo (Regex = Expresión regular)

    emailInput.addEventListener('input', () => { // Añade un evento para validar mientras el usuario escribe
        validarCampos(emailInput, message, emailRegex.test(emailInput.value), 'Correo no válido'); // Llama a la función de validación
    });
}

/**
 * Función para validar el campo de contraseña y la confirmación de la misma.
 * Compara si ambas contraseñas coinciden y muestra un mensaje de error si no lo hacen.
 */
function validarPassword() { 
    const passwordInput = document.getElementById('passwd'); // Obtiene el campo de la contraseña
    const repeatPasswordInput = document.getElementById('passwdRepeat'); // Obtiene el campo de repetir la contraseña
    const message = document.getElementById('message'); // Obtiene el elemento donde se muestra el mensaje de error

    repeatPasswordInput.addEventListener('input', () => { // Añade un evento para validar mientras el usuario escribe
        const isValid = passwordInput.value === repeatPasswordInput.value; // Compara si ambas contraseñas coinciden
        validarCampos(repeatPasswordInput, message, isValid, 'Las contraseñas no coinciden'); // Llama a la función de validación
    });
}

/**
 * Función que se ejecuta cuando se carga la página.
 * Se llama a las funciones de validación de correo y contraseña.
 */
window.onload = () => { 
    validarEmail(); // Llama a la función para validar el correo
    validarPassword(); // Llama a la función para validar las contraseñas
};