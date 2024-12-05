import C_login from './controllers/c_login.js'


document.getElementById('loginForm').addEventListener('submit', function(event){

    const form = event.target
    event.preventDefault()
    const formData = new FormData(form)
    const data = Object.fromEntries(formData.entries())
    const login = new C_login(data)
    console.log(form)
    login.validarInicioSesion(form)

     
})
