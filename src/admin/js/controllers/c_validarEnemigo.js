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
    this.mostrarImagen()
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

  mostrarImagen(){

    this.imagenesEnemigo.addEventListener('change', (event)=>{
      const archivos = event.target.files
      console.log('Va bien')

      if(archivos.length > 0){
        Array.from(archivos).forEach(archivo =>{
          const reader = new FileReader()
          
          reader.onload = function(e){
            const img = document.createElement('img')
            img.src = e.target.result
            img.className = 'img-enemigo'
            img.style.maxWidth = '100px'
            img.style.height = 'auto';
            contenedorImagenes.appendChild(img)
          }

          reader.readAsDataURL(archivo)
        })
      }
    })
 
  }
}

export default C_validarEnemigo
