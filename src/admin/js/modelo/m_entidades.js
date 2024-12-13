class M_entidades{


  async datosDashboard(){


    try {
      const respuesta = await fetch('/shopperMario/src/admin/index.php?c=Paneladmin&m=listarTipos')
      const data = await respuesta.json()
      return data
    } catch (error) {

      console.error('Error: ',error)
    }
  }
}


export default M_entidades
