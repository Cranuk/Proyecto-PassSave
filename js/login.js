'use strict'

function mostrarClave(){
    var clave = document.querySelector('#clave');
    var ojoClave = document.querySelector('#ojo-login');
    
    ojoClave.classList.toggle('bx-toggle-right'); // NOTE: imagen de ocultar y mostrar clave
    ojoClave.classList.toggle('color-activo');
    let clave_campo = document.querySelector('#clave'); // NOTE: variable donde tiene el elemento
    if(clave_campo.type == "password"){
        clave_campo.type = "text";
    }else{
        clave_campo.type = "password";
    }
}

