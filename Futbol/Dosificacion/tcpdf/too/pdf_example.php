<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
		include("databaseA.php");
  
// get data from users table
		if(isset($_POST['dosifi'])){
			$id=$_POST['dosifi'];
		}
		if(isset($_POST['idpro'])){
			$id=$_POST['idpro'];
		}



$row= execSqlA("SELECT * FROM programacion WHERE idProgramacion = \"".$id."\"");

while ($data = mysqli_fetch_array($row)){
$idDireccion=$data['idDireccion'];
$idDia=$data['idDia'];			  
$fecha = $data['fecha'];
$tiempo = $data['tiempo'];
$tec = $data['tec'];
$fis = $data['fis'];
$tac = $data['tac'];
$psi = $data['psi'];
$comp = $data['comp'];
$ejer1= $data['ejer1'];
$ejer11= $data['ejer11'];
$ejer2= $data['ejer2'];
$ejer22= $data['ejer22'];
$ejer3= $data['ejer3'];
$ejer33= $data['ejer33'];
$ejer4= $data['ejer4'];
$ejer44= $data['ejer44'];
$ejer5= $data['ejer5'];
$ejer55= $data['ejer55'];
  }
 $row= execSqlA("SELECT idPlanificacion FROM direccion WHERE idDireccion = \"".$idDireccion."\"");while ($data = mysqli_fetch_array($row)){
 	$idPlani=$data['idPlanificacion'];
}
// seleccionamos el ano de inicio de la planificacion
$row= execSqlA("SELECT YEAR(fecha_inicio_pre)as ano FROM planificacion where idPlanificacion = \"".$idPlani."\"");
while ($data = mysqli_fetch_array($row)){
 	$ano=$data['ano'];
}
// seleccionamos el ano donde termina de la planificacion
$row= execSqlA("SELECT YEAR(fecha_fin)as ano_fin FROM planificacion where idPlanificacion = \"".$idPlani."\"");
while ($data = mysqli_fetch_array($row)){
 	$ano_fin=$data['ano_fin'];
}

//Fijamos condiciones si son iguales o distintos
$gestion="";
 if($ano==$ano_fin){$gestion=$ano;}else{$gestion=$ano."-".$ano_fin;}
//
$row= execSqlA("select a.nombre_gru, a.idGrupo from grupo a,planificacion b where a.idGrupo =b.idGrupo and idPlanificacion= \"".$idPlani."\"");while ($data = mysqli_fetch_array($row)){
 	$nombre_gru=$data['nombre_gru'];
 	$idGrupo=$data['idGrupo'];
}
$row= execSqlA("select count(a.idGrupCat)as sumado from jugador a,categoria_grupo b where a.idGrupCat = b.idCategoria_grupo and b.idGrupo=\"".$idGrupo."\"");while ($data = mysqli_fetch_array($row)){
 	$numero_jugadores=$data['sumado'];
}
$row= execSqlA("select a.categoria_sub from categoria a,categoria_grupo b where b.idGrupo=\"".$idGrupo."\" and a.idCategoria=b.idCategoria");while ($data = mysqli_fetch_array($row)){
 	$categoria=$data['categoria_sub'];
}
$row= execSqlA("select idMesociclo from direccion where idDireccion=\"".$idDireccion."\" and idPlanificacion=\"".$idPlani."\"");while ($data = mysqli_fetch_array($row)){
 	$idMeso=$data['idMesociclo'];
}
$row= execSqlA("select idPlanificacion_etapa,ciclo from mesociclo where idMesociclo=\"".$idMeso."\" and idPlanificacion=\"".$idPlani."\"");while ($data = mysqli_fetch_array($row)){
 	$idPlani_etapa=$data['idPlanificacion_etapa'];
 	$ciclo=$data['ciclo'];
}
if($idPlani_etapa==1){$etapa="Pre Temporada";}
if($idPlani_etapa==2){$etapa="Preparacion Fisica";}
if($idPlani_etapa==3){$etapa="Pre Competitivo";}
if($idPlani_etapa==4){$etapa="Competitivo";}

		$romanos="";
        $numeros=array("1","2","3","4","5","6","7","8","9","10","11","12","13",
            "14","15","16","17","18","19","20","21","22","23","24","25");
        $romanos_letras = array("I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII","XIII",
            "XIV","XV","XVI","XVII","XVIII","IXX","XX","XXI","XXII","XXIII","XXIV","XXV");
        for($i=0;$i<25;$i++){
                if($ciclo==$numeros[$i]){$romanos=$romanos_letras[$i];}
            }

