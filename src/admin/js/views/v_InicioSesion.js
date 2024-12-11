
function mostrarContraseña() {

    const checkbox = document.getElementById('showPasswd');
    const passwd = document.getElementById('passwd');
    
    const visibilidadPassword = () => {
        passwd.type = checkbox.checked ? 'text' : 'password';
    }
    
    visibilidadPassword() // Para si se recarga la página con el check pulsado
    checkbox.addEventListener('click', visibilidadPassword);
}