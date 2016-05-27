<?php

	$conexion = new mysqli("localhost","root","","bd_ssped");

//llena el combo box con las CATEGORIAS
	$strConsulta = "select idCategoria, categoria_sub from categoria";
	$result = $conexion->query($strConsulta);
	$categoria = '<option> </option>';//Elegir Categoria
	while( $fila = $result->fetch_array() )
	{
		$categoria.='<option value="'.$fila["idCategoria"].'">'.$fila["categoria_sub"].'</option>';
	}
	////////////////////////////////////
	//llena el combo box con PREPARACIONES (tecnico,tec-tac,tec-fisico,etc)
	$strConsulta = "select idTipo_ejercicio, ejercicio from tipo_ejercicio";
	$result = $conexion->query($strConsulta);
	$preparaciones = '<option></option>';//Elegir preparacion
	while( $fila = $result->fetch_array() )
	{
		$preparaciones.='<option value="'.$fila["idTipo_ejercicio"].'">'.$fila["ejercicio"].'</option>';
	}
	////////////////////////////////////
	if(isset($_POST["idinputPreparatoriaEj"])){
		$pre=$_POST["idinputPreparatoriaEj"];
		if($pre==1){
				$subelemento= '<option></option>';//Elegir Categoria
		$strConsulta = "select idSub_ejercicio, sub_ejercicio from sub_ejercicio where idSub_ejercicio=1 or idSub_ejercicio=2 or idSub_ejercicio=3";
		$result = $conexion->query($strConsulta);
		while( $fila = $result->fetch_array() )
		{
			$subelemento.='<option value="'.$fila["idSub_ejercicio"].'">'.$fila["sub_ejercicio"].'</option>';
		}

		echo $subelemento;
		}
		
		
	}
	if(isset($_POST["elemento"])){
		$pre=$_POST["elemento"];
				$elemento= '<option></option>';//Elegir Categoria
		$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio= '".$pre."'";
		$result = $conexion->query($strConsulta);
		while( $fila = $result->fetch_array() )
		{
			$elemento.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
		}

		echo $elemento;
		
	}
	if(isset($_POST["sub"])){
		$pre=$_POST["sub"];
				$elemento= '<option></option>';//Elegir Categoria
		$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idSub_ejercicio= '".$pre."'";
		$result = $conexion->query($strConsulta);
		while( $fila = $result->fetch_array() )
		{
			$elemento.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
		}

		echo $elemento;
		
	}
	//llena checkbox de Ejercicio_Tecnico galeriafutbol.php
	$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=1";
	$result = $conexion->query($strConsulta);
	$ejercicio_tecnico="";
	while( $fila = $result->fetch_array() )
	{
		$ejercicio_tecnico.='<div class="checkbox"><label><input type="radio" name="seleccionado1" value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</label></div>';
	}
	////////////////////////////////////
	//llena checkbox de Ejercicio_Tecnico_tactico galeriafutbol.php
	$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=2";
	$result = $conexion->query($strConsulta);
	$Ejercicio_Tecnico_tactico="";
	while( $fila = $result->fetch_array() )
	{
		$Ejercicio_Tecnico_tactico.='<div class="checkbox"><label><input type="radio" name="seleccionado1" value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</label></div>';
	}
	////////////////////////////////////
	//llena checkbox de Ejercicio_Tecnico_fisico galeriafutbol.php
	$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=3";
	$result = $conexion->query($strConsulta);
	$Ejercicio_Tactico_fisico="";
	while( $fila = $result->fetch_array() )
	{
		$Ejercicio_Tactico_fisico.='<div class="checkbox"><label><input type="radio" name="seleccionado1" value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</label></div>';
	}
	////////////////////////////////////
	//llena checkbox de Ejercicio_acciones_psicologicas galeriafutbol.php
	$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=4";
	$result = $conexion->query($strConsulta);
	$Acciones_Psicologicas="";
	while( $fila = $result->fetch_array() )
	{
		$Acciones_Psicologicas.='<div class="checkbox"><label><input type="radio" name="seleccionado1" value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</label></div>';
	}
	////////////////////////////////////
	//llena checkbox de Ejercicio_competencia galeriafutbol.php
	$strConsulta = "select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=5";
	$result = $conexion->query($strConsulta);
	$Competencia="";
	while( $fila = $result->fetch_array() )
	{
		$Competencia.='<div class="checkbox"><label><input type="radio" name="seleccionado1" value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</label></div>';
	}
	////////////////////////////////////

?>
