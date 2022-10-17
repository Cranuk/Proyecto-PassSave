<!-- INICIO MENSAJES DE REGISTRO -->
<?php if(isset($sesionGuardada)):?>
    <section class="seccion-sesiones">
        <div class="recuadro-alertas">
            <?php if($sesionGuardada):?>
                <div class="resaltar alerta-aceptado">
                    <i class='bx bxs-check-circle icono-mediano color-activo'></i>
                    <br>
                    Sesion guardada
                </div>
            <?php else:?>
                <div class="resaltar alerta-error">
                    <i class='bx bxs-error-circle icono-mediano color-activo'></i>
                    <br>
                    Error al guardar la sesion
                </div>
            <?php endif;?>
        </div>
    </section>
<?php endif;?>
<!-- FIN DE MENSAJES DE REGISTRO -->

<!-- INICIO DE AGREGAR SESION-->
<section class="seccion-sesiones">
    <div class="recuadro-modal">
        <div class="relative">
            <a href="<?=base_url?>sesion/misSesiones" title="Mis sesiones">
                <i class='bx bx-left-arrow-alt icono-mediano'></i>
            </a>
        </div>
        <div class="centro">
            <i class='bx bx-add-to-queue icono-mediano color-activo'></i>
        </div>
        <form action="<?=base_url?>sesion/guardarSesion" method="post" class="form-modal">
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias">

            <label for="correo">Correo</label>
            <input type="mail" name="correo" id="correo" required>

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" required>

            <label for="pagina">Nombre de la pagina</label>
            <input type="text" name="pagina" id="pagina" required>

            <label for="enlace">Link de pagina</label>
            <input type="text" name="enlace" id="enlace">

            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Guardar sesion" class="botones alerta-info">
            </div>
        </form>
    </div>
</section>
<!-- FIN DE AGREGAR SESION -->