import M_entidades from "../modelo/m_entidades.js"
import M_listarTareas from "../modelo/m_listarTablas.js"

class C_entidades {

  constructor(panelAdmin,selectEntidades){
    this.panelAdmin = panelAdmin
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

  manejarOption(valorSelect){
  
    const listarTablas = new M_listarTareas()
    listarTablas.listar(valorSelect)

  }




}
 
export default C_entidades
