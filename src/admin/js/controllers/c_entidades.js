import M_entidades from "../modelo/m_entidades.js"
import M_listarTareas from "../modelo/m_listarTablas.js"
import C_validarEnemigo from './c_validarEnemigo.js'

class C_entidades {

  constructor(panelAdmin) {
    this.panelAdmin = panelAdmin
    this.contenedorTabla = document.createElement('div')
    this.contenedorTabla.id = 'contenedorTabla'
  }

  async crearSelect() {
    this.panelAdmin.innerHTML = ''
    const selectEntidades = document.createElement('select')     

    selectEntidades.id = 'select-entidades'
    panelAdmin.appendChild(selectEntidades)

    const defaultOption = document.createElement('option')
    defaultOption.value = ''
    defaultOption.textContent = 'Elige'
    selectEntidades.appendChild(defaultOption)
    this.panelAdmin.appendChild(selectEntidades)
    const entidades = new M_entidades()
    const data = await entidades.datosDashboard()
    data.forEach(item => {
      const option = document.createElement('option')
      option.value = item.tipo 
      option.textContent = item.nombre
      selectEntidades.appendChild(option)
    })

    selectEntidades.addEventListener('change', (event) => {
      const valorSelect = event.target.value
      console.log('Has seleccionado, ', valorSelect)
      this.manejarOption(valorSelect, data)
    })
  }

  async manejarOption(valorSelect, data) {
    const listarTablas = new M_listarTareas()
    let personajes = await listarTablas.listar(valorSelect)

    console.log(personajes)

    this.generarTabla(personajes, data)
  }

  generarTabla(personajes, data) {
    this.panelAdmin.appendChild(this.contenedorTabla)
    this.contenedorTabla.innerHTML = ''

    if (personajes.mensaje) {
      this.contenedorTabla.innerHTML = `<h2>${personajes.mensaje}</h2>`
    }

    const table = document.createElement('table')
    const cabeceras = Object.keys(personajes[0]).filter(cabecera => cabecera !== 'idPersonaje')
    let theadHTML = '<thead><tr>'
    cabeceras.forEach(cabecera => {
      theadHTML += `<th>${cabecera.toUpperCase()}</th>`
    })
    theadHTML += '<th>ACCIONES</th></thead>'

    table.innerHTML = theadHTML

    const tbody = document.createElement('tbody')
    personajes.forEach(personaje => {
      const fila = document.createElement('tr')
      cabeceras.forEach(cabecera => {
        const celda = document.createElement('td')
        if (cabecera === 'url' && personaje[cabecera]) {
          const imagenDiv = document.createElement('div')
          const imagen = document.createElement('img')
          imagen.src = personaje[cabecera]
          imagen.alt = 'Imagen del personaje'
          imagen.style.width = '100px' 
          imagen.style.height = 'auto'
          imagenDiv.appendChild(imagen)
          celda.appendChild(imagenDiv)
        } else {
          celda.textContent = personaje[cabecera]
        } 
        fila.appendChild(celda)
      })
      const actionCell = document.createElement('td')
      actionCell.classList.add('action-buttons')
      actionCell.innerHTML = `
          <button class="btn btn-eliminar" data-id="${personaje.idPersonaje}">Eliminar</button>
          <button class="btn btn-modificar" data-id="${personaje.idPersonaje}">Modificar</button>
      `
      fila.appendChild(actionCell)

      tbody.appendChild(fila)
    })
     
    table.appendChild(tbody)
    this.contenedorTabla.appendChild(table)
    // Delegación de Eventos
    this.contenedorTabla.addEventListener('click', (event) => {
      if (event.target.classList.contains('btn-eliminar')) {
        const id = event.target.dataset.id
        this.generarFormulario(personajes)
      }
      if (event.target.classList.contains('btn-modificar')) {
        console.log(event.target.dataset.id)
        const id = event.target.dataset.id
        const personajeSeleccionado = personajes.find(p => p.idPersonaje == id)
        this.generarFormulario(personajeSeleccionado, data)
      }
    })
  }

  generarFormulario(personaje, data) {
  let modal = document.getElementById('modal')
  if (!modal) {
    modal = document.createElement('div')
    modal.id = 'modal'
    modal.className = 'modal hidden'
    modal.innerHTML = `
      <div class="modal-content">
        <span class="close-button">&times;</span>
        <div id="modal-body"></div>
        <div class="modal-footer">
            <button id="guardar-cambios" class="btn">Guardar Cambios</button>
        </div>
      </div>`
    document.body.appendChild(modal)
  }

  const modalBody = document.getElementById('modal-body')
  modalBody.innerHTML = ''

  const formulario = document.createElement('form')
  formulario.id = 'formulario-modificar'

  Object.keys(personaje).forEach(key => {
    const label = document.createElement('label')
    label.textContent = key === 'url' ? 'IMAGENES' : key.toUpperCase()
    label.setAttribute('for', key)

    let input
    if (key === 'nombre') {
      input = document.createElement('input')
      input.type = 'text'
      input.name = key // Importante: añadir el atributo name
      input.value = personaje[key]
    } else if (key === 'descripcion') {
      input = document.createElement('textarea')
      input.name = key // Añadir name
      input.value = personaje[key]
    } else if (key === 'tipo') {
      input = document.createElement('select')
      input.name = key // Añadir name
      data.forEach(valor => {
        const option = document.createElement('option')
        option.value = valor.tipo
        option.textContent = valor.nombre
        if (valor.tipo === personaje[key]) {
          option.selected = true
        }
        input.appendChild(option)
      })
    } else if (key === 'url') {
      input = document.createElement('input')
      input.type = 'file'
      input.name = key // Añadir name
      input.multiple = true
    } else {
      input = document.createElement('input')
      input.type = 'text'
      input.name = key // Añadir name
      input.value = personaje[key] || ''
      input.readOnly = true
    }
    input.id = key
    formulario.appendChild(label)
    formulario.appendChild(input)
    formulario.appendChild(document.createElement('br'))
  })

  modalBody.appendChild(formulario)

  modal.classList.remove('hidden')

  const closeButton = modal.querySelector('.close-button')
  closeButton.onclick = () => {
    modal.classList.add('hidden')
  }

const guardarCambios = modal.querySelector('#guardar-cambios')
guardarCambios.addEventListener('click', (event) => {
  event.preventDefault() 
const valido = new C_validarEnemigo(formulario).validarFormulario()
  if (valido) {
    const formData = new FormData(formulario)
    const data = Object.fromEntries(formData.entries())
    console.log(data) 
    modal.classList.add('hidden')

  }
}) 
  this.contenedorTabla.appendChild(modal)
}}
 
export default C_entidades
