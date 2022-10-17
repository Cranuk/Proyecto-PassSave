<!-- INICIO MENSAJES DE REGISTRO -->
<?php if(isset($logeo)):?>
    <section class="seccion-login">
        <div class="recuadro-alertas">
            <?php if($logeo == false):?>
                <div class="alerta-error resaltar">
                    <i class='bx bxs-error-circle icono-mediano color-activo'></i>
                    <br>
                    Usuario y/o clave incorrectos
                </div>
            <?php endif;?>
        </div>
    </section>
<?php endif;?>
<!-- FIN DE MENSAJES DE REGISTRO -->

<!--LOGIN-->
    <section class="seccion-login">
        <div class="recuadro">
            <div class="centro">
                <i class='bx bxs-user-pin icono-mediano color-activo'></i>
            </div>
            <form action="<?=base_url?>usuario/logearUsuario" class="form-login" method="POST">
                <label for="">Alias</label>
                <input type="text" name="alias" id="alias">

                <label for="">Clave</label>
                <input type="password" name="clave" id="clave">
                <i class="bx bx-toggle-left ojo-login" id="ojo-login" onclick="mostrarClave()"></i>

                <div class="espacio-10"></div>
                <div class="recuadro-botones">
                    <input type="submit" value="Ingresar" class="botones alerta-info">
                </div>
                <div class="espacio-5"></div>
                
                <span class="letra-chica">No tienes usuario, <a href="<?=base_url?>usuario/registro" class="link-registro letra-chica">registrate</a></span>
            </form>
        </div>
    </section>
<!--FIN DE LOGIN-->