$row= execSqlA("select semana from direccion where idMesociclo=\"".$idMeso."\" and idPlanificacion=\"".$idPlani."\" and idDireccion=\"".$idDireccion."\"");while ($data = mysqli_fetch_array($row)){
 	$microciclo=$data['semana'];
}
$row= execSqlA("select tiempo_clase from planificacion where  idPlanificacion=\"".$idPlani."\"");while ($data = mysqli_fetch_array($row)){
 	$tiempo_clase=$data['tiempo_clase'];
}
if($tiempo_clase==60){$inicio=10;$final=5;}
if($tiempo_clase==90){$inicio=15;$final=5;}
if($tiempo_clase==120){$inicio=15;$final=5;}

if($ejer1!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio, descripcion from ejercicio where  idEjercicio=\"".$ejer1."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio1=$data['nombre'];
 	$tarea1=$data['tarea'];
 	$metodo1=$data['metodo'];
 	$foto1=$data['imagen_ejercicio'];
 	$desc1=$data['descripcion'];
}}else{$ejercicio1="";
 	$tarea1="";
 	$metodo1="";
  	$foto1="";
  	$desc1="";
  }

if($ejer11!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer11."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio11=$data['nombre'];
 	$tarea11=$data['tarea'];
 	$metodo11=$data['metodo'];
 	$foto11=$data['imagen_ejercicio'];
 	$desc11=$data['descripcion'];
}}else{$ejercicio11="";
 	$tarea11="";
 	$metodo11="";
 	$foto11="";
 	$desc11="";}

if($ejer2!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer2."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio2=$data['nombre'];
 	$tarea2=$data['tarea'];
 	$metodo2=$data['metodo'];
 	$foto2=$data['imagen_ejercicio'];
 	$desc2=$data['descripcion'];
}}else{$ejercicio2="";
 	$tarea2="";
 	$metodo2="";
 	$foto2="";
 	$desc2="";}

if($ejer22!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer22."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio22=$data['nombre'];
 	$tarea22=$data['tarea'];
 	$metodo22=$data['metodo'];
 	$foto22=$data['imagen_ejercicio'];
 	$desc22=$data['descripcion'];
}}else{$ejercicio22="";
 	$tarea22="";
 	$metodo22="";
 	$foto22="";
 	$desc22="";}

if($ejer3!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer3."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio3=$data['nombre'];
 	$tarea3=$data['tarea'];
 	$metodo3=$data['metodo'];
 	$foto3=$data['imagen_ejercicio'];
 	$desc3=$data['descripcion'];
}}else{$ejercicio3="";
 	$tarea3="";
 	$metodo3="";
 	$foto3="";
 	$desc3="";}

if($ejer33!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer33."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio33=$data['nombre'];
 	$tarea33=$data['tarea'];
 	$metodo33=$data['metodo'];
 	$foto33=$data['imagen_ejercicio'];
 	$desc33=$data['descripcion'];
}}else{$ejercicio33="";
 	$tarea33="";
 	$metodo33="";
 	$foto33="";
 	$desc33="";}

if($ejer4!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer4."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio4=$data['nombre'];
 	$tarea4=$data['tarea'];
 	$metodo4=$data['metodo'];
 	$foto4=$data['imagen_ejercicio'];
 	$desc4=$data['descripcion'];
}}else{$ejercicio4="";
 	$tarea4="";
 	$metodo4="";
 	$foto4="";
 	$desc4="";}

if($ejer44!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer44."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio44=$data['nombre'];
 	$tarea44=$data['tarea'];
 	$metodo44=$data['metodo'];
 	$foto44=$data['imagen_ejercicio'];
 	$desc44=$data['descripcion'];
}}else{$ejercicio44="";
 	$tarea44="";
 	$metodo44="";
 	$foto44="";
 	$desc44="";}

