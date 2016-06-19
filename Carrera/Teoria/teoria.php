	<?php
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
		switch ($opcion) {

		case "registrar_pagina":
			$fecha_actual=date("d-m-Y");
			$a = filter_var($_POST['nombrepagina'],FILTER_SANITIZE_STRING);
			$b = filter_var($_POST['descripcionpagina'],FILTER_SANITIZE_STRING);
			$c = filter_var($_POST['linkpagina'],FILTER_SANITIZE_STRING);
				$campos = array('idInformacion','idDeporte', 'idTipo_info', 'nombre_informacion', 'descripcion', 'link', 'fechacreacion_info');
				$valores = array("", 1, 2, $a, $b, $c, $fecha_actual);
				$result= insertA('informacion', $campos, array(2,2,2,2,2,2,2), $valores);	
				$resultados=array('resp'=> 1);
				echo json_encode($resultados);

		break;

		case "registrar_video":
			$fecha_actual=date("d-m-Y");
			$a = filter_var($_POST['nombrevideo'],FILTER_SANITIZE_STRING);
			$b = filter_var($_POST['descripcionvideo'],FILTER_SANITIZE_STRING);
			$c = filter_var($_POST['linkvideo'],FILTER_SANITIZE_STRING);
				$campos = array('idInformacion','idDeporte', 'idTipo_info', 'nombre_informacion', 'descripcion', 'link', 'fechacreacion_info');
				$valores = array("", 1, 3, $a, $b, $c, $fecha_actual);
				$result= insertA('informacion', $campos, array(2,2,2,2,2,2,2), $valores);	
				$resultados=array('resp'=> 1);
				echo json_encode($resultados);
			
		break; 


		case "mostrar":
			$i = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);
			$result = execSqlA("SELECT idInformacion, nombre_informacion, descripcion, link FROM informacion WHERE idTipo_info = $i");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) 
			{
				$c=0;
				while($data = mysqli_fetch_array($result))
				{
				$multidimensional[$c] = array('idpag' => $data[0] ,'nombre' => $data[1], 'descripcion' => $data[2], 'link' => $data[3],'res'=> 1);
					$c++;
				}	
			}
			else 
			{
				$multidimensional=array('res'=> 0);
			}
				echo json_encode($multidimensional);
				flush();
			
		break;

		case "elimina":
			$i = filter_var($_POST['datos'],FILTER_SANITIZE_NUMBER_INT);
			$tabla = 'informacion';
			$campo = 'idInformacion';
			$result = deleteA($tabla,array($campo),$i);
			if($result)
				{
					$multidimensional = array('res' => 1);
				}	
				else
				{
					$multidimensional = array('res' => 0);
				}
				
			echo json_encode($multidimensional);
			flush();
			
		break;

	} 
	
?>