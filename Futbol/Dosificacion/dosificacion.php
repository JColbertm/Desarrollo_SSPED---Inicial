
<?php
@session_start();
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
	switch ($opcion) {
		case "buscara":
			$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
			
			$result= execSqlA("SELECT idDireccion, sistema_juego, preparation_fisica, tecnico_tactico, competencia, accion_psi, total FROM direccion WHERE idDireccion=\"".$a."\"");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
			{
					$resultados[$c]=array('idDireccion'=> $data[0],'sistema_juego'=> $data[1],'preparation_fisica'=> $data[2],'tecnico_tactico'=> $data[3],'competencia'=> $data[4],'accion_psi'=> $data[5],'total'=> $data[6]);
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
			$a=filter_var($_POST['tec-ele'],FILTER_SANITIZE_STRING);
			$b=filter_var($_POST['idprepa'],FILTER_SANITIZE_STRING);
			$result= execSqlA("select ejercicio.idEjercicio,ejercicio.nombre,ejercicio.idTipo_ejercicio,tipo_ejercicio.ejercicio ,categoria.idCategoria,categoria.categoria_sub,ejercicio.idEjer_tecnico,elemento_tecnico.elemento_tecnico,ejercicio.metodo,ejercicio.tarea,ejercicio.descripcion,ejercicio.imagen_ejercicio 
								from ejercicio,tipo_ejercicio,categoria,elemento_tecnico 
								where ejercicio.idEjer_tecnico = \"".$a."\"
								and ejercicio.idTipo_ejercicio= \"".$b."\"
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
		case "insertar":
   
			    $tec=$_POST['tec']; 
			    $fis=$_POST['fis']; 
			    $tac=$_POST['tac']; 
			    $psi=$_POST['psi']; 
			    $comp=$_POST['comp']; 
			    $total=$_POST['tiempo']; 
			    $direccion=$_POST['direccion'];
			    $fecha=$_POST['fecha'];
			    $dia=$_POST['dia'];

			    $ejer1=$_POST['ejer1'];
			    $ejer11=$_POST['ejer11'];
			    $ejer2=$_POST['ejer2'];
			    $ejer22=$_POST['ejer22'];
			    $ejer3=$_POST['ejer3'];
			    $ejer33=$_POST['ejer33'];
			    $ejer4=$_POST['ejer4'];
			    $ejer44=$_POST['ejer44'];
			    $ejer5=$_POST['ejer5'];
			    $ejer55=$_POST['ejer55'];

			    $result2= insertA('programacion', array('idProgramacion', 'idDireccion', 'idDia', 'fecha', 'tiempo', 'tec', 'fis', 'tac', 'psi', 'comp', 'total', 'ejer1', 'ejer11', 'ejer2', 'ejer22', 'ejer3', 'ejer33', 'ejer4', 'ejer44', 'ejer5', 'ejer55'),array(2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2), array("",$direccion,$dia,$fecha,$total,$tec,$fis,$tac,$psi,$comp,$total,$ejer1,$ejer11,$ejer2,$ejer22,$ejer3,$ejer33,$ejer4,$ejer44,$ejer5,$ejer55));
			    $row= execSqlA("SELECT MAX(idProgramacion) FROM programacion");
					//almacenamos el valor en una variable php
					while ($data = mysqli_fetch_array($row)){			  
					   $var1 = $data[0];
					}
				$result= updateA('direccion', array('estado'), array(2) , array('1'), 'idDireccion', $direccion);
			
				
			echo json_encode($var1);
			flush();
			
		break;
		
	}

	
?>