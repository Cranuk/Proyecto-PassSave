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
            <span class="resaltar"><?=$usuario['alias']?></span>
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
            <a class="link-agregarSesion">
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
                            <?php $aliasUsuario =  Utilidades::aliasUsuario($sesion['usuario_id'])?>
                            <td><?=$sesion['usuario_id']?> / <?=$aliasUsuario['alias']?></td>
                            <td><?=$sesion['id'];?></td>
                        <?php endif;?>
                        <td><?=$sesion['fecha']?></td>
                        <td><?=$sesion['alias']?></td>
                        <td>
                            <div class="recuadro-bloques">
                                <span class="mensaje-blanco"><?=$sesion['email']?></td></span>
                                
                            </div>
                        <td>
                            <div class="relative">
                                <input type="hidden" value='<?=$sesion['id']?>' id='idSesion<?=$sesion['id']?>'> <!--NOTE: este input hidden es para tener el id de la sesion de manera oculta para usarlo en metodos JS-->
                                <input type="password" value='<?=$sesion['clave']?>' id='clave<?=$sesion['id']?>' readonly="readonly" class="seccion-clave">
                                <i class='bx bx-toggle-left ojo-sesion' id='ojo-sesion<?=$sesion['id']?>'></i>
                            </div>
                        </td>
                        <td>
                            <div class="recuadro-bloques">
                                <?php if($sesion['link'] != 'SC'):?>
                                    <a href="<?=$sesion['link']?>" target="_blank" title="ir a la pagina">
                                        <i class='bx bx-link icono-normal color-editar'></i>
                                    </a>
                                <?php endif;?>
                                    <span class="mensaje-blanco"><?=$sesion['pagina'];?></span>
                            </div>
                        </td>
                        <?php if (!$esAdmin):?>
                            <td>
                                <a title="editar" class="link-herramientas link-editarSesion" data-id='<?=$sesion['id']?>'>
                                    <div class="recuadro-bloques">
                                        <i class='bx bxs-edit-alt color-editar icono-normal'></i>
                                    </div>
                                </a>
                                <a title="borrar" class="link-herramientas link-borrarSesion" data-id='<?=$sesion['id']?>'>
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

<?php include 'php/plantilla/modales.php'; ?>