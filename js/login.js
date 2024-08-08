$(document).ready(function() {
    $('#ojo-login').on('click', function() {
        var clave = $('#clave');
        $(this).toggleClass('bx-toggle-right color-activo');
        
        if (clave.attr('type') === 'password') {
            clave.attr('type', 'text');
        } else {
            clave.attr('type', 'password');
        }
    });
});