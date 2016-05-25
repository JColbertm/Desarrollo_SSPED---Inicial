<?php
		$opcion = filter_var($_POST['opcion'],FILTER_SANITIZE_STRING);
		//$plan = filter_var($_POST['plan'],FILTER_SANITIZE_STRING);
		include("databaseA.php");
		switch ($opcion)
		{
			case "listar":
			$result= execSqlA("select planificacion.idPlanificacion, planificacion.nombre, grupo.nombre_gru, categoria.categoria_sub, tipo_plan.plan  from planificacion,grupo,tipo_plan,categoria_grupo,categoria where planificacion.idGrupo = grupo.idGrupo and planificacion.idTipo_plan=tipo_plan.idTipo_plan and categoria_grupo.idGrupo=planificacion.idGrupo and categoria_grupo.idCategoria=categoria.idCategoria and planificacion.estado=1");
			$resultados=array();
			if (mysqli_num_rows($result)  > 0) {
				$c=0;
				while($data = mysqli_fetch_array($result))
				{
						$resultados[$c]=array('id'=> $data[0], 'nombre'=> $data[1],'grupo'=> $data[2],'categoria' => $data[3],'tipo_plan'=> $data[4], 'res'=> 1);
						$c++;
				}	
			}
			else {
				$resultados=array('res'=> 0);
			}
			echo json_encode($resultados);
			flush();
			break;

			case "eliminar":
			
				$plani_id = filter_var($_POST['idP'],FILTER_SANITIZE_NUMBER_INT);
				
				$fecha_actual=date("Y/m/d");
				$campos = array('estado');
				$valores = array(0);
				//actualiza nombre de equipo en la tabla grupo
				$result= updateA('planificacion', $campos, array(2) , $valores, 'idPlanificacion', $plani_id);
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

			case "buscar":
				$a = filter_var($_POST['a'],FILTER_SANITIZE_STRING);
				$result= execSqlA("select planificacion.idPlanificacion, planificacion.nombre, grupo.nombre_gru, categoria.categoria_sub, tipo_plan.plan  from planificacion,grupo,tipo_plan,categoria_grupo,categoria where planificacion.nombre LIKE '%$a%' and planificacion.idGrupo = grupo.idGrupo and planificacion.idTipo_plan=tipo_plan.idTipo_plan and categoria_grupo.idGrupo=planificacion.idGrupo and categoria_grupo.idCategoria=categoria.idCategoria and planificacion.estado=1");
				$resultados=array();
				if (mysqli_num_rows($result)  > 0) {
					$c=0;
					while($data = mysqli_fetch_array($result))
				{
						$resultados[$c]=array('id'=> $data[0], 'nombre'=> $data[1],'grupo'=> $data[2],'categoria' => $data[3],'tipo_plan'=> $data[4], 'res'=> 1);
						$c++;
					}	
				}
				else {
					$resultados=array('res'=> 0);
				}
				echo json_encode($resultados);
				flush();


				
			break;




			case "gral":
						$fecha_actual=date("Y-m-d");
						$a = filter_var($_POST['fechainiprepa'],FILTER_SANITIZE_STRING);
						$b = filter_var($_POST['diassemana'],FILTER_SANITIZE_NUMBER_INT);
						$c = filter_var($_POST['tiempoclase'],FILTER_SANITIZE_NUMBER_INT);
						$d = filter_var($_POST['t_calentamiento'],FILTER_SANITIZE_NUMBER_INT);

						$sem = filter_var($_POST['semanas'],FILTER_SANITIZE_NUMBER_INT);
						$me = filter_var($_POST['meses'],FILTER_SANITIZE_NUMBER_INT);

						if($c==60){$cale= 15;}
						if($c==90){$cale= 20;}
						if($c==120){$cale= 20;}

						$sem=$sem-$d;

						$dias = $b * $sem;
						$tiempo = round((($c * $dias)-($cale*$dias))/60);
						$nuevafecha = strtotime ( '+'.$me.' month' , strtotime ( $a ) ) ;
						$nuevafecha = date ( 'd-m-Y' , $nuevafecha );

						$multidimensional = array('semanas'=>($sem),'dias'=> $dias,'tiempo'=> $tiempo, 'fecha'=> $nuevafecha);
						echo json_encode($multidimensional);
						flush();
					break;



			

			case "calcular_xcompetencia":
				$fecha_actual=date("Y-m-d");
				$a = filter_var($_POST['fechainiprepa'],FILTER_SANITIZE_STRING);
				$b = filter_var($_POST['fechainicomp'],FILTER_SANITIZE_STRING);
				$c = filter_var($_POST['fechafincomp'],FILTER_SANITIZE_STRING);
				$d = filter_var($_POST['diassemana'],FILTER_SANITIZE_NUMBER_INT);
				$e = filter_var($_POST['tiempoclase'],FILTER_SANITIZE_NUMBER_INT);

				$f = filter_var($_POST['t_calentamiento'],FILTER_SANITIZE_NUMBER_INT);
				

				$segundos=strtotime($c) - strtotime($a);
				$semanas=intval($segundos/60/60/24/7);
				$semanas=$semanas+$f;
				
				//$sem=$d-$sem;
				$dias = $d * $semanas;
				$tiempo = ($e * $dias)/60;
				

				$multidimensional = array('semanas'=>$semanas,'dias'=> $dias,'tiempo'=> $tiempo);
			
				echo json_encode($multidimensional);
				flush();
			break;



			case "agregar_plan":

				$idg = filter_var($_POST['id_grupo'],FILTER_SANITIZE_NUMBER_INT);
				$tipo_plan = filter_var($_POST['id_p'],FILTER_SANITIZE_NUMBER_INT);
				$fecha1 = filter_var($_POST['fechainiprepa'],FILTER_SANITIZE_STRING);
				$fecha2 = filter_var($_POST['fechainicomp'],FILTER_SANITIZE_STRING);
				$fecha3 = filter_var($_POST['fechafincomp'],FILTER_SANITIZE_STRING);
				$frecu = filter_var($_POST['diassemana'],FILTER_SANITIZE_NUMBER_INT);
				$tiemp = filter_var($_POST['tiempoclase'],FILTER_SANITIZE_NUMBER_INT);
				$cant_s = filter_var($_POST['cantisemanas'],FILTER_SANITIZE_NUMBER_INT);
				$cant_d = filter_var($_POST['cantidias'],FILTER_SANITIZE_NUMBER_INT);
				$t_total = filter_var($_POST['tiempototal'],FILTER_SANITIZE_NUMBER_INT);
				$tran = filter_var($_POST['t_calentamiento'],FILTER_SANITIZE_NUMBER_INT);
				$nombreP = filter_var($_POST['nombrePlanificacion'],FILTER_SANITIZE_STRING);

				$cal=0;
				if($tiemp==60){$cal=15;}if($tiemp==90){$cal=20;}if($tiemp==120){$cal=20;}
				$t_real=($tiemp-$cal)*$frecu;

				//insertamos nuevo registro en tabla planificacion
				$campos = array('idGrupo', 'idTipo_plan', 'fecha_inicio_pre', 'fecha_inicio_comp', 'fecha_fin', 'frecuencia', 'tiempo_clase', 'transito','cant_semanas', 'cant_dias', 'tiempo_total', 'estado', 'tiempoSemana','nombre');
				$valores = array($idg,$tipo_plan,$fecha1,$fecha2,$fecha3,$frecu,$tiemp,$tran,$cant_s,$cant_d,$t_total,1, $t_real,$nombreP);
				$result= insertA('planificacion', $campos, array(2,2,2,2,2,2,2,2,2,2,2,2,2,2) , $valores);

				//para planificacion_periodo
				
				//obtenemos el ultimo id de planificacion
					$row= execSqlA("select idPlanificacion FROM planificacion WHERE idPlanificacion=(SELECT MAX(idPlanificacion) FROM planificacion)");
					//almacenamos el valor en una variable php
					while ($data = mysqli_fetch_array($row)){			  
					   $var1 = $data[0];
					}



					//agregar a tabla preparatorio
					$s1 = filter_var($_POST['sema1'],FILTER_SANITIZE_NUMBER_INT);
					$pp = filter_var($_POST['optradioS'],FILTER_SANITIZE_NUMBER_INT);
					//insertamos nuevo registro en tabla grupo
					$campos2 = array('idPlanificacion', 'idPeriodo', 'porcentaje', 'semanas');
					$valores2 = array($var1,1,$pp,$s1);
					$s2 = filter_var($_POST['sema2'],FILTER_SANITIZE_NUMBER_INT);
					$pc = filter_var($_POST['optradioSC'],FILTER_SANITIZE_NUMBER_INT);

					$valores3 = array($var1,2,$pc,$s2);
					$result2= insertA('planificacion_periodo', $campos2, array(2,2,2,2) , $valores2);
					$result3= insertA('planificacion_periodo', $campos2, array(2,2,2,2) , $valores3);

					////////////////////

					$s1_1 = filter_var($_POST['meso1'],FILTER_SANITIZE_NUMBER_INT);
					$pp_1 = filter_var($_POST['optradioP'],FILTER_SANITIZE_NUMBER_INT);

					$s1_2 = filter_var($_POST['meso2'],FILTER_SANITIZE_NUMBER_INT);
					$pp_2 = filter_var($_POST['optradioE'],FILTER_SANITIZE_NUMBER_INT);

					$s2_1 = filter_var($_POST['meso3'],FILTER_SANITIZE_NUMBER_INT);
					$pc_1 = filter_var($_POST['optradioPC'],FILTER_SANITIZE_NUMBER_INT);

					$s2_2 = filter_var($_POST['meso4'],FILTER_SANITIZE_NUMBER_INT);
					$pc_2 = filter_var($_POST['optradioCOM'],FILTER_SANITIZE_NUMBER_INT);

					$seman1 = filter_var($_POST['tiempo3'],FILTER_SANITIZE_NUMBER_INT);
					$seman2 = filter_var($_POST['tiempo4'],FILTER_SANITIZE_NUMBER_INT);
					$seman3 = filter_var($_POST['tiempo5'],FILTER_SANITIZE_NUMBER_INT);
					$seman4 = filter_var($_POST['tiempo6'],FILTER_SANITIZE_NUMBER_INT);

					$result4 = execSqlA("insert into planificacion_etapa (idPlanificacion, idEtapa, porcentaje, semanas,mesociclo) values('".$var1."','1','".$pp_1."','".$seman1."','".$s1_1."'),('".$var1."','2','".$pp_2."','".$seman2."','".$s1_2."'),('".$var1."','3','".$pc_1."','".$seman3."','".$s2_1."'),('".$var1."','4','".$pc_2."','".$seman4."','".$s2_2."')");

					$quer = "insert into mesociclo (idPlanificacion, idPlanificacion_etapa, ciclo, semanas) values";
					$mm=1;
					$tt=1;


					$semanas1 = explode(",",$_POST['semanas_1']);
					foreach ($semanas1 as $semm1) {
						$quer .= "('".$var1."','1','".$mm."','".$semm1."'),";
					//	if($tt<$s1_1)
					//	{
						//	$quer .=",";
					//	}
						$tt++;
						$mm++;
					}
					$tt=1;
					$semanas2 = explode(",",$_POST['semanas_2']);
					foreach ($semanas2 as $semm2) {
						//if($tt<$s2_1)
						//{
						//	$quer .=",";
						//}
						$quer .= "('".$var1."','2','".$mm."','".$semm2."'),";
						$tt++;
						$mm++;
					}

					$tt=1;
					$semanas3 = explode(",",$_POST['semanas_3']);
					foreach ($semanas3 as $semm3) {
					//	if($tt<$s2_1)
						//{
					//		$quer .=",";
					//	}
						$quer .= "('".$var1."','3','".$mm."','".$semm3."'),";
						$tt++;
						$mm++;
					}

					$tt=1;
					$semanas4 = explode(",",$_POST['semanas_4']);
					foreach ($semanas4 as $semm4) {
						$quer .= "('".$var1."','4','".$mm."','".$semm4."')";
						if($tt<$s2_2)
						{
							$quer .=",";
						}
						$tt++;
						$mm++;
					}
					$result5 = execSqlA($quer);


					$semanas1_d = $semanas1;
					$semanas2_d = $semanas2;
					$semanas3_d = $semanas3;
					$semanas4_d = $semanas4;


					 $campos9 = array('idPlanificacion', 'idMesociclo', 'semana', 'sistema_juego', 'preparation_fisica', 'tecnico_tactico', 'competencia','accion_psi','total');

					 $row2= execSqlA("select MIN(idMesociclo) from mesociclo WHERE idPlanificacion=".$var1."");
					//almacenamos el valor en una variable php
					$var2=0;
					while ($data2 = mysqli_fetch_array($row2)){			  
					   $var2 = $data2[0];
					}
					$h=1;
//si todos los campos estan llenos
					$gen_tec=$gen_fis=$gen_tac=$gen_psi=$gen_com="";
					$gen_tec = filter_var($_POST['gen_tec'],FILTER_SANITIZE_NUMBER_INT);
					$gen_fis= filter_var($_POST['gen_fis'],FILTER_SANITIZE_NUMBER_INT);
					$gen_tac= filter_var($_POST['gen_tac'],FILTER_SANITIZE_NUMBER_INT);
					$gen_psi = filter_var($_POST['gen_psi'],FILTER_SANITIZE_NUMBER_INT);
					$gen_com = filter_var($_POST['gen_com'],FILTER_SANITIZE_NUMBER_INT);
					if($result && $result2 && $result3 && $result4 && $result5 )
					{
						
					$result=array('resp'=> $quer,'idplani'=> $var1);
			
					}
				
					foreach ($semanas1_d as $semm1_d) {
						
						switch($semm1_d)
						{
							case "2" :

								//si todos los campos estan llenos

								
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= round(($tot5*$t_real)/100);

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TECNICA
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta psicologica
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta comp y tac
								if(($gen_tac=="") && ($gen_com=="") && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta tec y fis
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis=="") && ($gen_tec=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if((($gen_tac=="") ^ ($gen_com=="")) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tac=="") ^ ($gen_com=="")) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "3":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
								if(  ($gen_tac>0) && (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA PSICO
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC Y FIS
								if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if( (($gen_tec=="") ^ ($gen_fis=="")) && $gen_tac>0 && $gen_com>0 && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "4":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ $gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+55)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+45)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+45)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+55)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if(( ($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
							$var2=$var2+1;
							break;

							case "5":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
								$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								$var2=$var2+1;
							break;

							case "6":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;
$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}	
								$var2=$var2+1;

							break;
							}
						}
					
					$gen_tec=$gen_fis=$gen_tac=$gen_psi=$gen_com="";
					$gen_tec = filter_var($_POST['esp_tec'],FILTER_SANITIZE_NUMBER_INT);
					$gen_fis= filter_var($_POST['esp_fis'],FILTER_SANITIZE_NUMBER_INT);
					$gen_tac= filter_var($_POST['esp_tac'],FILTER_SANITIZE_NUMBER_INT);
					$gen_psi = filter_var($_POST['esp_psi'],FILTER_SANITIZE_NUMBER_INT);
					$gen_com = filter_var($_POST['esp_com'],FILTER_SANITIZE_NUMBER_INT);
					foreach ($semanas2_d as $semm2_d) {
						
						switch($semm2_d)
						{
							case "2" :

								//si todos los campos estan llenos

								
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TECNICA
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta psicologica
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta comp y tac
								if(($gen_tac=="") && ($gen_com=="") && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta tec y fis
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis=="") && ($gen_tec=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if((($gen_tac=="") ^ ($gen_com=="")) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tac=="") ^ ($gen_com=="")) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "3":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
								if(  ($gen_tac>0) && (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA PSICO
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC Y FIS
								if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if( (($gen_tec=="") ^ ($gen_fis=="")) && $gen_tac>0 && $gen_com>0 && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "4":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ $gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+55)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+45)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+45)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+55)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if(( ($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
							$var2=$var2+1;
							break;

							case "5":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
								$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								$var2=$var2+1;
							break;

							case "6":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;
$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}	
								$var2=$var2+1;

							break;
							}
						}
					

					$gen_tec=$gen_fis=$gen_tac=$gen_psi=$gen_com="";
					$gen_tec = filter_var($_POST['pcom_tec'],FILTER_SANITIZE_NUMBER_INT);
					$gen_fis= filter_var($_POST['pcom_fis'],FILTER_SANITIZE_NUMBER_INT);
					$gen_tac= filter_var($_POST['pcom_tac'],FILTER_SANITIZE_NUMBER_INT);
					$gen_psi = filter_var($_POST['pcom_psi'],FILTER_SANITIZE_NUMBER_INT);
					$gen_com = filter_var($_POST['pcom_com'],FILTER_SANITIZE_NUMBER_INT);
					foreach ($semanas3_d as $semm3_d) {
						
						switch($semm3_d)
						{
							case "2" :

								//si todos los campos estan llenos

								
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TECNICA
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta psicologica
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta comp y tac
								if(($gen_tac=="") && ($gen_com=="") && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta tec y fis
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis=="") && ($gen_tec=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if((($gen_tac=="") ^ ($gen_com=="")) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tac=="") ^ ($gen_com=="")) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "3":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
								if(  ($gen_tac>0) && (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA PSICO
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC Y FIS
								if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if( (($gen_tec=="") ^ ($gen_fis=="")) && $gen_tac>0 && $gen_com>0 && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "4":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ $gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+55)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+45)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+45)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+55)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if(( ($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
							$var2=$var2+1;
							break;

							case "5":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
								$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								$var2=$var2+1;
							break;

							case "6":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;
$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}	
								$var2=$var2+1;

							break;
							}
						}





					$gen_tec=$gen_fis=$gen_tac=$gen_psi=$gen_com="";
					$gen_tec = filter_var($_POST['com_tec'],FILTER_SANITIZE_NUMBER_INT);
					$gen_fis= filter_var($_POST['com_fis'],FILTER_SANITIZE_NUMBER_INT);
					$gen_tac= filter_var($_POST['com_tac'],FILTER_SANITIZE_NUMBER_INT);
					$gen_psi = filter_var($_POST['com_psi'],FILTER_SANITIZE_NUMBER_INT);
					$gen_com = filter_var($_POST['com_com'],FILTER_SANITIZE_NUMBER_INT);
					foreach ($semanas4_d as $semm4_d) {
						
						switch($semm4_d)
						{
							case "2" :

								//si todos los campos estan llenos

								
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TECNICA
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta psicologica
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta comp y tac
								if(($gen_tac=="") && ($gen_com=="") && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//si falta tec y fis
								if(($gen_tac>0) && ($gen_com>0) && ($gen_fis=="") && ($gen_tec=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if((($gen_tac=="") ^ ($gen_com=="")) && ($gen_fis>0) && ($gen_tec>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if(($gen_tac>0) && ($gen_com>0) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tac=="") ^ ($gen_com=="")) && (($gen_fis=="") ^ ($gen_tec=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "3":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
								if(  ($gen_tac>0) && (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA PSICO
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
								if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC Y FIS
								if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
								if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
								if( (($gen_tec=="") ^ ($gen_fis=="")) && $gen_tac>0 && $gen_com>0 && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA TEC O FIS Y TAC O COMP
								if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								$var2=$var2+1;
							break;

							case "4":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ $gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}
								//SI FALTA FISICO O TEC
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="") )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+55)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+45)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0) )
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+45)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+55)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if( (($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if(( ($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+55)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+45)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+45)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+55)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
							$var2=$var2+1;
							break;

							case "5":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+10)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
								

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+10)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
								$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								$var2=$var2+1;
							break;

							case "6":
							//todos los campos llenos
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_psi>0) && ($gen_com>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}

								//SI FALTA COM O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";




									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$h++;
								}
								//SI FALTA FISICO O TEC
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSICO
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi=="" ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+10)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+10)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA COMP Y TAC
							if(($gen_tec>0) && ($gen_fis>0) && ($gen_tac=="") && ($gen_com=="") && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+60)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+40)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

									//SI FALTA TEC Y FIS
							if(($gen_tec=="") && ($gen_fis=="") && ($gen_tac>0) && ($gen_com>0) && ($gen_psi>0 ))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";


									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+40)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;
