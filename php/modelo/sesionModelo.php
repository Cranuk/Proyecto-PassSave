<?php 
require_once 'php/configuracion/conexion.php';

class sesionModelo{
    public $idSesion;
    public $idUsuario;
    public $alias;
    public $correo;
    public $clave;
    public $pagina;
    public $enlace;

    // ANCHOR: getters
    public function getIdSesion(){
        return $this->idSesion;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getAlias(){
        return $this->alias;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getPagina(){
        return $this->pagina;
    }

    public function getEnlace(){
        return $this->enlace;
    }

    // ANCHOR: setters

    public function setIdSesion($idSesion){
        $this->idSesion = $idSesion;
        return $this;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function setAlias($alias){
        $this->alias = $alias;
        return $this;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
        return $this;
    }

    public function setClave($clave){
        $this->clave = $clave;
        return $this;
    }

    public function setPagina($pagina){
        $this->pagina = $pagina;
        return $this;
    }

    public function setEnlace($enlace){
        $this->enlace = $enlace;
        return $this;
    }

    // ANCHOR: funciones
    public function obtenerSesion(){ // NOTE: esta funcion nos trae una sesion especifica del usuario
        $base = Conexion::conectar();
        $idSesion = $this -> getIdSesion();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT * FROM sesiones WHERE id_sesion = :idSesion AND sen_idUsuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idSesion', $idSesion);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta ->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }else{
            return false;
        }
    }

    public function obtenerSesionesUsuario(){ // NOTE: nos trae los datos de todas las sesiones que tenga el usuario
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT * FROM sesiones WHERE sen_idUsuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }else{
            return false;
        }
    }

    public function obtenerSesionesAdmin(){ //NOTE: si es nivel admin se mostrara las sesiones guardadas de todos los usuarios para el mantenimiento de la pagina
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT sesiones.* FROM sesiones INNER JOIN usuarios ON usuarios.usos_nivel = 'admin' AND usuarios.id_usuario = :idUsuario"; 
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        if ($resultado) {
            return $resultado;
        }else{
            return false;
        }
    }

    public function cantidadSesionesAdmin(){ //NOTE: si es nivel admin se mostrara la cantidad de sesiones guardadas de todos los usuarios para el mantenimiento de la pagina
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT COUNT(id_sesion) AS cantidad FROM sesiones INNER JOIN usuarios ON usuarios.usos_nivel = 'admin' AND usuarios.id_usuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $cuenta = $consulta -> rowCount(); // NOTE: cuenta las filas que concuerdan con la consulta SQL
        if ($cuenta > 0) {
            $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return 0; // NOTE: En el caso que no haya sesiones devolvemos 0
        }
    }

    public function cantidadSesiones(){ //NOTE: cantidad de sesiones de cada usuario de manera individual
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT COUNT(id_sesion) AS cantidad FROM sesiones WHERE sen_idUsuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $cuenta = $consulta -> rowCount(); // NOTE: cuenta las filas que concuerdan con la consulta SQL
        if ($cuenta > 0) {
            $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return 0;
        }
    }

    public function actualizarSesion(){
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $idSesion = $this -> getIdSesion();
        $alias = $this -> getAlias();
        $correo = $this -> getCorreo();
        $clave = $this -> getClave();
        $pagina = $this -> getPagina();
        $enlace = $this -> getEnlace();
        $sql = "UPDATE sesiones SET sen_alias = :alias, sen_correo = :correo, sen_clave = :clave, sen_pagina = :pagina, sen_enlace = :enlace, sen_fecha = CURDATE() 
                WHERE id_sesion = :idSesion AND sen_idUsuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':idSesion', $idSesion);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':correo', $correo);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> bindparam(':pagina', $pagina);
        $consulta -> bindparam(':enlace', $enlace);
        $resultado = $consulta -> execute();
        return $resultado;
    }

    public function guardarSesion(){
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $alias = $this -> getAlias();
        $correo = $this -> getCorreo();
        $clave = $this -> getClave();
        $pagina = $this -> getPagina();
        $enlace = $this -> getEnlace();
        $sql = "INSERT INTO sesiones(sen_idUsuario, sen_alias, sen_correo, sen_clave, sen_pagina, sen_enlace, sen_fecha) VALUES (:idUsuario, :alias, :correo, :clave, :pagina, :enlace, CURDATE())";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':correo', $correo);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> bindparam(':pagina', $pagina);
        $consulta -> bindparam(':enlace', $enlace);
        $resultado = $consulta -> execute();
        return $resultado;
    }

    public function borrarSesion(){ // NOTE: borramos la sesion indicada por el usuario
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $idSesion = $this -> getIdSesion();
        $sql = "DELETE FROM sesiones WHERE id_sesion = :idSesion AND sen_idUsuario = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':idSesion', $idSesion);
        $resultado = $consulta -> execute();
        return $resultado;
    }
}
?>