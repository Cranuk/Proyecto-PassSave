<?php 
    require_once 'php/modelo/usuarioModelo.php';
    require_once 'php/modelo/sesionModelo.php';
    class Utilidades{
        public static function logeado(){ //NOTE: comprobamos si el usuario esta logeado
            if (isset($_SESSION['usuario'])){
                return true;
            }else{
                return false;
            }
        }

        public static function aliasUsuario($id){ //NOTE: buscamos el alias del usuario
            $dato = new usuarioModelo();
            $dato -> setId($id);
            $resultado = $dato -> aliasUsuario();
            return $resultado;
        }

        public static function cantidadSesiones(){//NOTE: comprobas la cantidad de sesiones que tenga el usuario guardado en el sistema
            $idUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdUsuario($idUsuario['id']);
            $resultado = $dato -> cantidadSesiones();
            return $resultado;
        }

        public static function esAdmin(){ //NOTE: comprobamos que el usuario tenga los permisos requeridos para ciertas funciones
            $idUsuario = $_SESSION['usuario'];
            $dato = new usuarioModelo();
            $dato -> setId($idUsuario['id']);
            $resultado = $dato -> esAdmin();
            if ($resultado['rol'] == 'admin') {
                return true;
            } else {
                return false;
            }
        }

        public static function cantidadSesionesAdmin(){
            $idUsuario = $_SESSION['usuario'];
            $dato = new sesionModelo();
            $dato -> setIdUsuario($idUsuario['id']);
            $resultado = $dato -> cantidadSesionesAdmin();
            return $resultado;
        }
    }

?>