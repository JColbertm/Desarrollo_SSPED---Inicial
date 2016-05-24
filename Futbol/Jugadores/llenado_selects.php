<?php
@session_start();
include("databaseA.php");
    //llena el combo box con las CATEGORIAS
    $result=execSqlA("select idCategoria_grupo, idGrupo, idCategoria from categoria_grupo");
    $equipo = '<option value="0"> </option>';//Elegir Categoria
    while( $fila = $result->fetch_array() )
    {
        $sql=execSqlA("select a.nombre_gru, b.categoria_sub from grupo a, categoria b, categoria_grupo c where a.idGrupo= \"".$fila["idGrupo"]."\" and b.idCategoria =\"".$fila["idCategoria"]."\" and a.idEntrenador = \"".$_SESSION['id_en']."\"  and c.idCategoria_grupo = \"".$fila['idCategoria_grupo']."\" ");

        while( $filas = $sql->fetch_array() )
        {
            $equipo.='<option value="'.$fila["idCategoria_grupo"].'">'.$filas["nombre_gru"].' '.$filas["categoria_sub"].'</option>';
        }   
    }
    ////////////////////////////////////
    
//llena el combo box con Etapas
    $result= execSqlA("select idEtapa, etapa from etapas");
    $etapas = '<option value="0"></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $etapas.='<option value="'.$fila["idEtapa"].'">'.$fila["etapa"].'</option>';
    }


    ////////////////////////////////////
    if(isset($_POST["equipo-cre"]))
    {
        $idplansub = $_POST["equipo-cre"];
        $result=execSqlA("select idGrupo from categoria_grupo where idCategoria_grupo = $idplansub");

        $plan = '<option value="0"> </option>';//Equipo
        while( $fila = $result->fetch_array() )
        {
            $resulta = execSqlA("select idPlanificacion, nombre from planificacion where idGrupo=".$fila["idGrupo"]);  
            while( $filas = $resulta->fetch_array() )
            {
                $plan.='<option value="'.$filas["idPlanificacion"].'">'.$filas["nombre"].'</option>';
            }              
        }
        
        echo $plan;
    }
    ////////////////////////////////////
    if(isset($_POST["idplan"]) && isset($_POST["equipo"]))
    {
        $plan=$_POST["idplan"];
        $equipo=$_POST["equipo"];
        $meso = '<option value="0"> </option>';//Elige un meso
        //SELECT  DATE_FORMAT(fecha_inicio_pre, '%d-%m-%Y') from planificacion where idTipo_plan=1 and idGrupo=6
        $result= execSqlA("SELECT fecha_inicio_pre from planificacion where idTipo_plan=\"".$plan."\" and idGrupo=\"".$equipo."\" ");        

        while( $fila = $result->fetch_array() )
        {
            $se=date("d-m-Y", strtotime($fila["fecha_inicio_pre"]));
            $meso.='<option value="'.$fila["fecha_inicio_pre"].'">'.$se.'</option>';
        }
        echo  $meso;
    }
    ////////////////////////////////////
    if(isset($_POST["etapas"]) && isset($_POST["plan"]))
    {
        $etapa=$_POST["etapas"];
        $plan=$_POST["plan"];
        $meso = '<option value="0"> </option>';//Elige un meso
        $result= execSqlA('select idMesociclo, ciclo from mesociclo where idPlanificacion = \''.$plan.'\' and idPlanificacion_etapa= \''.$etapa.'\'');        

        while( $fila = $result->fetch_array() )
        {
            $meso.='<option value="'.$fila["idMesociclo"].'">'.$fila["ciclo"].'</option>';
        }
    
        echo $meso;
    }
     ////////////////////////////////////
    if(isset($_POST["meso"]) && isset($_POST["plan"]))
    {
        $plan=$_POST["plan"];
        $meso=$_POST["meso"];
        $micro = '<option value="0"> </option>';//Elige un micro
        $result= execSqlA("select idDireccion, semana from direccion  where idMesociclo =\"".$meso."\" and idPlanificacion=\"".$plan."\" and estado = 0");    
        while( $fila = $result->fetch_array() )
        {
            $micro.='<option value="'.$fila["idDireccion"].'">'.$fila["semana"].'</option>';
        }

        echo $micro;
    }
    
    ////////////////////////////////////
     //////////////////////////////////// ver
    if(isset($_POST["microver"]))
    {
        $micro=$_POST["microver"];
        $dia = '<option value="0"> </option>';//Elige un dia
        $result= execSqlA("select a.idProgramacion, b.dia from programacion a, dia b  where a.idDireccion=\"".$micro."\" and a.idDia=b.idDia");    
        while( $fila = $result->fetch_array() )
        {
            $dia.='<option value="'.$fila["idProgramacion"].'">'.$fila["dia"].'</option>';
        }

        echo $dia;
    }
    
    ////////////////////////////////////
     ////////////////////////////////////
    if(isset($_POST["mesover"]) && isset($_POST["planver"]))
    {
        $plan=$_POST["planver"];
        $meso=$_POST["mesover"];
        $micro = '<option value="0"> </option>';//Elige un micro
        $result= execSqlA("select idDireccion, semana from direccion  where idMesociclo =\"".$meso."\" and idPlanificacion=\"".$plan."\" and estado = 1");    
        while( $fila = $result->fetch_array() )
        {
            $micro.='<option value="'.$fila["idDireccion"].'">'.$fila["semana"].'</option>';
        }

        echo $micro;
    }
    
    ////////////////////////////////////
    ////////////////////////////////////
    if(isset($_POST["idplan"]))
    {
        $plan=$_POST["idplan"];
        $result= execSqlA("select  frecuencia, tiempo_clase from planificacion where idPlanificacion = $plan");
        $fila = $result->fetch_array();
        $a=$fila["frecuencia"];
        $b=$fila["tiempo_clase"];
        $re=array($a,$b);
        echo json_encode($re);
            flush();
            
    }
    ////////////////////////////////////
    ////////////////////////////////////
    if(isset($_POST["idplane"]) and isset($_POST["idequipoe"]) and isset($_POST["fechae"]))
    {
        $plan=$_POST["idplane"];
        $equipo=$_POST["idequipoe"];
        $fecha=$_POST["fechae"];
        $result= execSqlA("select  tiempo_clase from planificacion where idTipo_plan = \"".$plan."\" and idGrupo = \"".$equipo."\" and fecha_inicio_pre=\"".$fecha."\"");
        $fila = $result->fetch_array();
        $re=$fila["tiempo_clase"];
        echo $re;
            
    }
?>
