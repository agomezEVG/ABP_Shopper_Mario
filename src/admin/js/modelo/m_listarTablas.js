class M_listarTablas{


  async listar(valorSelect){


    try {


      const response =  await fetch(`../../index.php?c=panelAdmin&m=listar&v=${valorSelect}`,{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json' 
        },
        body: JSON.stringify({valor: valorSelect})
      })

      const data =  await response.text()
      console.log(data)
      

    } catch (error) {
      console.error()
    }
  }
}


export default M_listarTablas
