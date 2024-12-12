import M_entidades from "../modelo/m_entidades.js"
import M_listarTareas from "../modelo/m_listarTablas.js"

class C_entidades {

  constructor(panelAdmin){
    this.panelAdmin = panelAdmin
    this.contenedorTabla = document.createElement('div')
    this.contenedorTabla.id = 'contenedorTabla'
    console.log('MAURI vas bien')
  }

  async crearSelect(){

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
     const data =  await entidades.datosDashboard()
     data.forEach(item => {
          const option = document.createElement('option')
          option.value = item.tipo 
          option.textContent =item.nombre
          selectEntidades.appendChild(option)
      })

    selectEntidades.addEventListener('change',(event)=>{
      const valorSelect = event.target.value
      console.log('Has seleccionado, ',valorSelect)
      this.manejarOption(valorSelect)
    })
    
  }

  async manejarOption(valorSelect){
  
    const listarTablas = new M_listarTareas()
  let personajes = await listarTablas.listar(valorSelect)

    console.log(personajes)

    this.generarTabla(personajes)


  }

  generarTabla(personajes){

    this.panelAdmin.appendChild(this.contenedorTabla)
    this.contenedorTabla.innerHTML = ''

    if(personajes.mensaje){
      this.contenedorTabla.innerHTML  = `<h2>${personajes.mensaje}</h2>`
    }

    const table = document.createElement('table')
    const cabeceras = Object.keys(personajes[0])
    let theadHTML = '<thead><tr>'
    cabeceras.forEach(cabecera =>{

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
    //Delegación de Eventos
    this.contenedorTabla.addEventListener('click', (event)=>{
      if(event.target.classList.contains('btn-eliminar')){
        console.log(event.target.dataset.id)
      }
     if(event.target.classList.contains('btn-modificar')){
        console.log(event.target.dataset.id)
      }
    })
    }





}
 
export default C_entidades
