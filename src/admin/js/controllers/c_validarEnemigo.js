class C_validarEnemigo{

  constructor(formElement) {
    if (!formElement) {
      throw new Error("El formulario no existe en el DOM.")
    }

    this.formElement = formElement;
    this.nombreEnemigo = document.getElementById('nombreEnemigo')
    this.descripcionEnemigo = document.getElementById('descripcionEnemigo')
    this.habilidadesEnemigo = document.getElementById('habilidadesEnemigo')
    this.imagenesEnemigo = document.getElementById('imagenesEnemigo')
    this.enemigosContenedor = document.getElementById('enemigos')

    this.inicializarEventos()
  }

  inicializarEventos() {
    this.formElement.addEventListener('submit', (event) => this.validarFormulario(event))
  }

  validarFormulario(event) {
    event.preventDefault()
    this.limpiarErrores()

    let valido = true

    if (!this.nombreEnemigo.value.trim()) {
      valido = false
      this.mostrarError(this.nombreEnemigo, 'El nombre del enemigo es obligatorio')
    }

    if (this.descripcionEnemigo.value.trim().length < 10) {
      valido = false
      this.mostrarError(this.descripcionEnemigo, 'La descripción tiene que tener al menos 10 caracteres')
    }

    if (!this.habilidadesEnemigo.value) {
      valido = false
      this.mostrarError(this.habilidadesEnemigo, 'Debes seleccionar una habilidad')
    }

    if (!this.imagenesEnemigo.files.length) {
      valido = false
      this.mostrarError(this.imagenesEnemigo, 'Debes subir al menos una imagen')
    }else{
      if(!this.validarFormatoImagenes(this.imagenesEnemigo.files)){
        valido = false
      }
    }


    if (valido) {
      const formData = new FormData(this.formElement)
      const data = Object.fromEntries(formData.entries())
      console.log('Formulario válido: ', data)
      alert('Formulario enviado con éxito')
    }
  }

  mostrarError(elemento, mensaje) {
    const error = document.createElement('span')
    error.className = 'mensaje-error'
    error.style.color = 'red'
    error.style.fontSize = '0.9em'
    error.textContent = mensaje
    error.style.display = 'block'
    elemento.insertAdjacentElement('afterend', error)
  }

  limpiarErrores() {
    document.querySelectorAll('.mensaje-error').forEach(msg => msg.remove())
  }

  validarFormatoImagenes(files) {
    const formatosPermitidos = ['image/jpeg','image/png'];
    let valido = true
    
    Array.from(files).forEach(file =>{
      if(!formatosPermitidos.includes(file.type)){
        valido = false
        this.mostrarError(this.imagenesEnemigo, 'Formato de la imagen no permitido, solo se aceptan JPEG y PNG')
      }
    })

    return valido
  }
}

export default C_validarEnemigo
