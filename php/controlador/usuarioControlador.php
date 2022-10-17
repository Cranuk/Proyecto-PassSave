<?php
require_once 'php/modelo/usuarioModelo.php';

class usuarioControlador{
    public function login(){
        require_once 'php/plantilla/login.php';
    }

    public function registro(){
        require_once 'php/plantilla/registro.php';
    }

    public function registrarUsuario(){
        $valorRandom = rand(1,999);
        $datoAlias = isset($_POST['alias']) ? $_POST['alias'] : '';
        $datosClave = isset($_POST['clave']) ? $_POST['clave'] : '';
        $datosClaveRep = isset($_POST['claveRep']) ? $_POST['claveRep'] : '';
        $registro = false; // NOTE: bandera para el registro de usuario

        // NOTE: verificamos que el alias no este vacio
        $alias = empty($datoAlias) ? 'anonimo'.$valorRandom : $datoAlias; // NOTE: en el caso de que no tenga nombre de usuario se lo creamos de manera aleatoria

        // NOTE: verificamos que ambas claves sean iguales y no esten vacias
        $estanVacias = !empty($datosClave) && !empty($datosClaveRep);
        $sonIgual = $datosClave == $datosClaveRep;
        if ($estanVacias && $sonIgual) {
            // NOTE: encriptamos la clave para su seguridad
            $clave = md5($datosClave);

            // NOTE: enviamos los datos para ser guardados a la base de datos
            $dato = new usuarioModelo();
            $dato -> setAlias($alias);
            $dato -> setClave($clave);
            $registro = $dato -> registrarUsuario();
            require_once 'php/plantilla/registro.php';
        }else{
            $registro = false;
            require_once 'php/plantilla/registro.php';
        }
    }

    public function logearUsuario(){
        $datoAlias = isset($_POST['alias']) ? $_POST['alias'] : '';
        $datoClave = isset($_POST['clave']) ? $_POST['clave'] : '';

        if (!empty($datoAlias) && !empty($datoClave)) {
            // NOTE: verificamos que el usuario y la clave esten en la base de datos
            $dato = new usuarioModelo();
            $dato -> setAlias($datoAlias);
            $dato -> setClave(md5($datoClave));
            $logeo = $dato -> verificarLogin();
            if ($logeo) {
                $_SESSION['usuario'] = $logeo; // NOTE: guardamos en la variable sesion los datos de login
                header('Location:'.base_url.'sesion/misSesiones');
            }else{
                $logeo = false;
                require_once 'php/plantilla/login.php';
            }
            
        }else{
            $logeo = false;
            require_once 'php/plantilla/login.php';
        }
    }

    public function deslogearUsuario(){
        if (isset($_SESSION['usuario'])) {
            unset($_SESSION['usuario']);
            session_unset();
            header('Location:'.base_url);
        }
    }
}
?>