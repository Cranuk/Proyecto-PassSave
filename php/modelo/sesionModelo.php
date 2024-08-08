<?php 
require_once 'php/configuracion/conexion.php';

class sesionModelo{
    private $idSesion;
    private $idUsuario;
    private $alias;
    private $email;
    private $clave;
    private $pagina;
    private $link;

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

    public function getEmail(){
        return $this->email;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getPagina(){
        return $this->pagina;
    }

    public function getlink(){
        return $this->link;
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

    public function setEmail($email){
        $this->email = $email;
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

    public function setlink($link){
        $this->link = $link;
        return $this;
    }

    // ANCHOR: funciones
    public function obtenerSesion(){ // NOTE: esta funcion nos trae una sesion especifica del usuario
        $base = Conexion::conectar();
        $idSesion = $this -> getIdSesion();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT * FROM sesiones WHERE id = :idSesion AND usuario_id = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idSesion', $idSesion);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta ->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerSesionesUsuario(){ // NOTE: nos trae los datos de todas las sesiones guardadas que tenga el usuario
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT * FROM sesiones WHERE usuario_id = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerSesionesAdmin(){ //NOTE: si es nivel admin se mostrara las sesiones guardadas de todos los usuarios para el mantenimiento de la pagina
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT sesiones.* FROM sesiones INNER JOIN usuarios ON usuarios.rol = 'admin' AND usuarios.usuario_id = :idUsuario"; 
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> execute();
        $resultado = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function cantidadSesionesAdmin(){ //NOTE: si es nivel admin se mostrara la cantidad de sesiones guardadas de todos los usuarios para el mantenimiento de la pagina
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $sql = "SELECT COUNT(*) AS cantidad FROM sesiones";
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
        $sql = "SELECT COUNT(*) AS cantidad FROM sesiones WHERE usuario_id = :idUsuario";
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
        $email = $this -> getEmail();
        $clave = $this -> getClave();
        $pagina = $this -> getPagina();
        $link = $this -> getlink();
        $sql = "UPDATE sesiones SET alias = :alias, email = :email, clave = :clave, pagina = :pagina, link = :link
                WHERE id = :idSesion AND usuario_id = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':idSesion', $idSesion);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':email', $email);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> bindparam(':pagina', $pagina);
        $consulta -> bindparam(':link', $link);
        $resultado = $consulta -> execute();
        return $resultado;
    }

    public function guardarSesion(){
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $alias = $this -> getAlias();
        $email = $this -> getEmail();
        $clave = $this -> getClave();
        $pagina = $this -> getPagina();
        $link = $this -> getlink();
        $sql = "INSERT INTO sesiones(usuario_id, alias, email, clave, pagina, link) VALUES (:idUsuario, :alias, :email, :clave, :pagina, :link)";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':alias', $alias);
        $consulta -> bindparam(':email', $email);
        $consulta -> bindparam(':clave', $clave);
        $consulta -> bindparam(':pagina', $pagina);
        $consulta -> bindparam(':link', $link);
        $resultado = $consulta -> execute();
        return $resultado;
    }

    public function borrarSesion(){ // NOTE: borramos la sesion indicada por el usuario
        $base = Conexion::conectar();
        $idUsuario = $this -> getIdUsuario();
        $idSesion = $this -> getIdSesion();
        $sql = "DELETE FROM sesiones WHERE id = :idSesion AND usuario_id = :idUsuario";
        $consulta = $base -> prepare($sql);
        $consulta -> bindparam(':idUsuario', $idUsuario);
        $consulta -> bindparam(':idSesion', $idSesion);
        $resultado = $consulta -> execute();
        return $resultado;
    }
}
?>