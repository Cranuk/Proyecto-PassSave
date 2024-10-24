$(document).ready(function() {
    var url = 'http://propasssavephp/';
    var idSeleccionada = "";

    $('.link-borrarSesion').on('click', function() {
        let sesionId = $(this).data('id');
        let urlModalBorrar = url+'sesion/borrarSesion&sesion='+ sesionId;
        $('#modal-borrarSesion').removeClass('ocultar-modal').addClass('abrir-modal');
        $('#form-borrarSesion').attr('action', urlModalBorrar);
    });

    $('#button-borrarCancelar').on('click', function() {
        $('#modal-borrarSesion').removeClass('abrir-modal').addClass('ocultar-modal');
    });

    $('.link-agregarSesion').on('click', function(){
        $('#modal-agregarSesion').removeClass('ocultar-modal').addClass('abrir-modal');
    });

    $('.link-editarSesion').on('click', function(){
        let sesionId = $(this).data('id');
        $.ajax({
            type: "POST",
            url: url+"sesion/editarSesion",
            data: {id: sesionId},
            dataType: 'json',
            success: function (response) {
                console.log(response);

                $('#form-editarSesion').find('input[name="id"]').val(response.id);
                $('#form-editarSesion').find('input[name="alias"]').val(response.alias);
                $('#form-editarSesion').find('input[name="email"]').val(response.email);
                $('#form-editarSesion').find('input[name="clave"]').val(response.clave);
                $('#form-editarSesion').find('input[name="pagina"]').val(response.pagina);
                $('#form-editarSesion').find('input[name="link"]').val(response.link);

                $('#modal-editarSesion').removeClass('ocultar-modal').addClass('abrir-modal');
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos de la sesión:', error);
            }
        });
    });

    $('.ojo-sesion').on('click', function() {
        $('#modal-verClave').removeClass('ocultar-modal').addClass('abrir-modal');
        idSeleccionada = $(this).attr('id').replace('ojo-sesion', '');
    });

    $('#button-verCancelar').on('click', function() {
        $('#modal-verClave').removeClass('abrir-modal').addClass('ocultar-modal');
    });

    $('#form-verClave').on('submit', function(event){
        event.preventDefault();
        let claveIngresada = $('#clave').val();
        
        $.ajax({
            type: "POST",
            url: url + "sesion/claveVerificada",
            data: {
                clave: claveIngresada
            },
            success: function (response) {
                if (response) {
                    var ojoClave = $('#ojo-sesion' + idSeleccionada);
                    ojoClave.toggleClass('bx-toggle-right color-activo-claro');

                    var inputClave = $('#clave' + idSeleccionada);
                    if (inputClave.attr('type') === 'password') {
                        inputClave.attr('type', 'text');
                    } else {
                        inputClave.attr('type', 'password');
                    }
                    $('#form-verClave')[0].reset();
                    $('#modal-verClave').removeClass('abrir-modal').addClass('ocultar-modal');
                } else {
                    alert('Clave incorrecta');
                }
            }
        });
    });

    $('#form-agregarSesion').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: url + 'sesion/guardarSesion',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response) {
                    alert('¡Sesion guardada correctamente!');
                    $('#form-agregarSesion')[0].reset();
                } else {
                    alert('Error al registrar la sesion. Inténtalo de nuevo.');
                }
            },
            error: function(response) {
                console.log('Error:', response.message);
            }
        });        
    });

    $('#form-editarSesion').on('submit', function(event){
        event.preventDefault();
        
        $.ajax({
            url: url + 'sesion/actualizarSesion',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {                        
                if (response) {
                    alert('¡Sesion actualizada correctamente!');
                } else {
                    alert('Error al actualizar las sesion. Inténtalo de nuevo.');
                }
            },
            error: function(response) {
                console.log('Error:', response.message);
            }
        });        
    });

});