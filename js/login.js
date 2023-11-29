'use strict'

function mostrarClaveLogin(){
    var clave = document.querySelector('#clave');
    var ojoClave = document.querySelector('#ojo-login');
    
    ojoClave.classList.toggle('bx-toggle-right'); // NOTE: imagen de ocultar y mostrar clave
    ojoClave.classList.toggle('color-activo');
    if(clave.type == "password"){
        clave.type = "text";
    }else{
        clave.type = "password";
    }
}

