
<?php
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
	switch ($opcion) {
		case "registrar":
					$nom=filter_var($_POST["nombre-reg"],FILTER_SANITIZE_STRING);
				    $cate=filter_var($_POST["cate-reg"],FILTER_VALIDATE_INT);//categoria
				    $pre=filter_var($_POST["prepa-reg"],FILTER_VALIDATE_INT);//tipo_ejercicio
				    $ele=filter_var($_POST["ele-reg"],FILTER_VALIDATE_INT);//elemento tecnico 
				    $metodo=filter_var($_POST["met-reg"],FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
				    $tarea=filter_var($_POST["tarea-reg"],FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
				    $descrip=filter_var($_POST["des-reg"],FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
				    $foto=$_FILES["abrir-ima"]["name"];
				    if($foto==null)
				    {
				    	$destino="fotos/imagenfutbol.png";
				    	$result2= insertA('ejercicio', array('idEjercicio','idTipo_ejercicio','idCategoria', 'nombre','idEjer_tecnico','metodo','tarea','descripcion','imagen_ejercicio','estado_ejer'),array(2,2,2,2,2,2,2,2,2,2), array("",$pre,$cate,$nom,$ele,$metodo,$tarea,$descrip,$destino,"1"));
				    	if ($result2){		
				
								$resultados=array('resp'=> 1);
							}
							else
							{
								$resultados=array('resp'=> 0);
							}
				    }else{
				    	$filename = strtolower($foto);
    				if ($_FILES["abrir-ima"]["type"]=="image/jpeg")
						{
							if($_FILES['abrir-ima']['size'] <= 5900000)
							{
									$ruta=$_FILES["abrir-ima"]["tmp_name"];
								    $destino=filter_var("fotos/".$foto,FILTER_SANITIZE_STRING);
								    copy($ruta,$destino);
								    $result2= insertA('ejercicio', array('idEjercicio','idTipo_ejercicio','idCategoria', 'nombre','idEjer_tecnico','metodo','tarea','descripcion','imagen_ejercicio','estado_ejer'),array(2,2,2,2,2,2,2,2,2,2), array("",$pre,$cate,$nom,$ele,$metodo,$tarea,$descrip,$destino,"1"));
								    if ($result2){		
								
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
		case "buscar":
			$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
			$result= execSqlA("select ejercicio.idEjercicio,ejercicio.nombre,ejercicio.idTipo_ejercicio,tipo_ejercicio.ejercicio ,categoria.idCategoria,categoria.categoria_sub,ejercicio.idEjer_tecnico,elemento_tecnico.elemento_tecnico,ejercicio.metodo,ejercicio.tarea,ejercicio.descripcion,ejercicio.imagen_ejercicio 
								from ejercicio,tipo_ejercicio,categoria,elemento_tecnico 
								where ejercicio.nombre LIKE '%$a%' 
								and ejercicio.idTipo_ejercicio=tipo_ejercicio.idTipo_ejercicio 
								and ejercicio.idCategoria=categoria.idCategoria 
								and ejercicio.idEjer_tecnico=elemento_tecnico.idEjer_tecnico
								and estado_ejer=1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idEjercicio'=> $data[0],'nombre'=> $data[1],'idTipo_ejercicio'=> $data[2],'ejercicio'=> $data[3],'idCategoria'=> $data[4],'categoria_sub'=> $data[5],'idEjer_tecnico'=> $data[6],'elemento_tecnico'=> $data[7],'metodo'=> $data[8],'tarea'=> $data[9],'descripcion'=> $data[10],'imagen_ejercicio'=>$data[11]);
					$c++;
				}	
			}
			else {
				$resultados=array(0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
		case "modificar":
		$idejer=filter_var($_POST["idejer"],FILTER_VALIDATE_INT);
			$nom=filter_var($_POST["nombre-mod"],FILTER_SANITIZE_STRING);
				    $cate=filter_var($_POST["cate-mod"],FILTER_VALIDATE_INT);//categoria
				    $pre=filter_var($_POST["prepa-mod"],FILTER_VALIDATE_INT);//tipo_ejercicio
				    $ele=filter_var($_POST["ele-mod"],FILTER_VALIDATE_INT);//elemento tecnico
				    $metodo=filter_var($_POST["met-mod"],FILTER_SANITIZE_STRING);
				    $tarea=filter_var($_POST["tarea-mod"],FILTER_SANITIZE_STRING);
				    $descrip=filter_var($_POST["des-mod"],FILTER_SANITIZE_STRING);
				    $foto_mod=filter_var($_POST["foto-mod"],FILTER_SANITIZE_STRING);
				    $foto=$_FILES["abrir-ima-mod"]["name"];
				    if($foto==null){
				    	if($foto_mod==="fotos/imagenfutbol.png"){
				    	$destino="fotos/imagenfutbol.png";
				    	}else{
				    	$destino=$foto_mod;
				    	}
				    	$result2= updateA('ejercicio', array('idTipo_ejercicio','idCategoria', 'nombre','idEjer_tecnico','metodo','tarea','descripcion','imagen_ejercicio','estado_ejer'), array(2,2,2,2,2,2,2,2,2) , array($pre,$cate,$nom,$ele,$metodo,$tarea,$descrip,$destino,"1"), 'idEjercicio', $idejer);
									if ($result2){		
										$resultados=array('resp'=> 1);
									}
									else
									{
										$resultados=array('resp'=> 0);
									}
				   }
				    else{
					$filename = strtolower($foto);
						$whitelist = array('jpg'); //lista , 'png', 'gif', 'jpeg'
    				if ($_FILES["abrir-ima-mod"]["type"]=="image/jpeg")
						{
							if($_FILES['abrir-ima-mod']['size'] <= 5900000)
							{
									$ruta=$_FILES["abrir-ima-mod"]["tmp_name"];
								    $destino=filter_var("fotos/".$foto,FILTER_SANITIZE_STRING);
								    copy($ruta,$destino);
								   $result2= updateA('ejercicio', array('idTipo_ejercicio','idCategoria','nombre','idEjer_tecnico','metodo','tarea','descripcion','imagen_ejercicio','estado_ejer'), array(2,2,2,2,2,2,2,2,2) , array($pre,$cate,$nom,$ele,$metodo,$tarea,$descrip,$destino,"1"), 'idEjercicio', $idejer);
									if ($result2){		
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
		case "eliminar":
			
			$ejer_id = filter_var($_POST['idEjercicio'],FILTER_SANITIZE_NUMBER_INT);
			
			$campos = array('estado_ejer');
			$valores = array(0);
			//actualiza nombre de equipo en la tabla grupo
			$result= updateA('ejercicio', $campos, array(2) , $valores, 'idEjercicio', $ejer_id);
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
		case "tabla_llena":
				    
			
			$result= execSqlA("select ejercicio.idEjercicio,ejercicio.nombre,ejercicio.idTipo_ejercicio,tipo_ejercicio.ejercicio ,categoria.idCategoria,categoria.categoria_sub,ejercicio.idEjer_tecnico,elemento_tecnico.elemento_tecnico,ejercicio.metodo,ejercicio.tarea,ejercicio.descripcion,ejercicio.imagen_ejercicio 
								from ejercicio,tipo_ejercicio,categoria,elemento_tecnico 
								where ejercicio.idTipo_ejercicio=tipo_ejercicio.idTipo_ejercicio 
								and ejercicio.idCategoria=categoria.idCategoria 
								and ejercicio.idEjer_tecnico=elemento_tecnico.idEjer_tecnico
								and estado_ejer=1
                                
                                ");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idEjercicio'=> $data[0],'nombre'=> $data[1],'idTipo_ejercicio'=> $data[2],'ejercicio'=> $data[3],'idCategoria'=> $data[4],'categoria_sub'=> $data[5],'idEjer_tecnico'=> $data[6],'elemento_tecnico'=> $data[7],'metodo'=> $data[8],'tarea'=> $data[9],'descripcion'=> $data[10],'imagen_ejercicio'=>$data[11]);
					$c++;
				}	
			}
			else {
				$resultados=array(0);
			}
			echo json_encode($resultados);
			flush();

		break;
		case "busqueda_general":
					$cate=filter_var($_POST["cate"],FILTER_SANITIZE_STRING);
					if(isset($_POST["seleccionado1"])){
						$select1=filter_var($_POST["seleccionado1"],FILTER_VALIDATE_INT);}else{$select1='';}
					if(isset($_POST["seleccionado2"])){
						$select2=filter_var($_POST["seleccionado2"],FILTER_VALIDATE_INT);}else{$select2='';}
					if(isset($_POST["seleccionado3"])){
						$select3=filter_var($_POST["seleccionado3"],FILTER_VALIDATE_INT);}else{$select3='';}
					if(isset($_POST["seleccionado4"])){
						$select4=filter_var($_POST["seleccionado4"],FILTER_VALIDATE_INT);}else{$select4='';}
					if(isset($_POST["seleccionado5"])){
						$select5=filter_var($_POST["seleccionado5"],FILTER_VALIDATE_INT);}else{$select5='';}
					if(isset($_POST["seleccionado6"])){
						$select6=filter_var($_POST["seleccionado6"],FILTER_VALIDATE_INT);}else{$select6='';}
					if(isset($_POST["seleccionado7"])){
						$select7=filter_var($_POST["seleccionado7"],FILTER_VALIDATE_INT);}else{$select7='';}
					if(isset($_POST["seleccionado8"])){
						$select8=filter_var($_POST["seleccionado8"],FILTER_VALIDATE_INT);}else{$select8='';}
					if(isset($_POST["seleccionado9"])){
						$select9=filter_var($_POST["seleccionado9"],FILTER_VALIDATE_INT);}else{$select9='';}
					if(isset($_POST["seleccionado10"])){
						$select10=filter_var($_POST["seleccionado10"],FILTER_VALIDATE_INT);}else{$select10='';}
					if(isset($_POST["seleccionado11"])){
						$select11=filter_var($_POST["seleccionado11"],FILTER_VALIDATE_INT);}else{$select11='';}
					if(isset($_POST["seleccionado12"])){
						$select12=filter_var($_POST["seleccionado12"],FILTER_VALIDATE_INT);}else{$select12='';}
					if(isset($_POST["seleccionado13"])){
						$select13=filter_var($_POST["seleccionado13"],FILTER_VALIDATE_INT);}else{$select13='';}
					if(isset($_POST["seleccionado14"])){
						$select14=filter_var($_POST["seleccionado14"],FILTER_VALIDATE_INT);}else{$select14='';}
					if(isset($_POST["seleccionado15"])){
						$select15=filter_var($_POST["seleccionado15"],FILTER_VALIDATE_INT);}else{$select15='';}
					if(isset($_POST["seleccionado16"])){
						$select16=filter_var($_POST["seleccionado16"],FILTER_VALIDATE_INT);}else{$select16='';}
			$selecionados[0] = array("1" => $select1);
			$selecionados[1] = array("2" => $select2);
			$selecionados[2] = array("3" => $select3);

			$result= execSqlA("select ejercicio.nombre,categoria.categoria_sub,tipo_ejercicio.ejercicio,elemento_tecnico.elemento_tecnico,ejercicio.descripcion,ejercicio.imagen_ejercicio
								from ejercicio
                                inner JOIN categoria
                                on 	ejercicio.idCategoria=categoria.idCategoria
                                inner  JOIN elemento_tecnico
                                on 	ejercicio.idEjer_tecnico=elemento_tecnico.idEjer_tecnico
                                inner  JOIN tipo_ejercicio
                                on 	ejercicio.idTipo_ejercicio=tipo_ejercicio.idTipo_ejercicio
								where ejercicio.idCategoria=\"".$cate."\" 
								and estado_ejer=1
								and ejercicio.idEjer_tecnico=\"".$select11."\"
                                or ejercicio.idEjer_tecnico=\"".$select2."\"
                                or ejercicio.idEjer_tecnico=\"".$select3."\"
                                or ejercicio.idEjer_tecnico=\"".$select4."\"
                                or ejercicio.idEjer_tecnico=\"".$select5."\"
                                or ejercicio.idEjer_tecnico=\"".$select6."\"
                                or ejercicio.idEjer_tecnico=\"".$select7."\"
                                or ejercicio.idEjer_tecnico=\"".$select8."\"
                                or ejercicio.idEjer_tecnico=\"".$select9."\"
                                or ejercicio.idEjer_tecnico=\"".$select10."\"
                                or ejercicio.idEjer_tecnico=\"".$select11."\"
                                or ejercicio.idEjer_tecnico=\"".$select12."\"
                                or ejercicio.idEjer_tecnico=\"".$select13."\"
                                or ejercicio.idEjer_tecnico=\"".$select14."\"
                                or ejercicio.idEjer_tecnico=\"".$select15."\"
                                or ejercicio.idEjer_tecnico=\"".$select16."\"
                                ");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('nombre'=> $data[0],'categoria_sub'=> $data[1],'ejercicio'=> $data[2],'elemento_tecnico'=> $data[3],'descripcion'=> $data[4],'imagen_ejercicio'=>$data[5]);
					$c++;
				}	
			}
			else {
				$resultados=array(0);
			}
			echo json_encode($resultados);
			flush();


			
		break;
	}
	
?>