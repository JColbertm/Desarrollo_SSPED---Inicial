<?php
    $opcion = filter_var($_POST['opc'],FILTER_SANITIZE_STRING);
    include("databaseA.php");
    switch ($opcion)
        {
            case "llenado": 

                $equipoid = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);
                $result = execSqlA("SELECT * from jugador WHERE idGrupCat = $equipoid && estado_ju = 1");    
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

            $idplansub=$_POST["plansub"];
            $meso=$_POST["meso-cre"];
            $etapa=$_POST["etapa"];
            $idplan=$_POST["plan"];

            $result=execSqlA("select idGrupo from categoria_grupo where idCategoria_grupo = \"".$idplansub."\"");

            while( $fila = $result->fetch_array() )
            {
                $resulta = execSqlA("select frecuencia from planificacion where idPlanificacion = \"".$idplan."\" and idGrupo = \"".$fila["idGrupo"]."\"");    
                while( $filas = $resulta->fetch_array() )
                {
                    $re=$filas["frecuencia"];        
                }

                $resultado= execSqlA('select ciclo from mesociclo where idMesociclo = \''.$meso.'\'');        

                while ($datos = mysqli_fetch_array($resultado)) {
                    $ciclo = $datos[0];
                    $res= execSqlA("select SUM(semanas) as total from mesociclo where idPlanificacion=\"".$idplan."\" and idPlanificacion_etapa =\"".$etapa."\" and ciclo = \"".$ciclo."\" ");
                    while ($data = mysqli_fetch_array($res)) {
                        $semana = $data[0];
                    }
                }    
            }   
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

            break;

            case "seguiasi":

            $idplansub=$_POST["plansub"];
            $meso=$_POST["meso-cre"];
            $etapa=$_POST["etapa"];
            $idplan=$_POST["plan"];

            $result=execSqlA("select idGrupo from categoria_grupo where idCategoria_grupo = \"".$idplansub."\"");

            while( $fila = $result->fetch_array() )
            {
                $resulta = execSqlA("select frecuencia from planificacion where idPlanificacion = \"".$idplan."\" and idGrupo = \"".$fila["idGrupo"]."\"");    
                while( $filas = $resulta->fetch_array() )
                {
                    $re=$filas["frecuencia"];        
                }

                $resultado= execSqlA('select ciclo from mesociclo where idMesociclo = \''.$meso.'\'');        

                while ($datos = mysqli_fetch_array($resultado)) {
                    $ciclo = $datos[0];
                    $res= execSqlA("select SUM(semanas) as total from mesociclo where idPlanificacion=\"".$idplan."\" and idPlanificacion_etapa =\"".$etapa."\" and ciclo = \"".$ciclo."\" ");
                    while ($data = mysqli_fetch_array($res)) {
                        $semana = $data[0];
                    }
                }    
            }   
            echo $re*$semana;

            break;


            case "llena_segui_asi": 

                $equipoid = filter_var($_POST['ide'],FILTER_SANITIZE_NUMBER_INT);
                $result = execSqlA("SELECT * from jugador WHERE idGrupCat = $equipoid && estado_ju = 1");    
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


        }
?>