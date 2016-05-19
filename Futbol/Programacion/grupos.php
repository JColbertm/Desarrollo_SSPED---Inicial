<?php
@session_start();
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
	switch ($opcion) {
		case "registrar":
			$fecha_actual=date("Y/m/d");
			$a = filter_var($_POST['inputNombreR'],FILTER_SANITIZE_STRING);
			//$b = filter_var($_POST['inputCategoriaR'],FILTER_SANITIZE_STRING);
			$c = filter_var($_POST['id_categoria'],FILTER_SANITIZE_NUMBER_INT);

			//insertamos nuevo registro en tabla grupo
			$campos = array('idGrupo','nombre_gru', 'idDeporte', 'fecha_cre', 'fecha_mod', 'estado_gru', 'idEntrenador');
			$valores = array(null, $a, 1,$fecha_actual, null, 1, $_SESSION['id_en']);
			$result= insertA('grupo', $campos, array(2,2,2,2,2,2,2) , $valores);
			//seleccionamos el ultimo id de la tabla de registros
			$row= execSqlA("select idGrupo FROM grupo WHERE idGrupo=(SELECT MAX(idGrupo) FROM grupo)");
			//almacenamos el valor en una variable php
			while ($data = mysqli_fetch_array($row)){			  
			   $var1 = $data[0];
			}
			
			//insertar los valores en la tabla categoria-grupo
			$result2= insertA('categoria_grupo', array('idGrupo','idCategoria'),array(2,2), array($var1,$c));
			//si el regstro fue exitoso retorna un valor json
			if ($result && $result2){		
				$resultados=array('resp'=> 1);
			}
			else
			{
				$resultados=array('resp'=> 0);
			}
			echo json_encode($resultados);
			flush();
		break;
		//case "modificar":
		//break;
		case "buscar":
			$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
			$result= execSqlA("select grupo.idGrupo, categoria_grupo.idCategoria_grupo, grupo.nombre_gru,  categoria.categoria_sub, categoria.idCategoria from grupo,categoria,categoria_grupo where grupo.nombre_gru LIKE '%$a%' and grupo.idGrupo=categoria_grupo.idGrupo and categoria.idCategoria=categoria_grupo.idCategoria and grupo.estado_gru=1 and grupo.idEntrenador=".$_SESSION['id_en']."");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idGrupo'=> $data[0],'idCategoria1'=> $data[1],'nombre_gru'=> $data[2],'categoria_sub'=> $data[3], 'idCategoria' => $data[4],'res'=> 1);
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
			$result= execSqlA("select grupo.idGrupo, grupo.nombre_gru,  categoria.categoria_sub from grupo,categoria,categoria_grupo where grupo.nombre_gru LIKE '%$a%' and grupo.idGrupo=categoria_grupo.idGrupo and categoria.idCategoria=categoria_grupo.idCategoria and grupo.estado_gru=1 and grupo.idEntrenador=".$_SESSION['id_en']."");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idGrupo'=> $data[0],'nombre_gru'=> $data[1],'categoria_sub'=> $data[2],'res'=> 1);
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
			$result= execSqlA("select grupo.idGrupo, categoria_grupo.idCategoria_grupo, grupo.nombre_gru,  categoria.categoria_sub, categoria.idCategoria from grupo,categoria,categoria_grupo where grupo.idGrupo=categoria_grupo.idGrupo and categoria.idCategoria=categoria_grupo.idCategoria and grupo.estado_gru=1 and grupo.idEntrenador=".$_SESSION['id_en']."");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
				{
						$resultados[$c]=array('idGrupo'=> $data[0],'idCategoria1'=> $data[1],'nombre_gru'=> $data[2],'categoria_sub'=> $data[3], 'idCategoria' => $data[4],'res'=> 1);
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
			$fecha_actual=date("Y/m/d");
			$nom = filter_var($_POST['modNombre2'],FILTER_SANITIZE_STRING);
			$cat_id = filter_var($_POST['modCategoria'],FILTER_SANITIZE_NUMBER_INT);
			$grupo_id = filter_var($_POST['idGrupo'],FILTER_SANITIZE_NUMBER_INT);
			$cat_gru_id = filter_var($_POST['idcat'],FILTER_SANITIZE_NUMBER_INT);
			$fecha_actual=date("Y/m/d");
			$campos = array('nombre_gru','fecha_mod');
			$valores = array($nom,$fecha_actual);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('grupo', $campos, array(2,2) , $valores, 'idGrupo', $grupo_id);
			// actualiza idcategoria en la tabla categoria_grupo
			$result2= updateA('categoria_grupo', array('idCategoria'), array(2) , array($cat_id), 'idCategoria_grupo', $cat_gru_id);
			if ($result && $result2){		
				$resultados=array('resp'=> 1);
			}
			else
			{
				$resultados=array('resp'=> 0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		case "eliminar":
			
			$grupo_id = filter_var($_POST['idGrupo'],FILTER_SANITIZE_NUMBER_INT);
			
			$fecha_actual=date("Y/m/d");
			$campos = array('estado_gru','fecha_mod');
			$valores = array(0,$fecha_actual);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('grupo', $campos, array(2,2) , $valores, 'idGrupo', $grupo_id);
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