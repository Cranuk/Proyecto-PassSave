$(document).ready(function() {
    var url = 'http://propasssavephp/';
    
    $('#ojo-registro').on('click', function() {
        var clave = $('#clave');
        var claveRep = $('#claveRep');
        
        $(this).toggleClass('bx-toggle-right color-activo');
        
        if (clave.attr('type') === 'password') {
            clave.attr('type', 'text');
            claveRep.attr('type', 'text');
        } else {
            clave.attr('type', 'password');
            claveRep.attr('type', 'password');
        }
    });

    $('#form-registro').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: url + 'usuario/registrarUsuario',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response) {
                    alert('¡Registro exitoso!');
                    $('#form-registro')[0].reset();
                } else {
                    alert('Error al registrar el usuario. Inténtalo de nuevo.');
                }
            },
            error: function(response) {
                console.log('Error:', response.message);
            }
        });        
    });
});
