<?php 
require_once 'php/configuracion/conexion.php';

class usuarioModelo{
    private $id;
    private $alias;
    private $clave;
    private $nivel;

    // ANCHOR: getters
    public function getId(){
        return $this->id;
    }

    public function getAlias(){
        return $this->alias;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getNivel(){
        return $this->nivel;
    }

    // ANCHOR: setters
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setAlias($alias){
        $this->alias = $alias;
        return $this;
    }

    public function setClave($clave){
        $this->clave = $clave;
        return $this;
    }

    public function setNivel($nivel){
        $this->nivel = $nivel;
        return $this;
    }

    // ANCHOR: funciones
    public function registrarUsuario(){
        $base = Conexion::conectar();
        $alias = $this -> getAlias();
        $clave = $this -> getClave();
        $nivel = 'usuario';
        $sql = "INSERT INTO usuarios(usos_alias, usos_clave, usos_nivel) VALUES (:alias, :clave, :nivel)";
        $consulta = $base->prepare($sql);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> bindparam(':nivel', $nivel);
        $resultado = $consulta->execute();
        return $resultado;
    }

    public function verificarLogin(){
        $base = Conexion::conectar();
        $alias = $this -> getAlias();
        $clave = $this -> getClave();
        $sql = "SELECT * FROM usuarios WHERE usos_alias = :alias AND usos_clave = :clave";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> execute();
        $cuenta = $consulta -> rowCount(); // NOTE: cuenta las filas que concuerdan con la consulta SQL
        if ($cuenta == 1){
            $dato = $consulta->fetch(PDO::FETCH_ASSOC);
            return $dato;
        }else{
            return false;
        }
    }

    public function aliasUsuario(){
        $base = Conexion::conectar();
        $id = $this -> getId();
        $sql = "SELECT usos_alias AS alias FROM usuarios WHERE id_usuario = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':id', $id);
        $consulta -> execute();
        $dato = $consulta ->fetch(PDO::FETCH_ASSOC);
        return $dato;
    }

    public function esAdmin(){
        $base = Conexion::conectar();
        $id = $this -> getId();
        $sql = "SELECT usos_nivel FROM usuarios WHERE id_usuario = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':id', $id);
        $consulta -> execute();
        $dato = $consulta ->fetch(PDO::FETCH_ASSOC);
        if ($dato['usos_nivel'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }
}
