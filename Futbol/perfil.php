<?php
	$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
	include("/Teoria/databaseA.php");
	switch ($opcion) {
		case "incluye":
			$id = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);

			//bucamos al entrenador registrado
			$sql = "select idEntrenador, nombre_en, apellidop_en, apellidom_en, fechana_en, carnet_en, fono_en, correo_en from entrenador where idEntrenador = $id";
			$result= execSqlA($sql);
			$resultados=array();
			$data = mysqli_fetch_array($result);
	        if($data > 0)
	        {
				$resultados = array('iden' => $data[0] ,'nom' => $data[1], 'app' => $data[2], 'apm' => $data[3], 'fecha' => $data[4], 'ci' => $data[5], 'fono' => $data[6], 'mail' => $data[7], 'res'=> 1);  
	        }
	        
	        else
	        {
	        	$resultados=array('res'=> 0 );	
	        }
			
			echo json_encode($resultados);
			flush();
		break;

		case "verifica":
			$pass = filter_var($_POST['datos'],FILTER_SANITIZE_STRING);
			$id = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);

			//bucamos al entrenador registrado
			$sql = "select idEntrenador, pass_en from entrenador where idEntrenador = $id and pass_en = '$pass'";
			$result= execSqlA($sql);
			$resultados=array();
			$data = mysqli_fetch_array($result);
	        if($data > 0)
	        {
				$resultados = array('iden' => $data[0] ,'pass' => $data[1], 'res'=> 1);  
	        }
	        
	        else
	        {
	        	$resultados=array('res'=> 0 );	
	        }
			
			echo json_encode($resultados);
			flush();
		break;

		case "cambiar":
			$nuevopass = filter_var($_POST['nuevopass'],FILTER_SANITIZE_STRING);
			$id = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);

			$campos = array('pass_en');
			$valores = array($nuevopass);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('entrenador', $campos, array(2) , $valores, 'idEntrenador', $id);
			if ($result)
			{		
				$resultados=array('resp'=> 1);
			}
			else
			{
				$resultados=array('resp'=> 0);
			}

			echo json_encode($resultados);
			flush();
		break;

	}
?>