if($ejer5!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer5."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio5=$data['nombre'];
 	$tarea5=$data['tarea'];
 	$metodo5=$data['metodo'];
 	$foto5=$data['imagen_ejercicio'];
 	$desc5=$data['descripcion'];
}}else{$ejercicio5="";
 	$tarea5="";
 	$metodo5="";
 	$foto5="";
 	$desc5="";}

 	if($ejer55!=0){
$row= execSqlA("select nombre, tarea,metodo,imagen_ejercicio,descripcion from ejercicio where  idEjercicio=\"".$ejer55."\"");while ($data = mysqli_fetch_array($row)){
 	$ejercicio55=$data['nombre'];
 	$tarea55=$data['tarea'];
 	$metodo55=$data['metodo'];
 	$foto55=$data['imagen_ejercicio'];
 	$desc55=$data['descripcion'];
}}else{$ejercicio55="";
 	$tarea55="";
 	$metodo55="";
 	$foto55="";
 	$desc55="";}

 	$row= execSqlA("select semanas from planificacion_periodo where  idPlanificacion=\"".$idPlani."\" and idPeriodo=1");while ($data = mysqli_fetch_array($row)){
 	$semanas=$data['semanas'];
}
if($microciclo<=$semanas){
	$peri="Preparatorio";
}else{$peri="Competitivo";}

$fotos= execSqlA("SELECT foto FROM foto where id=1");
while ($data = mysqli_fetch_array($fotos)){
 	$fotoss=$data['foto'];
}

// create new PDF document
$newDate = date("d-m-Y", strtotime($fecha));
$tiempo_clase=$tiempo_clase-$inicio-$final;
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------
// set margins
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// add a page
$pdf->AddPage();
$image_file = K_PATH_IMAGES.'alpha.png';


$pdf->SetFont('helvetica', '', 10);


// set default header data
$htmlcontent = '
<table border="1">
<tr>