$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+60)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  COMP O TAC
							if(($gen_tec>0) && ($gen_fis>0) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+50)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+30)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									
									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis+20)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA PSIC Y  TEC O FIS
							if((($gen_tec=="") ^ ($gen_fis=="")) && ($gen_tac>0) && ($gen_com>0) && ($gen_psi==""))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+20)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+30)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+30)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+20)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+20)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+30)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com+50)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									 $total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}

								//SI FALTA TEC O FIS Y TAC O COMP
							if((($gen_tec=="") ^ ($gen_fis=="")) && (($gen_tac=="") ^ ($gen_com=="")) && ($gen_psi>0))
								{
									$valores10="";
									 $tot1=$tot2=$tot3=$tot4=$tot5=0;

									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 
									

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 
									

									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 
									 

									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);
									 

									 $tot5= $gen_psi/2;
									 $tot5= ($tot5*$t_real)/100;
									
									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";



									 $tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+60)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+40)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+50)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+50)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;

									$tot1=$tot2=$tot3=$tot4=$tot5=0;
									 $tot1= ($gen_tec+40)/2;
									 $tot1= round(($tot1*$t_real)/100); 

									 $tot2= ($gen_fis)/2;
									 $tot2= round(($tot2*$t_real)/100); 


									 $tot3= ($gen_tac+60)/2;
									 $tot3= round(($tot3*$t_real)/100); 


									 $tot4= ($gen_com)/2;
									 $tot4= round(($tot4*$t_real)/100);


									 $tot5= ($gen_psi)/2;
									 $tot5= ($tot5*$t_real)/100;
									 $h++;

									$total = 0;
									$total=$tot1+$tot2+$tot3+$tot4+$tot5;
									
									$valores10 = array($var1,$var2,$h,$tot1,$tot2,$tot3,$tot4,$tot5,$total);
									$result10= insertA('direccion', $campos9, array(2,2,2,2,2,2,2,2,2) , $valores10);
									$valores10="";
									$result10="";
									$h++;
								}	
								$var2=$var2+1;

							break;
							}
						}

				echo json_encode($result);
				flush();
			break; 
		}
	
?> 