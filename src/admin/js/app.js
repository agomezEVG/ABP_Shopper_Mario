import C_login from './controllers/c_login.js'
import C_validarEnemigo from './controllers/c_validarEnemigo.js'

window.addEventListener('DOMContentLoaded', () => {



  /*--------------------- PÁGINA INICIO DE SESIÓN --------------------- */

    const loginForm = document.getElementById('loginForm')

  if(loginForm){

    loginForm.addEventListener('submit', function(event) {
          event.preventDefault()

          const formData = new FormData(loginForm)
          const data = Object.fromEntries(formData.entries())
          const login = new C_login(data)
          login.validarInicioSesion(loginForm)
      })

      const checkbox = document.getElementById('showPasswd')
      const passwd = document.getElementById('passwd')

      const visibilidadPassword = () => {
          passwd.type = checkbox.checked ? 'text' : 'password';
      }

      visibilidadPassword() // Para si se recarga la página con el check pulsado
      checkbox.addEventListener('click', visibilidadPassword)

  }

  
  /*--------------------- PÁGINA INSERTAR ENEMIGOS --------------------- */

    const enemyForm = document.getElementById('formInsertEnemigo')

  if(enemyForm){
        new C_validarEnemigo(enemyForm)
      }

  if(imagenesEnemigo && contenedorImagenes){

    imagenesEnemigo.addEventListener('change', (event)=>{
      const archivos = event.target.files
      console.log(archivos)

      if(archivos.length > 0){
        Array.from(archivos).forEach(archivo =>{
          const reader = new FileReader()
          
          reader.onload = function(e){
            const img = document.createElement('img')
            img.src = e.target.result
            img.className = 'img-enemigo'
            img.style.maxWidth = '100px'
            img.style.height = 'auto';
            contenedorImagenes.appendChild(img)
          }

          reader.readAsDataURL(archivo)
        })
      }
    })
    
  
  } 



})
