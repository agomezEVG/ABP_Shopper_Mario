class M_entidades{


  async datosDashboard(){


    try {

      const respuesta = await fetch('../../index.php?c=Paneladmin&m=listarTipos')
      const data = await respuesta.text()
      console.log(data)
    } catch (error) {

      console.error('Error: ',error)
    }
  }
}


export default M_entidades
