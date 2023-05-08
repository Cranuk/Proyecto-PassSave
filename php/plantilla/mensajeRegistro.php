<!-- INICIO MENSAJES DE REGISTRO -->
<?php if(isset($registro)):?>
    <section class="seccion-registro">
        <div class="recuadro-alertas">
            <?php if($registro):?>
                <div class="resaltar alerta-aceptado">
                    <i class='bx bxs-check-circle icono-mediano color-activo'></i>
                    <br>
                    Usuario registrado
                </div>

                <?php 
                /* TODO: esto se usa al tenerlo hosteado en un servidor web    
                    $cabecera = "MIME-Version: 1.0" . "\r\n";
                    $cabecera .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    $para = "crackenfx2@gmail.com";
                    $asunto = "Registro de nuevo usuario";
                    $mensaje = 
                    "<html>
                        <head>
                            <title>Aviso de nuevo registro de usuario</title>
                        </head>
                        <body>
                            <h3>ADMIN un nuevo ingreso al sistema PassSave</h3>
                            <p>Se registro un nuevo usuario para el uso de nuestro sistema</p>
                        </body>
                    </html>";

                    mail($para, $asunto, $mensaje, $cabecera);
                */
                ?>

            <?php else:?>
                <div class="resaltar alerta-error">
                    <i class='bx bxs-error-circle icono-mediano color-activo'></i>
                    <br>
                    Error al registrarse
                </div>
            <?php endif;?>
        </div>
    </section>
<?php endif;?>
<!-- FIN DE MENSAJES DE REGISTRO -->