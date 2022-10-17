<?php
require_once 'php/modelo/sesionModelo.php';

class sesionControlador{
    public function misSesiones(){
        $datosUsuario = $_SESSION['usuario'];
        $logeado = Utilidades::logeado(); //NOTE: esto es para que solo tenga acceso solo los que esten logeados
        $esAdmin = Utilidades::esAdmin($datosUsuario['id_usuario']); //NOTE: aqui verificamos que si es un admin
        if($logeado){
            $dato = new sesionModelo();
            $dato -> setIdUsuario($datosUsuario['id_usuario']);
            if($esAdmin){
                $misSesiones = $dato -> obtenerSesionesAdmin();
                require_once 'php/plantilla/misSesiones.php';
            }else{
                $misSesiones = $dato -> obtenerSesionesUsuario();
                require_once 'php/plantilla/misSesiones.php';
            }
        }else{
            header('Location:'.base_url);
        }
    }

    public function agregarSesion(){
        $logeado = Utilidades::logeado();
        if ($logeado) {
            require_once 'php/plantilla/agregarSesion.php';
        }else{
            header('Location:'.base_url);
        }
    }

    public function borrarSesion(){ //NOTE: llevamos a cabo la eliminacion de la sesion de un usuario
        $logeado = Utilidades::logeado();
        if ($logeado) {
            $id_sesion = $_GET['sesion'];
            $datosUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdSesion($id_sesion);
            $dato -> setIdUsuario($datosUsuario['id_usuario']);
            $sesionBorrar = $dato -> borrarSesion();
            $misSesiones = $dato -> obtenerSesionesUsuario();
            require_once 'php/plantilla/misSesiones.php';
        }else{
            header('Location:'.base_url);
        }
    }

    public function editarSesion(){ // NOTE: nos trae la sesion que vamos a editar
        $logeado = Utilidades::logeado();
        if ($logeado) {
            $id_sesion = $_GET['sesion'];
            $datosUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdSesion($id_sesion);
            $dato -> setIdUsuario($datosUsuario['id_usuario']);
            $sesionEditar = $dato -> obtenerSesion();
            require_once 'php/plantilla/editarSesion.php';
        }else{
            header('Location:'.base_url);
        }
    }

    public function actualizarSesion(){
        $logeado = Utilidades::logeado();
        if ($logeado) {
            // NOTE: captura los datos enviados por post en variables para un mejor manejo de datos 
            $id_sesion = isset($_POST['id_sesion']) ? $_POST['id_sesion'] : null;
            $datosAlias = isset($_POST['alias']) ? $_POST['alias'] : '';
            $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : null;
            $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
            $datosEnlace = isset($_POST['enlace']) ? $_POST['enlace'] : '';

            // NOTE: los campos vacios lo llenamos con valores predeterminados
            $alias = empty($datosAlias) ? 'SC' : $datosAlias;
            $enlace = empty($datosEnlace) ? 'SC' : $datosEnlace;

            if (!is_null($correo) && !is_null($clave) && !is_null($pagina)) {
                // NOTE: seteamos los datos antes de guardarlos en la base de datos
                $datosUsuario = $_SESSION['usuario'];
                $dato = new sesionModelo();
                $dato -> setIdUsuario($datosUsuario['id_usuario']);
                $dato -> setIdSesion($id_sesion);
                $dato -> setAlias($alias);
                $dato -> setCorreo($correo);
                $dato -> setClave($clave);
                $dato -> setPagina($pagina);
                $dato -> setEnlace($enlace);
                $sesionActualizada = $dato -> actualizarSesion();
                $sesionEditar = $dato -> obtenerSesion();
                require_once 'php/plantilla/editarSesion.php';
            }else{
                $sesionActualizada = false;
                $sesionEditar = $dato -> obtenerSesion();
                require_once 'php/plantilla/editarSesion.php';
            }
            
        }else{
            header('Location:'.base_url);
        }
    }

    public function guardarSesion(){
        $logeado = Utilidades::logeado();
        if ($logeado) {
            // NOTE: captura los datos enviados por post en variables para un mejor manejo de datos 
            $datosAlias = isset($_POST['alias']) ? $_POST['alias'] : '';
            $correo = isset($_POST['correo']) ? $_POST['correo'] : null;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : null;
            $pagina = isset($_POST['pagina']) ? $_POST['pagina'] : null;
            $datosEnlace = isset($_POST['enlace']) ? $_POST['enlace'] : '';

            // NOTE: los campos vacios lo llenamos con valores predeterminados
            $alias = empty($datosAlias) ? 'SC' : $datosAlias;
            $enlace = empty($datosEnlace) ? 'SC' : $datosEnlace;

            if (!is_null($correo) && !is_null($clave) && !is_null($pagina)) {
                // NOTE: seteamos los datos antes de guardarlos en la base de datos
                $datosUsuario = $_SESSION['usuario'];
                $dato = new sesionModelo();
                $dato -> setIdUsuario($datosUsuario['id_usuario']);
                $dato -> setAlias($alias);
                $dato -> setCorreo($correo);
                $dato -> setClave($clave);
                $dato -> setPagina($pagina);
                $dato -> setEnlace($enlace);
                $sesionGuardada = $dato -> guardarSesion();
                if ($sesionGuardada) {
                    require_once 'php/plantilla/agregarSesion.php';
                }else{
                    $sesionGuardada = false;
                    require_once 'php/plantilla/agregarSesion.php';
                }
            }else{
                $sesionGuardada = false;
                require_once 'php/plantilla/agregarSesion.php';
            }
            
        }else{
            header('Location:'.base_url);
        }
    }
}

?>