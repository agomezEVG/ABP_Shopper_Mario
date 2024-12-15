class   M_modificar{


  async  mandarModificacion(data){
    
    try{
      const response = await fetch('/shopperMario/src/admin/index.php?c=Modificar&m=modificar', {
        method:'POST',
        headers:{
          'Content-type': 'application-json',
        },
        body: JSON.stringify(data)
      })
      const resultado = response.json()
      

      console.log(resultado)
    
    }catch(error){
      console.error('Error en la solicitud del fetch: ',error)
    }

  
  }
    
  async eliminarPersonaje(id) {
        try {
      const response = await fetch('/shopperMario/src/admin/index.php?c=Modificar&m=borrar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'eliminar_personaje', // Puede ser la acción que quieras en tu backend
                    idPersonaje: id
                })
            }) 
      const data = response.json()
      

      console.log(data)
    
    }catch(error){
      console.error('Error en la solicitud del fetch: ',error)
    }

  
  }

}

export default M_modificar
