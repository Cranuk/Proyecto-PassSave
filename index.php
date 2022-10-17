<?php
    session_start();
    require_once 'autoload.php';
    require_once 'php/configuracion/conexion.php';
    require_once 'php/configuracion/parametros_online.php';
    require_once 'php/helpers/utilidades.php';
    require_once 'php/plantilla/cabecera.php';

    function mostrarMensaje(){ // NOTE: funcion con el cual mostramos el error
        //NOTE: usamos el controlador error para mandar el mensaje de error
        $error = new errorControlador();
        $error -> enviarError();
    }
    
    if(isset($_GET['controlador'])){
        $nombre_controlador = $_GET['controlador'].'Controlador';
    }elseif(!isset($_GET['controlador'])){ //NOTE: Al poner esta condicion ponemos un controlador default al no tener especificado una en la url
        $nombre_controlador = controlador_default.'Controlador';
    }else{
        mostrarMensaje();
        exit();
    }
    
    if(class_exists($nombre_controlador)){	
        $controlador = new $nombre_controlador();
        if(isset($_GET['accion']) && method_exists($controlador, $_GET['accion'])){
            $accion = $_GET['accion'];
            $controlador->$accion();
        }elseif(!isset($_GET['accion'])){ //NOTE: Al poner esta condicion ponemos una accion default al no tener especificado una en la url
            $accion = accion_default;
            $controlador->$accion();
        }else{
            mostrarMensaje();
        }
    }else{
        mostrarMensaje();
    }
    require_once 'php/plantilla/pie.php';
?>