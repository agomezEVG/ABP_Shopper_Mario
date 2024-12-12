class M_listarTablas{


  async listar(valorSelect){


    try {


      const response =  await fetch('../../index.php?c=Entidades&m=listarTipos',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify({valor: valorSelect})
      })

      const data =  await response.json()
      console.log(data)
      

    } catch (error) {
      console.error(error)
    }
  }
}


export default M_listarTablas
