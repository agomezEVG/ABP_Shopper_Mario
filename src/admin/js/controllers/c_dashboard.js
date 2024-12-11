import M_dashboard from "../modelo/m_dashboard.js"

class C_dashboard{

  constructor(panelAdmin){
    this.panelAdmin = panelAdmin
    console.log('2')
  }

  async cargarDatos(){
     const dashboard = new M_dashboard()
    const data = await dashboard.datosDashboard()
    this.mostrarDatos(data)

  }

  mostrarDatos(data){
      
    this.panelAdmin.innerHTML = ''

    const dashboardContainer = document.createElement('div')
    dashboardContainer.classList.add(`dashboard-container`)

    const totalPartidasDiv = this.crearDiv('Total Partidas: ', data.total_partidas)
    dashboardContainer.appendChild(totalPartidasDiv)
    panelAdmin.appendChild(dashboardContainer)
    
  }


  crearDiv(titulo, contenido){
    const contenedor = document.createElement('div')
    const encabezado = document.createElement('h3')
    encabezado.innerText = titulo
    const parrafo = document.createElement('p')
    parrafo.innerText = contenido


    contenedor.appendChild(encabezado)
    contenedor.appendChild(parrafo)
    return contenedor
  }
}

export default C_dashboard
