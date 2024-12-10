import M_dashboard from "../modelo/m_dashboard.js"

class C_dashboard{

  constructor(panelAdmin){
    this.panelAdmin = panelAdmin
    console.log('2')
  }

  async cargarDatos(){
     const dashboard = new M_dashboard()
    dashboard.datosDashboard()
  }
}

export default C_dashboard
