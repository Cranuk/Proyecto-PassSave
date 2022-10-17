'use strict'

function mostrarClaveRegistro(){
    var clave = document.querySelector('#clave');
    var claveRep = document.querySelector('#claveRep');
    var ojoClave = document.querySelector('#ojo-registro');
    
    ojoClave.classList.toggle('bx-toggle-right'); // NOTE: imagen de ocultar y mostrar clave
    ojoClave.classList.toggle('color-activo');
    let clave_campo = document.querySelector('#clave'); // NOTE: variable donde tiene el elemento
    let clave_rep_campo = document.querySelector('#claveRep');
    if(clave_campo.type == "password"){
        clave_campo.type = "text";
        clave_rep_campo.type = "text";
    }else{
        clave_campo.type = "password";
        clave_rep_campo.type = "password";
    }
}