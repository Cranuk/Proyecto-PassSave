<?php
require_once 'php/modelo/usuarioModelo.php';

class usuarioControlador{
    public function login(){
        require_once 'php/plantilla/login.php';
    }

    public function registro(){
        require_once 'php/plantilla/registro.php';
    }

    public function registrarUsuario() {
        $valorRandom = rand(1,999);
        $datoAlias = $_POST['alias'];
        $datosClave = $_POST['clave'];
        $datosClaveRep = $_POST['claveRep'];
    
        $alias = empty($datoAlias) ? 'anonimo'.$valorRandom : $datoAlias;
        $estanVacias = !empty($datosClave) && !empty($datosClaveRep);
        $sonIguales = $datosClave === $datosClaveRep;
    
        if ($estanVacias && $sonIguales) {
            $clave = md5($datosClave);
    
            $dato = new usuarioModelo();
            $dato -> setAlias($alias);
            $dato -> setClave($clave);
            $resultado = $dato -> registro() ? true : false;
            echo $resultado;
        }else{
            $resultado = false;
            echo $resultado;
        }
    }

    public function ingresarUsuario(){
        $datoAlias = $_POST['alias'];
        $datoClave = $_POST['clave'];

        if (!empty($datoAlias) && !empty($datoClave)) {
            // NOTE: verificamos que el usuario y la clave esten en la base de datos
            $dato = new usuarioModelo();
            $dato -> setAlias($datoAlias);
            $dato -> setClave(md5($datoClave));
            $ingreso = $dato -> login();
            if ($ingreso) {
                $_SESSION['usuario'] = $ingreso; // NOTE: guardamos en la variable sesion los datos de login
                header('Location:'.base_url.'sesion/misSesiones');
            }else{
                $_SESSION['usuario'] = 'error'; 
            }
        }else{
            $_SESSION['usuario'] = 'error';
        }
        require_once 'php/plantilla/login.php';
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