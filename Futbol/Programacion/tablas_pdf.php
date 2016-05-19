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

$pdf->SetFont('helvetica', '', 9, '', true);

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

//$categor = RecuperarIdItemA('categoria', array('idCategoria'), array($_POST['id_categ']));


$html = '<b>Nombre planificacion:</b> '.$nombre['nombre'].'<br>';
$html = $html.'<b>Grupo:</b> '.$gru['nombre_gru'];

$mesos = execSqlA('SELECT idMesociclo from direccion where idPlanificacion = '.$_POST['planifi'].'');
$mes=array();
if (mysqli_num_rows($mesos)>0){
    while ($mm = mysqli_fetch_array($mesos))
    {
        array_push($mes,$mm[0]);

    }
}

$count=1;
$meso_final=array();
$color_final=array();
for($g=0; $g< count($mes); $g++){
    if($g<count($mes)-1)
    {

    if($mes[$g]==$mes[$g+1])
    {
        $count=$count;
    }
    else{
        $count++;
    }
    }
    else{
        $count=$count;
    }
        if($count==1){$mesoo='I';$color='#FFE4E1';}
        if($count==2){$mesoo='II';$color='#778899';}
        if($count==3){$mesoo='III';$color='#87CEEB';}
        if($count==4){$mesoo='IV';$color='#ADD8E6';}
        if($count==5){$mesoo='V';$color='#E0FFFF';}
        if($count==6){$mesoo='VI';$color='#00FA9A';}
        if($count==7){$mesoo='VII';$color='#7FFFD4';}
        if($count==8){$mesoo='VIII';$color='#FF4500';}
        if($count==9){$mesoo='IX';$color='#E9967A';}
        if($count==10){$mesoo='X';$color='#CD853F';}
        if($count==11){$mesoo='XI';$color='#FF7F50';}
        if($count==12){$mesoo='XII';$color='#F5F5DC';}
        if($count==13){$mesoo='XIII';$color='#F5DEB3';}
        if($count==14){$mesoo='XIV';$color='#8FBC8F';}
        if($count==15){$mesoo='XV';$color='#FFE4E1';}
        if($count==16){$mesoo='XVI';$color='#778899';}
        if($count==17){$mesoo='XVII';$color='#E0FFFF';}
        if($count==18){$mesoo='XVIII';$color='#F5F5DC';}
        if($count==19){$mesoo='XIX';$color='#00FA9A';}
        if($count==20){$mesoo='XX';$color='#F5DEB3';}

        array_push($meso_final,$mesoo);
        array_push($color_final,$color);
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
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">Periodos</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; ">Etapas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;">Mesociclo</td></tr>
                                <tr bgcolor="#DCDCDC"><td  style="border: 1px solid black; ">Semanas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; ">tecnico</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">tec-fis</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">tec-tac</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">comp</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">acc-psi</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">total</td></tr>
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
                                <tr><td style=" border: 1px solid black;"> </td></tr>
                                <tr><td style="  border: 1px solid black;"> </td></tr>
                                <tr><td style="background-color:'.$color_final[$m].';  border: 1px solid black;">'.$meso_final[$m].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$columna[$m][0].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$columna[$m][1].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$columna[$m][2].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$columna[$m][3].'</td></tr>
                                <tr><td style=" border: 1px solid black; ">'.$columna[$m][5].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$columna[$m][4].'</td></tr>
                                ';
                                $r=$columna[$m][1]+$columna[$m][2]+$columna[$m][3]+$columna[$m][4]+$columna[$m][5];
                                $html = $html.' <tr><td style="  border: 1px solid black;">'.$r.'</td></tr>
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
                            <tr><td style=" border: 1px solid black;"> </td></tr>
                                <tr><td style=" border: 1px solid black;"> </td></tr>
                                <tr><td style="background-color:'.$color_final[$cp].';  border: 1px solid black;">'.$meso_final[$cp].'</td></tr>
                                <tr><td style=" border: 1px solid black;">'.$c[0].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$c[1].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$c[2].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$c[3].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$c[5].'</td></tr>
                                <tr><td style="  border: 1px solid black;">'.$c[4].'</td></tr>
                                ';
                                $r=$c[1]+$c[2]+$c[3]+$c[4]+$c[5];
                                $html = $html.' <tr><td style="  border: 1px solid black;">'.$r.'</td></tr>
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
            <table  width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr >
                    <td WIDTH="60"  >
                        <table  WIDTH="60" style="border-collapse: collapse;"> 
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">Periodos</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; ">Etapas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;">Mesociclos</td></tr>
                                <tr bgcolor="#DCDCDC"><td  style="border: 1px solid black; ">Semanas</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black; ">tecnico</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">tec-fis</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">tec-tac</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">comp</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">acc-psi</td></tr>
                                <tr bgcolor="#DCDCDC" ><td style="border: 1px solid black;  ">total</td></tr>
                            </table>
                    </td>
                ';

$tamcol= $size_columna-25;
 for ($p=24; $p<$size_columna; $p++){
           $html = $html.'
                       <td WIDTH="38">
                            <table WIDTH="38" style="border-collapse: collapse;">  
                            
                                <tr><td style="  border: 1px solid black; "> </td></tr>
                                <tr><td style="  border: 1px solid black; "> </td></tr>
                                <tr><td style="background-color:'.$color_final[$p].'; border: 1px solid black;">'.$meso_final[$p].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][0].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][1].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][2].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][3].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][5].'</td></tr>
                                <tr><td style="  border: 1px solid black; ">'.$columna[$p][4].'</td></tr>
                                ';
                                $r=$columna[$p][1]+$columna[$p][2]+$columna[$p][3]+$columna[$p][4]+$columna[$p][5];
                                $html = $html.' <tr><td style="  border: 1px solid black; ">'.$r.'</td></tr>
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
