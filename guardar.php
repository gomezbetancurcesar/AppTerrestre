<?php
session_start();

function pr($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

if(isset($_POST['agregar'])){
	$terrestre['codigo'] = $_POST['codigo'];
	$terrestre['monto'] = $_POST['monto'];
	$terrestre['fecha'] = $_POST['fecha'];
	$terrestre['rut'] = $_POST['rut'];
	$terrestre['cantidad'] = $_POST['cantidad'];
	$terrestre['pais_origen'] = $_POST['pais_origen'];
	$_SESSION['TERRESTRE'][] = $terrestre;
	header('LOCATION: terrestre.php');
}elseif(isset($_POST['enviar'])){
	require_once "class/WebService.php";
	$WebService = new WebService();
	$WebService->crearMensaje($_SESSION['TERRESTRE']);
    $_SESSION['respuesta'] = $WebService->llamarMetodo();
    unset($_SESSION['TERRESTRE']);
    header('LOCATION: terrestre.php');
	die("FORMATEAR XML Y CONECTAR");
}else{
	die("NO ACCEDER");
}

