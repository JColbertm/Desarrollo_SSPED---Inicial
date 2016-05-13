<?php
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
	switch ($opcion) {
		case "registrar":
			$fecha_actual=date("Y/m/d");
			$a = filter_var($_POST['regNombre'],FILTER_SANITIZE_STRING);
			$b = filter_var($_POST['regAp1'],FILTER_SANITIZE_STRING);
			$c = filter_var($_POST['regAp2'],FILTER_SANITIZE_STRING);
			$d = $_POST['regFechana'];
				//filter_var($_POST['id_categoria'],FILTER_SANITIZE_NUMBER_INT);
			
			$e = filter_var($_POST['regGrupo'],FILTER_SANITIZE_NUMBER_INT);
			$foto=$_FILES["abrir-ima"]["name"];

			if($foto==null)
				    {
				    	$destino="fotos/EjercicioFutbol.png";
				    	//insertamos nuevo registro en tabla grupo
			$campos = array('nombre_ju','apellidop_ju', 'apellidom_ju', 'fechana_ju', 'imagen_ju', 'estado_ju', 'idGrupo');
			$valores = array($a,$b,$c,$d,$destino,"1",$e);
			$result= insertA('jugador', $campos, array(2,2,2,2,2,2,2,2) , $valores);
			if ($result){		
				
								$resultados=array('resp'=> 1);
							}
							else
							{
								$resultados=array('resp'=> 0);
							}
				    	
				    }else{
				    	$filename = strtolower($foto);
						$whitelist = array('jpg', 'png', 'gif', 'jpeg'); //example of white list
    				if ($_FILES["abrir-ima"]["type"]=="image/jpeg" || $_FILES["abrir-ima"]["type"]=="image/pjpeg" || $_FILES["abrir-ima"]["type"]=="image/gif" || $_FILES["abrir-ima"]["type"]=="image/bmp" || $_FILES["abrir-ima"]["type"]=="image/png")
						{
							if($_FILES['abrir-ima']['size'] <= 5900000)
							{
									$ruta=$_FILES["abrir-ima"]["tmp_name"];
								    $destino=filter_var("fotos/".$foto,FILTER_SANITIZE_STRING);
								    copy($ruta,$destino);
								    //insertamos nuevo registro en tabla grupo
			$campos = array('nombre_ju','apellidop_ju', 'apellidom_ju', 'fechana_ju', 'imagen_ju', 'estado_ju', 'idGrupo');
			$valores = array($a,$b,$c,$d,$destino,"1",$e);
			$result= insertA('jugador', $campos, array(2,2,2,2,2,2,2,2) , $valores);
						if ($result){		
				
								$resultados=array('resp'=> 1);
							}
							else
							{
								$resultados=array('resp'=> 0);
							}
							}else{
								$resultados=array('resp'=> 3);
							}
				}else{
					$resultados=array('resp'=> 2);
				}}


			echo json_encode($resultados);
			flush();
		break;
		case "s_buscar":
			$result= execSqlA("select grupo.idGrupo, grupo.nombre_gru from grupo where grupo.estado_gru = 1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idGrupo'=> $data[0],'nombre_gru'=> $data[1]);
					$c++;
				}	
			}
			else {
				$resultados=array(0);
			}
			echo json_encode($resultados);
			flush();


			
		break;

		case "buscar":
			$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
			$result= execSqlA("select jugador.idJugador, jugador.nombre_ju, jugador.apellidop_ju, jugador.apellidom_ju, jugador.fechana_ju, grupo.nombre_gru, grupo.idGrupo, jugador.imagen_ju from grupo,jugador where jugador.nombre_ju LIKE '%$a%' and grupo.idGrupo=jugador.idGrupo and jugador.estado_ju=1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idJugador'=> $data[0],'nombre_ju'=> $data[1],'apellidop_ju'=> $data[2],'apellidom_ju'=> $data[3], 'fechana_ju' => $data[4],'nombre_grupo' => $data[5],'idGrupo' => $data[6], 'imagen_ju' => $data[7],'res'=> 1);
					$c++;
				}	
			}
			else {
				$resultados=array('res'=> 0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		case "buscar2":
			$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
			$result= execSqlA("select grupo.idGrupo, grupo.nombre_gru,  categoria.categoria_sub from grupo,categoria,categoria_grupo where grupo.nombre_gru LIKE '%$a%' and grupo.idGrupo=categoria_grupo.idGrupo and categoria.idCategoria=categoria_grupo.idCategoria and grupo.estado_gru=1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idGrupo'=> $data[0],'nombre_gru'=> $data[1],'categoria_sub'=> $data[2]);
					$c++;
				}	
			}
			else {
				$resultados=array(0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		case "listar":
			$result= execSqlA("select jugador.idJugador, jugador.nombre_ju, jugador.apellidop_ju, jugador.apellidom_ju, jugador.fechana_ju, grupo.nombre_gru, grupo.idGrupo, jugador.imagen_ju from grupo,jugador where grupo.idGrupo=jugador.idGrupo and jugador.estado_ju=1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idJugador'=> $data[0],'nombre_ju'=> $data[1],'apellidop_ju'=> $data[2],'apellidom_ju'=> $data[3], 'fechana_ju' => $data[4],'nombre_grupo' => $data[5],'idGrupo' => $data[6], 'imagen_ju' => $data[7], 'res'=> 1);
					$c++;
				}	
			}
			else {
				$resultados=array('res'=> 0);
			}
			echo json_encode($resultados);
			flush();		
		break;
		case "modificar":
			
			$idjugador = filter_var($_POST['idJugador'],FILTER_SANITIZE_NUMBER_INT);
			$nom = filter_var($_POST['modNombreJ'],FILTER_SANITIZE_STRING);
			$ap1 = filter_var($_POST['modApellido1J'],FILTER_SANITIZE_STRING);
			$ap2 = filter_var($_POST['modApellido2J'],FILTER_SANITIZE_STRING);
			$fecha = $_POST['modFechaJ'];
			$grupo_id = filter_var($_POST['modGrupoJ2'],FILTER_SANITIZE_NUMBER_INT);
			$foto=$_FILES["abrir-ima-mod"]["name"];

			if($foto==null){
				    	if($foto_mod==="fotos/imagenfutbol.png"){
				    	$destino="fotos/imagenfutbol.png";
				    	$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju','idGrupo');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino,$grupo_id);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2,2) , $valores, 'idJugador', $idjugador);
			if ($result){		
								
										$resultados=array('resp'=> 1);
									}
									else
									{
										$resultados=array('resp'=> 0);
									}
				    	}else{
				    	$destino=$foto_mod;
				    	$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju','idGrupo');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino,$grupo_id);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2,2) , $valores, 'idJugador', $idjugador);
			if ($result){		
								
										$resultados=array('resp'=> 1);
									}
									else
									{
										$resultados=array('resp'=> 0);
									}
				    	}
				   }
				    else{
				    $filename = strtolower($foto);
						$whitelist = array('jpg', 'png', 'gif', 'jpeg'); //example of white list
    				if ($_FILES["abrir-ima-mod"]["type"]=="image/jpeg" || $_FILES["abrir-ima-mod"]["type"]=="image/pjpeg" || $_FILES["abrir-ima-mod"]["type"]=="image/gif" || $_FILES["abrir-ima-mod"]["type"]=="image/bmp" || $_FILES["abrir-ima-mod"]["type"]=="image/png")
						{
							if($_FILES['abrir-ima-mod']['size'] <= 5900000)
							{
									$ruta=$_FILES["abrir-ima-mod"]["tmp_name"];
								    $destino=filter_var("fotos/".$foto,FILTER_SANITIZE_STRING);
								    copy($ruta,$destino);
$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju','idGrupo');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino,$grupo_id);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2,2) , $valores, 'idJugador', $idjugador);	if ($result){		
								
										$resultados=array('resp'=> 1);
									}
									else
									{
										$resultados=array('resp'=> 0);
									}
							}else{
								$resultados=array('resp'=> 3);
							}
				}else{
					$resultados=array('resp'=> 2);
				}

					}

			
			
			echo json_encode($resultados);
			flush();


			
		break;
		case "eliminar":
			
			$ju_id = filter_var($_POST['idJugador'],FILTER_SANITIZE_NUMBER_INT);
			
			$fecha_actual=date("Y/m/d");
			$campos = array('estado_ju');
			$valores = array(0,$fecha_actual);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2) , $valores, 'idJugador', $ju_id);
			// actualiza idcategoria en la tabla categoria_grupo
			if ($result){		
				$resultados=array('resp'=> 1);
			}
			else
			{
				$resultados=array('resp'=> 0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		
		default:
			# code...
			break;
	}
	
?>