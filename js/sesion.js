'use strict'

function abrirModal(){
    let modal = document.querySelector('#modal-borrarSesion');
    modal.classList.add('abrir-modal');
    modal.classList.remove('ocultar-modal');
}

function cerrarModal(){
    let cerrar = document.querySelector('#modal-borrarSesion');
    cerrar.classList.remove('abrir-modal');
    cerrar.classList.add('ocultar-modal');
}

function mostrarClave(valor){ // NOTE: ese parametro hace referencia al id de la sesion seleccionada por el usuario
    var idSesion = document.querySelector('#idSesion'+valor).value; // NOTE: obtenemos el valor del input con el id de la sesion
    var clave = document.querySelector('#clave'+valor);
    
    console.log(valor);
    console.log(idSesion);
    if(valor == idSesion){ // NOTE: comprobamos que sea la sesion mediante su id la que deseamos ver la clave de sesion
        let ojoClave = document.querySelector('#ojo-sesion'+valor);
        ojoClave.classList.toggle('bx-toggle-right'); // NOTE: imagen de ocultar y mostrar clave
        ojoClave.classList.toggle('color-activo-claro');
        if(clave.type == "password"){
            clave.type = "text";
        }else{
            clave.type = "password";
        }
    }else{
        console.log('error al mostrar clave');
    }

}