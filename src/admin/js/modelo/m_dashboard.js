class M_dashboard{


  async datosDashboard(){


    try {
      console.log('3')
      const respuesta = await fetch('../../index.php?c=Dashboard&m=llamada')

      const data = await respuesta.text()
      console.log(data)
    } catch (error) {
      
    }
  }
}


export default M_dashboard
