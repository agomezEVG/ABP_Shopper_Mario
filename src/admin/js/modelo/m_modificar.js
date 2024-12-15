class   M_modificar{


  constructor(data){
    this.data = data
  }
  async  mandarModificacion(){
    
    try{
      const response = await fetch('/shopperMario/src/admin/index.php?c=Modificar&m=modificar', {
        method:'POST',
        headers:{
          'Content-type': 'application-json',
        },
        body: JSON.stringify(this.data)
      })
      const data = response.json()
      

      console.log(data)
    
    }catch(error){
      console.error('Error en la solicitud del fetch: ',error)
    }

  
  }
}

export default M_modificar
