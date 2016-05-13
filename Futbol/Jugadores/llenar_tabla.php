<?php
    $opcion = filter_var($_POST['opc'],FILTER_SANITIZE_STRING);
    include("databaseA.php");
    switch ($opcion)
        {
            case "llenado": 

                $equipoid = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);
                $result = execSqlA("SELECT * from jugador WHERE idGrupo = $equipoid && estado_ju = 1");    
                $resultados=array();
                if (mysqli_num_rows($result)  > 0) 
                {
                    $c=0;
                    while($data = mysqli_fetch_array($result))
                    {
                    $multidimensional[$c] = array('idJugador' => $data[0] ,'nombre_ju' => $data[1], 'apellidop_ju' => $data[2], 'apellidom_ju' => $data[3],'res'=> 1);
                        $c++;
                    }    
                }
                else 
                {
                    $multidimensional=array('res'=> 0);
                }
                    echo json_encode($multidimensional);
                    flush();
            break;

            case "clases":

            $plan=$_POST["plan"];
            $equipo=$_POST["equipo"];
            $meso=$_POST["meso-cre"];
            $etapa=$_POST["etapa"];

            $result= execSqlA("select frecuencia from planificacion where idPlanificacion = \"".$plan."\" and idGrupo = \"".$equipo."\"");
            $fila = $result->fetch_array();
            $re=$fila["frecuencia"];


            $res= execSqlA("select SUM(semanas) as total from mesociclo where idPlanificacion=\"".$plan."\" and idPlanificacion_etapa =\"".$etapa."\"");

                /*select SUM(semanas) as total from mesociclo where idPlanificacion=11 and idPlanificacion_etapa =1*/

                while ($data = mysqli_fetch_array($res)) {
                    $semana = $data[0];
                }
                /*$resulta = $res->fetch_array(); 
                $semana=$res["total"];*/
     

            echo $re*$semana;

            break;

            case "generar":

            require_once("../dompdf/dompdf_config.inc.php");

            $plan=$_POST["datos"];
            $documento='ejemplo.pdf';
            //se crea una nueva instancia al DOMPDF
            $dompdf = new DOMPDF();
            //se carga el codigo html
            $dompdf->load_html($_POST['datos']);
            //aumentamos memoria del servidor si es necesario
            ini_set("memory_limit","128M"); 
            //lanzamos a render
            $dompdf->render();
            //guardamos a PDF
            $dompdf->stream($documento);
        }
?>