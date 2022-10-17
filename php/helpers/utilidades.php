<?php 
    class Utilidades{
        public static function logeado(){ //NOTE: comprobamos si el usuario esta logeado
            if (isset($_SESSION['usuario'])){
                return true;
            }else{
                return false;
            }
        }

        public static function aliasUsuario($id){ //NOTE: buscamos el alias del usuario
            require_once 'php/modelo/usuarioModelo.php';
            $dato = new usuarioModelo();
            $dato -> setId($id);
            $resultado = $dato -> aliasUsuario();
            return $resultado;
        }

        public static function cantidadSesiones(){//NOTE: comprobas la cantidad de sesiones que tenga el usuario guardado en el sistema
            require_once 'php/modelo/sesionModelo.php';
            $idUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdUsuario($idUsuario['id_usuario']);
            $resultado = $dato -> cantidadSesiones();
            return $resultado;
        }

        public static function esAdmin(){ //NOTE: comprobamos que el usuario tenga los permisos requeridos para ciertas funciones
            require_once 'php/modelo/usuarioModelo.php';
            $idUsuario = $_SESSION['usuario'];
            $dato = new usuarioModelo();
            $dato -> setId($idUsuario['id_usuario']);
            $resultado = $dato -> esAdmin();
            return $resultado;
        }

        public static function cantidadSesionesAdmin(){
            require_once 'php/modelo/sesionModelo.php';
            $idUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdUsuario($idUsuario['id_usuario']);
            $resultado = $dato -> cantidadSesionesAdmin();
            return $resultado;
        }
    }

?>