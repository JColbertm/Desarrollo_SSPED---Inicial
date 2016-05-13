<?php require_once('conexion.php'); ?>

<?php 
		
					$nom=filter_var($_POST["nombre-reg"],FILTER_SANITIZE_STRING);
				    $cate=filter_var($_POST["cate-reg"],FILTER_VALIDATE_INT);//categoria
				    $pre=filter_var($_POST["prepa-reg"],FILTER_VALIDATE_INT);//tipo_ejercicio
				    $ele=filter_var($_POST["ele-reg"],FILTER_VALIDATE_INT);//elemento tecnico
				    $metodo=filter_var($_POST["met-reg"],FILTER_SANITIZE_STRING);
				    $tarea=filter_var($_POST["tarea-reg"],FILTER_SANITIZE_STRING);
				    $descrip=filter_var($_POST["des-reg"],FILTER_SANITIZE_STRING);
				    $foto=$_FILES["abrir-ima"]["name"];
				    if($foto==null){
				    	$destino="fotos/imagenfutbol.png";
				    	
				    }
				    else{
				    $ruta=$_FILES["abrir-ima"]["tmp_name"];
				    $destino=filter_var("fotos/".$foto,FILTER_SANITIZE_STRING);
				    copy($ruta,$destino);

						}	

					//solicitando existencias

									$query = 'INSERT INTO ejercicio (idEjercicio,idTipo_ejercicio,idCategoria, nombre,idEjer_tecnico,metodo,tarea,descripcion,imagen_ejercicio,estado_ejer)
									VALUES ("",\''.$pre.'\',\''.$cate.'\',\''.$nom.'\',\''.$ele.'\',\''.$metodo.'\',\''.$tarea.'\',\''.$descrip.'\',\''.$destino.'\',"1")';
									mysql_query($query);	
									echo 1;
								
		
?>