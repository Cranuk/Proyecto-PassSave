<!-- INICIO MENSAJES DE REGISTRO -->
<?php if(isset($sesionActualizada)):?>
    <section class="seccion-sesiones">
        <div class="recuadro-alertas">
            <?php if($sesionActualizada):?>
                <div class="resaltar alerta-aceptado">
                    <i class='bx bxs-check-circle icono-mediano color-activo'></i>
                    <br>
                    Sesion actualizada
                </div>
            <?php else:?>
                <div class="resaltar alerta-error">
                    <i class='bx bxs-error-circle icono-mediano color-activo'></i>
                    <br>
                    Error al actualizar la sesion
                </div>
            <?php endif;?>
        </div>
    </section>
<?php endif;?>
<!-- FIN DE MENSAJES DE REGISTRO -->

<!-- INICIO DE REGISTRO -->
<section class="seccion-sesiones">
    <div class="recuadro-modal">
        <div class="relative">
            <a href="<?=base_url?>sesion/misSesiones" title="Mis sesiones">
                <i class='bx bx-left-arrow-alt icono-mediano'></i>
            </a>
        </div>
        <div class="centro">
            <i class='bx bx-edit-alt icono-mediano color-activo'></i>
        </div>
        <form action="<?=base_url?>sesion/actualizarSesion" method="post" class="form-modal">
            <input type="hidden" name="id_sesion" value="<?=$sesionEditar['id_sesion']?>">
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias" value="<?=$sesionEditar['sen_alias']?>">

            <label for="correo">Correo</label>
            <input type="mail" name="correo" id="correo" value="<?=$sesionEditar['sen_correo']?>">

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" value="<?=$sesionEditar['sen_clave']?>">

            <label for="pagina">Nombre de la pagina</label>
            <input type="text" name="pagina" id="pagina" value="<?=$sesionEditar['sen_pagina']?>">

            <label for="enlace">Link de pagina</label>
            <input type="text" name="enlace" id="enlace" value="<?=$sesionEditar['sen_enlace']?>">

            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Guardar sesion" class="botones alerta-info">
            </div>
        </form>
    </div>
</section>
<!-- FIN DE REGISTRO -->