<th rowspan="4" colspan="4"></th>
<th rowspan="2" colspan="8" align="center"><H2>Temporada '.$gestion.'</H2></th>
<th rowspan="4" colspan="4">PERIODO: '.$peri.'<br>ETAPA: '.$etapa.'<BR>MESOCICLO: '. $romanos.'<BR>MICROCICLO: '.$microciclo.'</th>
<th rowspan="2" colspan="2">N CLASE</th>
</tr>
<tr>
<th ></th>
<th ></th>
<th ></th>
<th ></th>
</tr>
<tr>
<td colspan="2">CATEGORIA</td>
<td colspan="2">TIEMPO</td>
<td colspan="2">N JUGADOR</td>
<td colspan="2">FECHA</td>
<td rowspan="2" colspan="2"></td>
</tr>
<tr>
<th colspan="2" align="center">'.$categoria.'</th>
<th colspan="2" align="center">'.$tiempo.'</th>
<th colspan="2" align="center">'.$numero_jugadores.'</th>
<th colspan="2" align="center">'.$newDate.'</th>
</tr>
<tr>
<th colspan="18">OBJETIVO</th>
</tr>
<tr>
<th colspan="18">CONSIGNA</th>
</tr>
<tr>
<th colspan="16" align="center">PARTE INICIAL</th>
<th colspan="2" align="right">'.$inicio.' MIN</th>
</tr>
<tr>
<th rowspan="2" colspan="18"></th>
</tr>
<tr>
<th ></th>
</tr>
<tr>
<th colspan="16" align="center">PARTE PRINCIPAL</th>
<th colspan="2" align="right"> '.$tiempo_clase.' MIN</th>
</tr>
'
; 
if ($tec!=0){
$htmlcontent .= '
<tr>
<th colspan="18" align="center">EJERCICIO TECNICO</th>
</tr>
<tr>
<th colspan="9" align="center">DESCRIPCION</th>
<th colspan="7" align="center">REPRESENTACION</th>
<th colspan="2" align="right">'.$tec.' MIN</th>
</tr>
'; 
if ($ejercicio1!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio1.' <br>Tarea: '.$tarea1.' <br>Metodo: '.$metodo1.' <br>Descripcion:'.$desc1.'</th>
<th colspan="9" height="100" align="center" ><img src="../../../Galeria/acciones_abm_ejer/'.$foto1.'" alt="Mountain View" style="width:100px;height:100px;">
 </th>
</tr>
'; }
if ($ejercicio11!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio11.' <br>Tarea: '.$tarea11.' <br>Metodo: '.$metodo11.'  <br>Descripcion:'.$desc11.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto11.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'
; }}
if ($fis!=0){
$htmlcontent .= '
<tr>
<th colspan="18" align="center">EJERCICIO FISICO</th>
</tr>
<tr>
<th colspan="9" align="center">DESCRIPCION</th>
<th colspan="7" align="center">REPRESENTACION</th>
<th colspan="2" align="right">'.$fis.' MIN</th>
</tr>
'; 
if ($ejercicio2!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio2.' <br>Tarea: '.$tarea2.' <br>Metodo: '.$metodo2.'  <br>Descripcion:'.$desc2.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto2.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
';}
if ($ejercicio22!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio22.' <br>Tarea: '.$tarea22.' <br>Metodo: '.$metodo22.'  <br>Descripcion:'.$desc22.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto22.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'
; }}
if ($tac!=0){
$htmlcontent .= '
<tr>
<th colspan="18" align="center">EJERCICIO TACTICO</th>
</tr>
<tr>
<th colspan="9" align="center">DESCRIPCION</th>
<th colspan="7" align="center">REPRESENTACION</th>
<th colspan="2" align="right">'.$tac.' MIN</th>
</tr>
'; 
if ($ejercicio3!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio3.' <br>Tarea: '.$tarea3.' <br>Metodo: '.$metodo3.'  <br>Descripcion:'.$desc3.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto3.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'; }
if ($ejercicio33!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio33.' <br>Tarea: '.$tarea33.' <br>Metodo: '.$metodo33.'  <br>Descripcion:'.$desc33.'</th>
<th colspan="9" height="95" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto33.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'
; }}
if ($psi!=0){
$htmlcontent .= '
<tr>
<th colspan="18" align="center">ACCION PSICOLOGICA</th>
</tr>
<tr>
<th colspan="9" align="center">DESCRIPCION</th>
<th colspan="7" align="center">REPRESENTACION</th>
<th colspan="2" align="right">'.$psi.' MIN</th>
</tr>
'; 
if ($ejercicio4!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio4.' <br>Tarea: '.$tarea4.' <br>Metodo: '.$metodo4.'  <br>Descripcion:'.$desc4.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto4.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'; }
if ($ejercicio44!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio44.' <br>Tarea: '.$tarea44.' <br>Metodo: '.$metodo44.'  <br>Descripcion:'.$desc44.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto44.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'
;} }
if($comp!=0){
$htmlcontent .= '
<tr>
<th colspan="18" align="center">COMPETENCIA</th>
</tr>
<tr>
<th colspan="9" align="center">DESCRIPCION</th>
<th colspan="7" align="center">REPRESENTACION</th>
<th colspan="2" align="right">'.$comp.' MIN</th>
</tr>
'; 
if ($ejercicio5!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio5.' <br>Tarea: '.$tarea5.' <br>Metodo: '.$metodo5.'  <br>Descripcion:'.$desc5.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto5.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'; }
if ($ejercicio55!=""){
$htmlcontent .= '
<tr>
<th colspan="9">Ejercicio: '.$ejercicio55.' <br>Tarea: '.$tarea55.' <br>Metodo: '.$metodo55.'  <br>Descripcion:'.$desc55.'</th>
<th colspan="9" height="100" align="center"><img src="../../../Galeria/acciones_abm_ejer/'.$foto55.'" alt="Mountain View" style="width:100px;height:100px;"></th>
</tr>
'
; }}
$htmlcontent .= '
<tr>
<th colspan="16" align="center">PARTE FINAL</th>
<th colspan="2" align="right">'.$final.' MIN</th>
</tr>
<tr>
<th height="30" colspan="18"></th>
</tr>
<tr>
<th height="80" colspan="18">OBSEVACIONES</th>
</tr>


</table>
'
; 
$w = 25;
$h = 17;
// Example of Image from data stream ('PHP rules')
$ser='images/lp.jpg';
$pdf->Image($ser, 20, 10, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, 0, false, false);
//$image_mask = $pdf->Image("images/image_alpha.png", 50, 50, 100, '', '', '', '', false, 300, '', true, false);
//$pdf->Image("images/image.png", 50, 50, 100, '', '', '', '', false, 300, '', false, $image_mask);

$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();


// -----------------------------------------------------------------------------
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+