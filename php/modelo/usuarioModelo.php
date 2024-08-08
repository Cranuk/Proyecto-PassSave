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
    public function registro() {
        try {
            $base = Conexion::conectar();
            $alias = $this->getAlias();
            $clave = $this->getClave();
            $sql = "INSERT INTO usuarios (alias, clave) VALUES (:alias, :clave)";
            $consulta = $base->prepare($sql);
            $consulta->bindparam(':alias', $alias);
            $consulta->bindparam(':clave', $clave);
            $resultado = $consulta->execute();
            return $resultado;
        } catch (Exception $e) {
            // Manejo de errores
            error_log("Error en registro: " . $e->getMessage());
            return false;
        }
    }

    public function login(){
        $base = Conexion::conectar();
        $alias = $this -> getAlias();
        $clave = $this -> getClave();
        $sql = "SELECT * FROM usuarios WHERE alias = :alias AND clave = :clave";
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
        $sql = "SELECT alias FROM usuarios WHERE id = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':id', $id);
        $consulta -> execute();
        $dato = $consulta ->fetch(PDO::FETCH_ASSOC);
        return $dato;
    }

    public function esAdmin(){
        $base = Conexion::conectar();
        $id = $this -> getId();
        $sql = "SELECT rol FROM usuarios WHERE id = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':id', $id);
        $consulta -> execute();
        $dato = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $dato;
    }
}
