<?php
require_once 'php/modelo/sesionModelo.php';

class sesionControlador{
    public function misSesiones(){
        $datosUsuario = $_SESSION['usuario'];
        $logeado = Utilidades::logeado(); //NOTE: esto es para que solo tenga acceso solo los que esten logeados
        $esAdmin = Utilidades::esAdmin($datosUsuario['id']); //NOTE: aqui verificamos que si es un admin
        if($logeado){
            $dato = new sesionModelo();
            $dato -> setIdUsuario($datosUsuario['id']);
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
            $dato -> setIdUsuario($datosUsuario['id']);
            $dato -> borrarSesion();
            require_once 'php/plantilla/misSesiones.php';
        }else{
            header('Location:'.base_url);
        }
    }

    public function editarSesion(){ // NOTE: nos trae la sesion que vamos a editar
        $logeado = Utilidades::logeado();
        if ($logeado) {
            $id_sesion = $_POST['id'];
            $datosUsuario = $_SESSION['usuario'];

            $dato = new sesionModelo();
            $dato -> setIdSesion($id_sesion);
            $dato -> setIdUsuario($datosUsuario['id']);
            $sesionEditar = $dato -> obtenerSesion();
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode($sesionEditar);
            exit();
        }else{
            header('Location:'.base_url);
        }
    }

    public function actualizarSesion(){
        $logeado = Utilidades::logeado();
        if ($logeado) {
            $datosUsuario = $_SESSION['usuario'];

            // NOTE: captura los datos enviados por post en variables para un mejor manejo de datos 
            $id_sesion = !empty($_POST['id_sesion']) ? $_POST['id_sesion'] : null;
            $email = !empty($_POST['email']) ? $_POST['email'] : null;
            $clave = !empty($_POST['clave']) ? $_POST['clave'] : null;
            $alias = !empty($_POST['alias']) ? $_POST['alias'] : 'SC';
            $pagina = !empty($_POST['pagina']) ? $_POST['pagina'] : null;
            $link = !empty($_POST['link']) ? $_POST['link'] : 'SC';

            if (!is_null($email) && !is_null($clave) && !is_null($pagina) && !is_null($id_sesion)) {
                // NOTE: seteamos los datos antes de guardarlos en la base de datos
                $dato = new sesionModelo();
                $dato -> setIdUsuario($datosUsuario['id']);
                $dato -> setIdSesion($id_sesion);
                $dato -> setAlias($alias);
                $dato -> setEmail($email);
                $dato -> setClave($clave);
                $dato -> setPagina($pagina);
                $dato -> setLink($link);
                $resultado = $dato -> actualizarSesion();
                var_dump($id_sesion);
                var_dump($resultado);
                die();
                echo $resultado;
            }else{
                $resultado = false;
                echo $resultado;
            }
        }else{
            header('Location:'.base_url);
        }
    }

    public function guardarSesion(){
        $logeado = Utilidades::logeado();
        if ($logeado) {
            $datosUsuario = $_SESSION['usuario'];

            // NOTE: captura los datos enviados por post en variables para un mejor manejo de datos 
            $email = !empty($_POST['email']) ? $_POST['email'] : null;
            $clave = !empty($_POST['clave']) ? $_POST['clave'] : null;
            $alias = !empty($_POST['alias']) ? $_POST['alias'] : 'SC';
            $pagina = !empty($_POST['pagina']) ? $_POST['pagina'] : null;
            $link = !empty($_POST['link']) ? $_POST['link'] : 'SC';

            if (!is_null($email) && !is_null($clave) && !is_null($pagina)) {
                // NOTE: seteamos los datos antes de guardarlos en la base de datos
                $dato = new sesionModelo();
                $dato -> setIdUsuario($datosUsuario['id']);
                $dato -> setAlias($alias);
                $dato -> setEmail($email);
                $dato -> setClave($clave);
                $dato -> setPagina($pagina);
                $dato -> setLink($link);
                $resultado = $dato -> guardarSesion();
                echo $resultado;
            }else{
                $resultado = false;
                echo $resultado;
            }
        }else{
            header('Location:'.base_url);
        }
    }
}

?>