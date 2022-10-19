<?php 
    $usuario = $_SESSION['usuario']; //NOTE: almacenamos en una variable los datos del usuario de la sesion activa
    $esAdmin = Utilidades::esAdmin(); //NOTE: nos cromprueba que tenga los niveles requeridos
    if($esAdmin){
        $cantidadSesiones = Utilidades::cantidadSesionesAdmin(); //NOTE: nos trae el total de sesiones en la pagina
    }else{
        $cantidadSesiones = Utilidades::cantidadSesiones(); //NOTE: nos trae la cantidad de sesiones que tenga el usuario
    }
?>
<!-- INICIO DEL NAVEGADOR -->
<section class="seccion-navegacion">
    <div class="recuadro recuadro-espaciado">
        <div class="recuadro-bloques">
            <i class='bx bxs-user-circle icono-normal color-activo'></i>
            <span class="resaltar"><?=$usuario['usos_alias']?></span>
        </div>
        <?php if($esAdmin):?>
            <div class="recuadro-bloques"><!--NOTE: usar un helpers para saber la cantidad de sesiones de usuario especifico-->
                <i class='bx bx-stats icono-normal color-activo'></i>
                <span class="resaltar">sesiones activas:<?=$cantidadSesiones['cantidad']?></span>
            </div>
        <?php else:?>
            <div class="recuadro-bloques"><!--NOTE: usar un helpers para saber la cantidad de sesiones de usuario especifico-->
                <i class='bx bx-stats icono-normal color-activo'></i>
                <span class="resaltar">sesiones:<?=$cantidadSesiones['cantidad']?></span>
            </div>
            <a href="<?=base_url?>sesion/agregarSesion">
                <div class="recuadro-bloques">
                    <i class='bx bxs-add-to-queue icono-normal color-activo'></i>
                    <span class="resaltar">Agregar sesion</span>
                </div>
            </a>
        <?php endif;?>
        <a href="<?=base_url?>usuario/deslogearUsuario">
            <div class="recuadro-bloques">
                <i class='bx bxs-log-in-circle icono-normal color-activo'></i>
                <span class="resaltar">salir</span>
            </div>
        </a>
    </div>
</section>
<!-- FIN DEL NAVEGADOR -->

<!-- INICIO DE LA TABLA -->
<section class="seccion-sesiones">
    <?php if($misSesiones):?>
        <table>
            <thead>
                <tr>
                    <?php if ($esAdmin):?> <!--NOTE: este fragmento de codigo es visible para admin para temas de control-->
                        <th>Id/Usuario</th>
                        <th>Id Sesion</th>
                    <?php endif;?>
                    <th>Ultima Actualizacion</th>
                    <th>Alias</th>
                    <th>Correo</th>
                    <th>Clave</th>
                    <th>Pagina</th>
                    <?php if (!$esAdmin):?> <!--NOTE: este fragmento de codigo es visible para admin para temas de control-->
                        <th>Herramientas</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($misSesiones as $sesion):?>
                    <tr>
                        <?php if ($esAdmin):?> <!--NOTE: este fragmento de codigo es visible para admin para temas de control-->
                            <?php $aliasUsuario =  Utilidades::aliasUsuario($sesion['sen_idUsuario'])?>
                            <td><?=$sesion['sen_idUsuario']?> / <?=$aliasUsuario['alias']?></td>
                            <td><?=$sesion['id_sesion'];?></td>
                        <?php endif;?>
                        <td><?=$sesion['sen_fecha']?></td>
                        <td><?=$sesion['sen_alias']?></td>
                        <td>
                            <div class="recuadro-bloques">
                                <span class="mensaje-blanco"><?=$sesion['sen_correo']?></td></span>
                                
                            </div>
                        <td>
                            <div class="relative">
                                <input type="hidden" value='<?=$sesion['id_sesion']?>' id='idSesion<?=$sesion['id_sesion']?>'> <!--NOTE: este input hidden es para tener el id de la sesion de manera oculta para usarlo en metodos JS-->
                                <input type="password" value='<?=$sesion['sen_clave']?>' id='clave<?=$sesion['id_sesion']?>' readonly="readonly" class="seccion-clave">
                                <i class='bx bx-toggle-left ojo-sesion' id='ojo-sesion<?=$sesion['id_sesion']?>' onclick="mostrarClave(<?=$sesion['id_sesion']?>)"></i>
                            </div>
                        </td>
                        <td>
                            <div class="recuadro-bloques">
                                <a href="<?=$sesion['sen_enlace']?>" target="_blank" title="ir a la pagina">
                                    <i class='bx bx-link icono-normal color-editar'></i>
                                </a>
                                <span class="mensaje-blanco"><?=$sesion['sen_pagina']?></span>
                            </div>
                        </td>
                        <?php if (!$esAdmin):?>
                        <td>
                            <a href="<?=base_url?>sesion/editarSesion&sesion=<?=$sesion['id_sesion']?>" title="editar" class="link-herramientas">
                                <div class="recuadro-bloques">
                                    <i class='bx bxs-edit-alt color-editar icono-normal' ></i>
                                </div>
                            </a>
                            <a href="#" onclick=abrirModal() title="borrar" class="link-herramientas">
                                <div class="recuadro-bloques">
                                    <i class='bx bxs-eraser color-borrar icono-normal'></i>
                                </div>
                            </a>
                        </td>
                        <?php endif;?>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    <?php else:?>
        <div class="recuadro-alertas">
            <div class="mensaje-sesion alerta-advertencia">
                <i class='bx bxs-info-circle icono-mediano color-activo'></i>
                <br>
                No tienes sesiones guardadas
            </div>
        </div>
    <?php endif;?>
</section>
<!-- FIN DE LA TABLA -->

<!-- INICIO DE MODAL-->
<section class="seccion-modal" id="modal-borrarSesion">
    <div class="recuadro-modal">
        <div class="centro">
            <i class='bx bx-message-alt-x icono-mediano color-activo'></i>
        </div>
        <form action="<?=base_url?>sesion/borrarSesion&sesion=<?=$sesion['id_sesion']?>" method="post" class="form-modal">
            <div class="resaltar">Desea eliminar esta sesion de manera permanente???</div>
            <div class="espacio-10"></div>
            <div class="recuadro-botones">
                <input type="submit" value="Eliminar" class="botones alerta-info">
                <input type="button" value="Cancelar" onclick=cerrarModal() class="botones alerta-error">
            </div>
            
        </form>
    </div>
</section>
<!-- FIN DE MODAL -->