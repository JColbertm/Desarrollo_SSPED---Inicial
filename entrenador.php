<?php
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
	switch ($opcion) {
		case "registrar_coach":
			$fecha_actual=date("d/m/Y");
			$a = filter_var($_POST['nombrecoach'],FILTER_SANITIZE_STRING);
			$b = filter_var($_POST['apellidopcoach'],FILTER_SANITIZE_STRING);
			$c = filter_var($_POST['apellidomcoach'],FILTER_SANITIZE_STRING);
			$d = filter_var($_POST['fechanaccoach'],FILTER_SANITIZE_STRING);
			$e = filter_var($_POST['carnet'],FILTER_SANITIZE_NUMBER_INT);
			$f = filter_var($_POST['telefono'],FILTER_SANITIZE_NUMBER_INT);
			$g = filter_var($_POST['mailcoach'],FILTER_SANITIZE_STRING);
			$h = filter_var($_POST['passwordcoach'],FILTER_SANITIZE_STRING);
			$i = filter_var($_POST['password2coach'],FILTER_SANITIZE_STRING);


			//insertamos nuevo registro en tabla ENTRENADOR
			if ($h == $i) 
			{
				$campos = array('idEntrenador','nombre_en', 'apellidop_en', 'apellidom_en', 'fechana_en', 'carnet_en', 'fono_en', 'correo_en', 'pass_en', 'estado_en', 'fechacreacion');
				$valores = array(null, $a, $b, $c, $d, $e, $f, $g , $h, 1, $fecha_actual);
				$result= insertA('entrenador', $campos, array(2,2,2,2,2,2,2,2,2,2,2) , $valores);	
				if ($result){		
					$resultados=array('resp'=> 1);
				}
				else
				{
					$resultados=array('resp'=> 0);
				}
				
			}
			else
			{
				$resultados=array('resp' => 2);
			}
			echo json_encode($resultados);
			flush();
		break;
 
		case "inicio_sesion":

			session_start();
			$fecha_actual=date("d/m/y");
			$a = filter_var($_POST['inputCi'],FILTER_SANITIZE_NUMBER_INT);
			$b = filter_var($_POST['inputPassword'],FILTER_SANITIZE_STRING);

			//bucamos al entrenador registrado
			$sql = "select idEntrenador, nombre_en, apellidop_en, apellidom_en from entrenador where carnet_en = $a and pass_en = '$b'";
			$result= execSqlA($sql);
			$resultados=array();
			$data = mysqli_fetch_array($result);
	        if($data > 0)
	        {
				$resultados = array('iden' => $data[0] ,'nom' => $data[1], 'app' => $data[2], 'apm' => $data[3],'res'=> 1);  
				$_SESSION['session'] = $data[1];
				$_SESSION['id_en'] = $data[0];
	        }
	        
	        else
	        {
	        	$resultados=array('res'=> 0 );	
	        }
			
			echo json_encode($resultados);
			flush();
		break;
	}
	
?> 