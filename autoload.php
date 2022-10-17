<?php
function cargar_controlador($clase){
	include 'php/controlador/'.$clase.'.php';
}
spl_autoload_register('cargar_controlador');