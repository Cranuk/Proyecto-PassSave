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

<!-- INICIO DE REGISTRO -->
<section class="seccion-registro">
    <div class="recuadro">
        <div class="relative">
            <a href="<?=base_url?>usuario/login" title="Ir al login">
                <i class='bx bx-left-arrow-alt icono-mediano'></i>
            </a>
        </div>
        <div class="centro">
            <i class='bx bx-user-plus icono-mediano color-activo'></i>
        </div>
        <form action="<?=base_url?>usuario/registrarUsuario" class="form-registro" method="POST">
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias" required>

            <label for="clave">Clave</label>
            <i class="bx bx-toggle-left ojo-registro" id="ojo-registro" onclick="mostrarClaveRegistro()"></i>
            <input type="password" name="clave" id="clave" required>

            <label for="repClave">Repetir clave</label>
            <input type="password" name="claveRep" id="claveRep" required>
            
            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Registrarse" class="botones alerta-info">
            </div>
        </form>
    </div>
</section>
<!-- FIN DE REGISTRO -->