import C_login from './controllers/c_login.js'
import C_validarEnemigo from './controllers/c_validarEnemigo.js'
import C_dashboard from './controllers/c_dashboard.js'
import C_entidades from './controllers/c_entidades.js'

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

  /*--------------------- PANEL ADMIN -------------------- */

  const panelAdmin = document.getElementById('mostrarDatosPanelAdmin')
  if(panelAdmin){
    const botonDashboard = document.getElementById('dashboard')
    if(botonDashboard){
      botonDashboard.addEventListener('click', function(event) {
        let dashboard = new C_dashboard(panelAdmin)
        dashboard.cargarDatos()
      })
    }

    const botonPersonajes = document.getElementById('personajes')
    if(botonPersonajes){
      botonPersonajes.addEventListener('click', function(event){
        console.log('HOLA')
        const entidades = new C_entidades(panelAdmin)
        entidades.crearSelect()
        })
      }
  }

})
