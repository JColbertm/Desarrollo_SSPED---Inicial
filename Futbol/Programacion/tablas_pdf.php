<?php
 
require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED//tcpdf/config/lang/eng.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/tcpdf/tcpdf.php";

    
    
   // $objConsulta= new consulta();
    $perfil="";
    $custom_layout = array(600, 250);
$pdf = new TCPDF(LANDSCAPE, PDF_UNIT,   true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Desarrollo_SSPED');
$pdf->SetTitle('Reporte direccion');
$pdf->SetSubject('Reporte direccion');
$pdf->SetKeywords('Reporte, usuario, php, mysql');



$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
//$pdf->AddPage('L', 'A4');
//$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 10, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 
$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');



//*************
  ob_end_clean();//rompimiento de pagina
//************* 


include("databaseA.php");


$nombre = RecuperarIdItemA('planificacion', array('idPlanificacion'), array($_POST['planifi']));


$gru = RecuperarIdItemA('grupo', array('idGrupo'), array($nombre['idGrupo']));
if($nombre['idTipo_plan']==1){$tp='Anual';}
if($nombre['idTipo_plan']==2){$tp='Trimestral';}
if($nombre['idTipo_plan']==3){$tp='Semestral';}
if($nombre['idTipo_plan']==4){$tp='Competencia';}
//$categor = RecuperarIdItemA('categoria', array('idCategoria'), array($_POST['id_categ']));


$html ='<table width="100%"style="border-collapse: collapse;" >';

$html = $html.'<tr><td colspan="2" style="border: 1px solid black;text-align: center;"><b>Nombre planificacion:</b></td><td colspan="6" style="border: 1px solid black;text-align: center;"> '.$nombre['nombre'].'</td></tr>';
$html = $html.'<tr><td colspan="2" style="border: 1px solid black;text-align: center;"><b>Fecha de inicio:</b></td><td colspan="6" style="border: 1px solid black;text-align: center;"> '.$nombre['fecha_inicio_pre'].'</td></tr>';

$html = $html.'<tr><td colspan="2" style="border: 1px solid black;text-align: center;"><b>Tipo de plan:</b></td><td colspan="6" style="border: 1px solid black;text-align: center;"> '.$tp.'</td></tr>';

$html = $html.'<tr><td colspan="2" style="border: 1px solid black;text-align: center;"><b>Equipo:</b></td><td colspan="2" style="border: 1px solid black;text-align: center;"> '.$gru['nombre_gru'].'</td><td colspan="2" style="border: 1px solid black;text-align: center;"><b>Categoria:</b></td><td colspan="2" style="border: 1px solid black;text-align: center;"> '.$_POST['id_categ'].'</td></tr>';

$html = $html.'<tr>
<td style="border: 1px solid black;text-align: center;"><b>Total de semanas:</b> </td>
<td style="border: 1px solid black;text-align: center;">'.$nombre['cant_semanas'].' </td>
<td style="border: 1px solid black;text-align: center;"> <b>Cantidad de dias:</b> </td>
<td style="border: 1px solid black;text-align: center;">'.$nombre['cant_dias'].' </td>
<td style="border: 1px solid black;text-align: center;"><b>Frecuencia:</b> </td>
<td style="border: 1px solid black;text-align: center;">'.$nombre['frecuencia'].' </td>
<td style="border: 1px solid black;text-align: center;"> <b>Transito:</b></td>
<td style="border: 1px solid black;text-align: center;"> '.$nombre['transito'].'</td></tr>';
/*$html = $html.'<b>Equipo:</b> '.$gru['nombre_gru'];
$html = $html.'<b>Equipo:</b> '.$gru['nombre_gru'];*/

$html = $html.'</table>';


$mesos = execSqlA('SELECT idMesociclo from direccion where idPlanificacion = '.$_POST['planifi'].'');
$mes=array();
if (mysqli_num_rows($mesos)>0){
    while ($mm = mysqli_fetch_array($mesos))
    {
        array_push($mes,$mm[0]);

    }
}


$etapas = execSqlA('select sum(semanas) as total from mesociclo where idPlanificacion = '.$_POST['planifi'].' group by idPlanificacion_etapa');
$et=array();
if (mysqli_num_rows($etapas)>0){
    while ($nn = mysqli_fetch_array($etapas))
    {
        array_push($et,$nn[0]);

    }
}

$periodo1 = $et[0]+$et[1];
$periodo2 = $et[2]+$et[3];

$color_final_etapa=array();
$nombre_final_etapa=array();
for($l=0; $l<=3;$l++)
{
    for($j=0;$j<$et[$l]; $j++)
    {
        
        if($l==0){$color_etapa='#F5DEB3';$nombre='P-TE';}
        if($l==1){$color_etapa='#238E68';$nombre='P-ES';}
        if($l==2){$color_etapa='#6B4226';$nombre='P-CO';}
        if($l==3){$color_etapa='#DB9370';$nombre='COM';}
        array_push($color_final_etapa,$color_etapa);
        array_push($nombre_final_etapa,$nombre);
    }
}
$nombre_final_periodo=array();

$color_final_periodo=array();
for($l=0; $l<=1;$l++)
{
    if($l==0){$b=$periodo1;}
    if($l==1){$b=$periodo2;}
    for($j=0;$j<$b; $j++)
    {
        
        if($l==0){$color_periodo='#D8BFD8';$nombreP='PRE';}
        if($l==1){$color_periodo='#238E68';$nombreP='COM';}
        
        array_push($color_final_periodo,$color_periodo);
         array_push($nombre_final_periodo,$nombreP);
    }
}


$count=0;
$meso_final=array();
$color_final=array();
for($g=0; $g< count($mes); $g++){
   

        if($count==0){$mesoo='I';$color='#5C3317';}
        if($count==1){$mesoo='II';$color='#FFFF00';}
        if($count==2){$mesoo='III';$color='#A62A6A';}
        if($count==3){$mesoo='IV';$color='#D8BFD8';}
        if($count==4){$mesoo='V';$color='#0000FF';}
        if($count==5){$mesoo='VI';$color='#5F9F9F';}
        if($count==6){$mesoo='VII';$color='#4F2F4F';}
        if($count==7){$mesoo='VIII';$color='#DB9370';}
        if($count==8){$mesoo='IX';$color='#238E68';}
        if($count==9){$mesoo='X';$color='#99CC32';}
        if($count==10){$mesoo='XI';$color='#D98719';}
        if($count==11){$mesoo='XII';$color='#D8D8BF';}
        if($count==12){$mesoo='XIII';$color='#42426F';}
        if($count==13){$mesoo='XIV';$color='#3299CC';}
        if($count==14){$mesoo='XV';$color='#6B4226';}
        if($count==15){$mesoo='XVI';$color='#B5A642';}
        if($count==16){$mesoo='XVII';$color='#E0FFFF';}
        if($count==17){$mesoo='XVIII';$color='#F5F5DC';}
        if($count==18){$mesoo='XIX';$color='#00FA9A';}
        if($count==19){$mesoo='XX';$color='#F5DEB3';}

        array_push($meso_final,$mesoo);
        array_push($color_final,$color);

        if($g<count($mes)-1)
        {

        if($mes[$g]!=$mes[$g+1])
        {
            $count++;
        }
        
        }
        else{
            $count=$count;
        }
        }

$result = execSqlA('SELECT semana, sistema_juego, preparation_fisica, tecnico_tactico, competencia, accion_psi FROM direccion where idPlanificacion = '.$_POST['planifi'].'');
$i=0;$r=0;
if (mysqli_num_rows($result)>0){       
        $html = $html. '<div align="center">
            <h1>Macrociclo.</h1>
            <br /><br /> </div>           
            <table  width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr >
                    <td WIDTH="60"  >
                        <table  WIDTH="60" style="border-collapse: collapse;"> 
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">Periodos</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center;">Etapas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center; ">Mesociclo</td></tr>
                                <tr bgcolor="#DCDCDC"><td  style="border: 1px solid black; text-align: center;">Semanas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center;">tecnico</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">tec-fis</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">tec-tac</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">comp</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">acc-psi</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">total</td></tr>
                            </table>
                    </td>
                ';
           // $html=$html.'<tbody>';

        $columna = array();
        while ($data = mysqli_fetch_array($result))
        {
            $fila = array();
            array_push($fila,$data[0]);
            array_push($fila,$data[1]);
            array_push($fila,$data[2]);
            array_push($fila,$data[3]);
            array_push($fila,$data[5]);
            array_push($fila,$data[4]);

            array_push($columna,$fila);

        }


        $size_columna=count($columna);
        $a='';
        if($size_columna > 24)
        {
            $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
                            $pdf->AddPage();
            for ($m=0; $m<=23; $m++){    
           $html = $html.'
                       <td WIDTH="38" >
                            <table WIDTH="38" style="border-collapse: collapse;"  >  
                                <tr><td style=" border: 1px solid black;background-color:'.$color_final_periodo[$m].';text-align: center;"><b>'.$nombre_final_periodo[$m].'</b> </td></tr>
                                <tr><td style="  border: 1px solid black; background-color:'.$color_final_etapa[$m].';text-align: center;"><b>'.$nombre_final_etapa[$m].'</b></td></tr>
                                <tr><td style="background-color:'.$color_final[$m].';  border: 1px solid black;text-align: center;"><b>'.$meso_final[$m].'</b></td></tr>
                                <tr><td style="  border: 1px solid black; text-align: center;">'.$columna[$m][0].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$columna[$m][1].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$columna[$m][2].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$columna[$m][3].'</td></tr>
                                <tr><td style=" border: 1px solid black; text-align: center;">'.$columna[$m][5].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$columna[$m][4].'</td></tr>
                                ';
                                $r=$columna[$m][1]+$columna[$m][2]+$columna[$m][3]+$columna[$m][4]+$columna[$m][5];
                                $html = $html.' <tr><td style="  border: 1px solid black;text-align: center;">'.$r.'</td></tr>
                            </table>
                        </td>
                        ';
                        $r=0;
       // }
                       
        } 
                           // $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
        $html = $html.'</tr></table>';
        $a='mitad';

        }
        
        else{
            if($size_columna<=24)
                        {
                            $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
                            $pdf->AddPage();
                        }
            $a='';
        $cp=0;
        foreach ($columna as $c) {

           $html = $html.'
                       <td WIDTH="38">
                            <table WIDTH="38"  style="border-collapse: collapse;">  
                            <tr>';


                           $html = $html.' <td style=" border: 1px solid black;background-color:'.$color_final_periodo[$cp].';text-align: center;"><b>'.$nombre_final_periodo[$cp].'</b></td></tr>
                                <tr><td style=" border: 1px solid black;background-color:'.$color_final_etapa[$cp].';text-align: center;"><b> '.$nombre_final_etapa[$cp].'</b></td></tr>
                                <tr><td style="background-color:'.$color_final[$cp].';  border: 1px solid black;text-align: center;"><b>'.$meso_final[$cp].'</b></td></tr>
                                <tr><td style=" border: 1px solid black;text-align: center;">'.$c[0].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$c[1].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$c[2].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$c[3].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$c[5].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;">'.$c[4].'</td></tr>
                                ';
                                $r=$c[1]+$c[2]+$c[3]+$c[4]+$c[5];
                                $html = $html.' <tr><td style="  border: 1px solid black;text-align: center;">'.$r.'</td></tr>
                            </table>
                        </td>
                        ';$r=0;$cp++;
       // }
                        
        }       
       $html = $html.'</tr></table>';
    }
}




$pdf->writeHTML($html, true, false, true, false, '');//$pdf->writeHTML($html, true, false, true, false, '');

if($a=='mitad')
{
    $pdf->AddPage();
    $html = '<div align="center">
            <h1>Macrociclo.</h1>
            <br /><br /> </div>           
            <table  width="100%" cellspacing="0" cellpadding="0">
             <tr >
                    <td WIDTH="60"  >
                        <table  WIDTH="60" style="border-collapse: collapse;"> 
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">Periodos</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center;">Etapas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center;">Mesociclo</td></tr>
                                <tr bgcolor="#DCDCDC"><td  style="border: 1px solid black;text-align: center; ">Semanas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center; ">tecnico</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center;  ">tec-fis</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center;  ">tec-tac</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center;  ">comp</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;text-align: center;  ">acc-psi</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; text-align: center; ">total</td></tr>
                            </table>
                    </td>
                ';

$tamcol= $size_columna-25;
 for ($p=24; $p<$size_columna; $p++){
           $html = $html.'
                       <td WIDTH="38">
                            <table WIDTH="38" style="border-collapse: collapse;">  
                            
                                <tr><td style="  border: 1px solid black;background-color:'.$color_final_periodo[$p].'; text-align: center;"> <b>'.$nombre_final_periodo[$p].'</b></td></tr>
                                <tr><td style="  border: 1px solid black; background-color:'.$color_final_etapa[$p].';text-align: center;"><b> '.$nombre_final_etapa[$p].'</b></td></tr>
                                <tr><td style="background-color:'.$color_final[$p].'; border: 1px solid black;text-align: center;"><b>'.$meso_final[$p].'</b></td></tr>
                                <tr><td style="  border: 1px solid black; text-align: center;text-align: center;">'.$columna[$p][0].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;text-align: center; ">'.$columna[$p][1].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center;text-align: center; ">'.$columna[$p][2].'</td></tr>
                                <tr><td style="  border: 1px solid black; text-align: center;text-align: center;">'.$columna[$p][3].'</td></tr>
                                <tr><td style="  border: 1px solid black; text-align: center;text-align: center;">'.$columna[$p][5].'</td></tr>
                                <tr><td style="  border: 1px solid black;text-align: center; text-align: center;">'.$columna[$p][4].'</td></tr>
                                ';
                                $r=$columna[$p][1]+$columna[$p][2]+$columna[$p][3]+$columna[$p][4]+$columna[$p][5];
                                $html = $html.' <tr><td style="  border: 1px solid black; text-align: center;">'.$r.'</td></tr>
                            </table>
                        </td>
                        ';$r=0;
       // }
}
$html = $html.'</tr></table>';
$pdf->writeHTML($html, true, false, true, false, '');
                       
        } 
$pdf->lastPage();
$pdf->Output('Reporte direccion.pdf', 'I');
?>
