class C_validarNPC {
    constructor(data) {
        this.nombre = data.nombre;
        this.descripcion = data.descripcion;
        this.mensaje = data.mensaje;
        this.errores = {}; // Almacena los mensajes de error por campo
    }

    validar() {
        const regexSoloLetras = /^[a-zA-Z\s]+$/;

        this.errores = {};

        // Validar nombre
        if (!this.nombre) {
            this.errores.nombre = "El nombre no puede estar vacío.";
        } else if (!regexSoloLetras.test(this.nombre)) {
            this.errores.nombre = "El nombre solo puede contener letras y espacios.";
        } else if (this.nombre.length < 2) {
            this.errores.nombre = "El nombre debe tener al menos 2 caracteres.";
        } else if (this.nombre.length > 50) {
            this.errores.nombre = "El nombre no puede tener más de 50 caracteres.";
        }

        // Validar descripción
        if (!this.descripcion) {
            this.errores.descripcion = "La descripción no puede estar vacía.";
        } else if (!regexSoloLetras.test(this.descripcion)) {
            this.errores.descripcion = "La descripción solo puede contener letras y espacios.";
        } else if (this.descripcion.length < 25) {
            this.errores.descripcion = "La descripción debe tener al menos 25 caracteres.";
        } else if (this.descripcion.length > 100) {
            this.errores.descripcion = "La descripción no puede tener más de 100 caracteres.";
        }

        // Validar diálogo
        if (!this.mensaje) {
            this.errores.mensaje = "El diálogo no puede estar vacío.";
        } else if (this.mensaje.length < 25) {
            this.errores.mensaje = "El diálogo debe tener al menos 25 caracteres.";
        } else if (this.mensaje.length > 300) {
            this.errores.mensaje = "El diálogo no puede tener más de 300 caracteres.";
        }

        return Object.keys(this.errores).length === 0;
    }
}

export default C_validarNPC;