<!-- MODAL BORRAR SESION-->
<section class="seccion-modal" id="modal-borrarSesion">
    <div class="recuadro-modal">
        <div class="centro">
            <i class='bx bx-message-alt-x icono-mediano color-activo'></i>
        </div>
        <form id="form-borrarSesion" class="form-modal">
            <div class="resaltar">Desea eliminar esta sesion de manera permanente???</div>
            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Eliminar" class="botones alerta-info">
                <input type="button" value="Cancelar" class="botones alerta-error" id="button-borrarCancelar">
            </div>
            
        </form>
    </div>
</section>
<!-- FIN DE MODAL -->

<!-- MODAL AGREGAR SESION -->
<section class="seccion-modal" id="modal-agregarSesion">
    <div class="recuadro-modal">
        <div class="relative">
            <a href="<?=base_url?>sesion/misSesiones" title="Mis sesiones">
                <i class='bx bx-left-arrow-alt icono-mediano'></i>
            </a>
        </div>
        <div class="centro">
            <i class='bx bx-add-to-queue icono-mediano color-activo'></i>
        </div>
        <form id="form-agregarSesion" class="form-modal" >
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias">

            <label for="email">Email</label>
            <input type="mail" name="email" id="email" required>

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" required>

            <label for="pagina">Nombre de la pagina</label>
            <input type="text" name="pagina" id="pagina" required>

            <label for="link">Link de pagina</label>
            <input type="text" name="link" id="link">

            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Guardar sesion" class="botones alerta-info">
            </div>
        </form>
    </div>
</section>
<!-- FIN DE MODAL -->

<!-- MODAL EDITAR SESION-->
<section class="seccion-modal" id="modal-editarSesion">
    <div class="recuadro-modal">
        <div class="relative">
            <a href="<?=base_url?>sesion/misSesiones" title="Mis sesiones">
                <i class='bx bx-left-arrow-alt icono-mediano'></i>
            </a>
        </div>
        <div class="centro">
            <i class='bx bx-edit-alt icono-mediano color-activo'></i>
        </div>
        <form id="form-editarSesion" class="form-modal">
            <input type="hidden" name="id">
            <label for="alias">Alias</label>
            <input type="text" name="alias" id="alias">

            <label for="email">Email</label>
            <input type="mail" name="email" id="email">

            <label for="clave">Clave</label>
            <input type="text" name="clave" id="clave">

            <label for="pagina">Nombre de la pagina</label>
            <input type="text" name="pagina" id="pagina">

            <label for="link">Link de pagina</label>
            <input type="text" name="link" id="link">

            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Actualizar sesion" class="botones alerta-info">
            </div>
        </form>
    </div>
</section>
<!-- FIN DE MODAL -->