import C_login from './controllers/c_login.js'


document.getElementById('loginForm').addEventListener('submit', function(event){

    const form = event.target
    event.preventDefault()
    const formData = new FormData(form)
    const data = Object.fromEntries(formData.entries())
    const login = new C_login(data)
    login.validarInicioSesion(form)

     
})

window.addEventListener('DOMContentLoaded', (event) => {
  const checkbox = document.getElementById('showPasswd')
  const passwd = document.getElementById('passwd')

  if (checkbox.checked) {
    passwd.type = 'text'
  } else {
    passwd.type = 'password'
  }

  checkbox.addEventListener('click', function(event) {
    if (checkbox.checked) {
      passwd.type = 'text'
    } else {
      passwd.type = 'password'
    }
  });
});
