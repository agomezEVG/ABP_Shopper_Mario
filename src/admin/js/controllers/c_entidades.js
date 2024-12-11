import M_entidades from "../modelo/m_entidades.js"

class C_entidades {

  constructor(panelAdmin){
    this.panelAdmin = panelAdmin
    console.log('MAURI vas bien')
    this.cargarDatos()
  }

  async cargarDatos(){
      const entidades = new M_entidades()
      entidades.datosDashboard()
  }

}
 
export default C_entidades
