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
        <form id="form-registro" class="form-registro">
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