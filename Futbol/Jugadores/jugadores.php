<?php
@session_start();
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
			
			$e = filter_var($_POST['modGrupoJ'],FILTER_SANITIZE_NUMBER_INT);
			$eCat = filter_var($_POST['modCatJ'],FILTER_SANITIZE_NUMBER_INT);

			$personal = RecuperarIdItemA("categoria_grupo", array("idGrupo","idCategoria"), array($e,$eCat));
			$idGrup = $personal['idCategoria_grupo'];

			$foto=$_FILES["abrir-ima"]["name"];

			if($foto==null)
				    {
				    	$destino="fotos/EjercicioFutbol.png";
				    	//insertamos nuevo registro en tabla grupo
			$campos = array('nombre_ju','apellidop_ju', 'apellidom_ju', 'fechana_ju', 'imagen_ju', 'estado_ju', 'idGrupCat', 'idEntrenador');
			$valores = array($a,$b,$c,$d,$destino,"1",$idGrup,$_SESSION['id_en']);
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
			$campos = array('nombre_ju','apellidop_ju', 'apellidom_ju', 'fechana_ju', 'imagen_ju', 'estado_ju', 'idGrupCat', 'idEntrenador');
			$valores = array($a,$b,$c,$d,$destino,"1",$idGrup,$_SESSION['id_en']);
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
			$result= execSqlA("select grupo.idGrupo, grupo.nombre_gru from grupo where idEntrenador=".$_SESSION['id_en']."" );
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

		case "c_buscar":
			$result= execSqlA("select categoria_grupo.idCategoria_grupo, grupo.idGrupo, grupo.nombre_gru, categoria.idCategoria, categoria_sub from grupo,categoria,categoria_grupo where grupo.estado_gru = 1 and grupo.idGrupo=categoria_grupo.idGrupo and categoria.idCategoria=categoria_grupo.idCategoria and categoria_grupo.idGrupo=".$_POST['idgrupo']."");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idCatGrup'=> $data[0],'idGrupo'=> $data[1],'nombre_gru'=> $data[2],'idCategoria'=> $data[3],'categoria_sub'=> $data[4]);
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
			$result= execSqlA("select categoria_grupo.idCategoria_grupo, jugador.idJugador, jugador.nombre_ju, jugador.apellidop_ju, jugador.apellidom_ju, jugador.fechana_ju, grupo.nombre_gru, categoria_grupo.idGrupo,categoria.categoria_sub, categoria_grupo.idCategoria, jugador.imagen_ju from grupo,jugador,categoria,categoria_grupo where categoria_grupo.idCategoria_grupo=jugador.idGrupCat and jugador.estado_ju=1 and categoria_grupo.idGrupo =grupo.idGrupo and categoria_grupo.idCategoria = categoria.idCategoria and jugador.nombre_ju LIKE '%$a%' and jugador.idEntrenador= ".$_SESSION['id_en']."");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idCategoria_grupo'=> $data[0],'idJugador'=> $data[1],'nombre_ju'=> $data[2],'apellidop_ju'=> $data[3], 'apellidom_ju' => $data[4],'fechana_ju' => $data[5],'nombre_gru' => $data[6], 'idGrupo' => $data[7],'categoria_sub' => $data[8], 'idCategoria' => $data[9],'imagen_ju' => $data[10], 'res'=> 1);
					$c++;
				}	
			}
			else {
				$resultados=array('res'=> 0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		
		case "listar":
			$result= execSqlA("select categoria_grupo.idCategoria_grupo, jugador.idJugador, jugador.nombre_ju, jugador.apellidop_ju, jugador.apellidom_ju, jugador.fechana_ju, grupo.nombre_gru, categoria_grupo.idGrupo,categoria.categoria_sub, categoria_grupo.idCategoria, jugador.imagen_ju from grupo,jugador,categoria,categoria_grupo where categoria_grupo.idCategoria_grupo=jugador.idGrupCat and jugador.estado_ju=1 and categoria_grupo.idGrupo =grupo.idGrupo and categoria_grupo.idCategoria = categoria.idCategoria and jugador.idEntrenador= ".$_SESSION['id_en'].""); /////////////////DESDE ACA ARREGLAR//////////////////////////////
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idCategoria_grupo'=> $data[0],'idJugador'=> $data[1],'nombre_ju'=> $data[2],'apellidop_ju'=> $data[3], 'apellidom_ju' => $data[4],'fechana_ju' => $data[5],'nombre_gru' => $data[6], 'idGrupo' => $data[7],'categoria_sub' => $data[8], 'idCategoria' => $data[9],'imagen_ju' => $data[10], 'res'=> 1);
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
			$cat_id = filter_var($_POST['modCatJ2'],FILTER_SANITIZE_NUMBER_INT);
			$cat_grup = filter_var($_POST['idGrupoCategoria'],FILTER_SANITIZE_NUMBER_INT);
			$foto=$_FILES["abrir-ima-mod"]["name"];

			if($foto==null){
				    	if($foto_mod==="fotos/imagenfutbol.png"){
				    	$destino="fotos/imagenfutbol.png";
				    	$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2) , $valores, 'idJugador', $idjugador);
			$result2= updateA('categoria_grupo', array('idGrupo','idCategoria'), array(2,2) , array($grupo_id,$cat_id ), 'idCategoria_grupo', $cat_grup);
			if ($result && $result2){		
								
										$resultados=array('resp'=> 1);
									}
									else
									{
										$resultados=array('resp'=> 0);
									}
				    	}else{
				    	$destino=$foto_mod;
				    	$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2) , $valores, 'idJugador', $idjugador);
			$result2= updateA('categoria_grupo', array('idGrupo','idCategoria'), array(2,2) , array($grupo_id,$cat_id ), 'idCategoria_grupo', $cat_grup);
			if ($result && $result2){		
								
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
			$campos = array('nombre_ju','apellidop_ju','apellidom_ju','fechana_ju','imagen_ju');
			$valores = array($nom,$ap1,$ap2,$fecha,$destino);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('jugador', $campos, array(2,2,2,2,2) , $valores, 'idJugador', $idjugador);
			$result2= updateA('categoria_grupo', array('idGrupo','idCategoria'), array(2,2) , array($grupo_id,$cat_id ), 'idCategoria_grupo', $cat_grup);	
			if ($result && $result2){		
								
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


		case "insertar":
			$idplancat=$_POST["plansub"];
            $idplan=$_POST["plan"];
            $etapa=$_POST["etapa"];
            $meso=$_POST["meso-cre"];
            

            $campos =  array('idAsistencia', 'idGrupCat', 'idPlanificacion', 'idEtapa', 'idMesociclo', 'idJugador', 'C_1', 'C_2', 'C_3', 'C_4', 'C_5', 'C_6', 'C_7', 'C_8', 'C_9', 'C10', 'C11', 'C12', 'C13', 'C14', 'C15', 'C16', 'C17', 'C18', 'C19', 'C20', 'C21', 'C22', 'C23', 'C24', 'C25', 'C26', 'C27', 'C28', 'C29', 'C30', 'C31', 'C32', 'C33', 'C34', 'C35', 'C36', 'C37', 'C38', 'C39', 'C40', 'C41', 'C42', 'total_clases', 'total_nota');
			$valores = array('',$idplancat,$idplan,$etapa,$meso,1,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,0,0);
			$result= insertA('asistencia', $campos, array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2), $valores);
			if ($result)
			{		
				$campos_asi = array('asistencia');
				$valores_asi = array(1);
				//actualiza nombre de equipo en la tabla grupo
				$result_asi = updateA('mesociclo', $campos_asi, array(2) , $valores_asi, 'idMesociclo', $meso);
				if ($result_asi)
				{
					$resultados=array('resp'=> 1);			
				}
				else
				{
					$resultados=array('resp'=> 0);		
				}
			}
			else
			{
				$resultados=array('resp'=> 0);
			}
			echo json_encode($resultados);
			flush();

		break;	
			

		case "insertar_evaluacion":
			$idplancat=$_POST["plansub"];
            $idplan=$_POST["plan"];
            $etapa=$_POST["etapa"];
            $meso=$_POST["meso-cre"];
            
         /*   $campos =  array('idName_evaluacion', 'idCategoria_grupo', 'idPlanificacion', 'idEtapa', 'idMesociclo', 'Evaa_1', 'Evaa_2', 'Evaa_3', 'Evaa_4', 'Evag_1', 'Evag_2', 'Evaf_1', 'Evaf_2');
			$valores = array('',$idplancat,$idplan,$etapa,$meso,'name 1','name 2','name 3','name 4', 'name 5','name 6', 'name 7', 'name 8');
			$result= insertA('name_evaluacion', $campos, array(2,2,2,2,2,2,2,2,2,2,2,2,2), $valores);*/


			//insertamos los nombres a la tabla
			$quer = "insert into name_evaluacion ( idCategoria_grupo, idPlanificacion,idEtapa,idMesociclo, Evaa_1, Evaa_2, Evaa_3, Evaa_4, Evag_1, Evag_2, Evaf_1, Evaf_2) values";
					
			$cabecera = explode(",",$_POST['datos_cabecera']);
					foreach ($cabecera as $cab) {
						$quer .= "(".$idplancat.",".$idplan.",".$etapa.",".$meso.",'".$cab[0]."','".$cab[1]."','".$cab[2]."','".$cab[3]."','".$cab[5]."','".$cab[6]."','".$cab[8]."','".$cab[9]."')";

					}


			$result = execSqlA($quer);
					$resultados=array('query'=> $quer);


			if ($result)
			{		
				$resulta= execSqlA("select idName_evaluacion from name_evaluacion where idCategoria_grupo = $idplancat and idPlanificacion = $idplan and idEtapa = $etapa and idMesociclo = $meso" );
				$resultados=array();
				$filas = $resulta->fetch_array();
				
					$idnameeva = $filas['idName_evaluacion'];
					$campos_en =  array('idEvaluacion', 'idName_evaluacion', 'idJugador', 'evaa_1', 'evaa_2', 'evaa_3', 'evaa_4', 'total_ana', 'evag_1', 'evag_2', 'total_glob', 'evaf_1', 'evaf_2', 'total_fis', 'idAsistencia', 'tot_no', 'tot_lit');
					$valores_en = array('',$idnameeva,1,'e','e','e','e',100,'e','e',100,'e','e',100,10,100,'e');
					$sql= insertA('evaluacion', $campos_en, array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2), $valores_en);
					if ($sql)
					{
						$campos_eva = array('evaluacion');
						$valores_eva = array(1);
						//actualiza nombre de equipo en la tabla grupo
						$result_eva = updateA('mesociclo', $campos_eva, array(2) , $valores_eva, 'idMesociclo', $meso);
						if ($result_eva)
						{
							$resultados=array('resp'=> 1);			
						}
						else
						{
							$resultados=array('resp'=> 0);		
						}
					}	
					else
					{
						$resultados=array('resp'=> 0);		
					}				
			
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