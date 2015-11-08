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
	$terrestre['pais_origen'] = $_POST['pais_origen'];
	$_SESSION['TERRESTRE'][] = $terrestre;
	header('LOCATION: terrestre.php');
}elseif(isset($_POST['enviar'])){
	die("FORMATEAR XML Y CONECTAR");
}else{
	die("NO ACCEDER");
}

