<?php
@session_start();
include("databaseA.php");
    //llena el combo box con las CATEGORIAS
    $result= execSqlA("select DISTINCT a.idGrupo, b.nombre_gru,e.categoria_sub from planificacion a,categoria_grupo c, grupo b,categoria e  where b.estado_gru=1 and b.idEntrenador= \"".$_SESSION['id_en']."\"and a.idGrupo=b.idGrupo and a.estado=1 and b.idGrupo=c.idGrupo and c.idCategoria=e.idCategoria ");
    $equipo = '<option value="0"> </option>';//Elegir Categoria
    while( $fila = $result->fetch_array() )
    {
        $equipo.='<option value="'.$fila["idGrupo"].'">'.$fila["nombre_gru"].' '.$fila["categoria_sub"].'</option>';
    }
    ////////////////////////////////////
    //llena el combo box con modal EJER_TECNICO
    $subelemento= '<option></option>';//Elegir Categoria
    $result= execSqlA("select idSub_ejercicio, sub_ejercicio from sub_ejercicio where idSub_ejercicio=1 or idSub_ejercicio=2 or idSub_ejercicio=3");
    while( $fila = $result->fetch_array() )
    {
        $subelemento.='<option value="'.$fila["idSub_ejercicio"].'">'.$fila["sub_ejercicio"].'</option>';
    }

    //llena el combo box con modal EJER_TECNICO_FISICO

    $result= execSqlA("select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=2");
    $elemento_tecnico_fis = '<option></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $elemento_tecnico_fis.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
    }

    //llena el combo box con modal EJER_TECNICO_TACTICO

    $result= execSqlA("select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=3");
    $elemento_tecnico_tac = '<option></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $elemento_tecnico_tac.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
    }

//llena el combo box con modal EJER_ACCIONES_PSI

    $result= execSqlA("select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=4");
    $elemento_accpsi = '<option></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $elemento_accpsi.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
    }

//llena el combo box con modal EJER_COMP

    $result= execSqlA("select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idTipo_ejercicio=5");
    $elemento_comp = '<option></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $elemento_comp.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
    }
//llena el combo box con Etapas
    $result= execSqlA("select idEtapa, etapa from etapas");
    $etapas = '<option value="0"></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $etapas.='<option value="'.$fila["idEtapa"].'">'.$fila["etapa"].'</option>';
    }

if(isset($_POST["lu"])&&isset($_POST["ma"]) && isset($_POST["mi"]) && isset($_POST["ju"]) && isset($_POST["vi"]) && isset($_POST["sa"]) && isset($_POST["do"])){
    $a=$_POST["lu"];
    $b=$_POST["ma"];
    $c=$_POST["mi"];
    $d=$_POST["ju"];
    $e=$_POST["vi"];
    $f=$_POST["sa"];
    $g=$_POST["do"];
    $result= execSqlA("select idDia, dia from dia where idDia=\"".$a."\" or idDia=\"".$b."\" or idDia=\"".$c."\" or idDia=\"".$d."\" or idDia=\"".$e."\" or idDia=\"".$f."\" or idDia=\"".$g."\"" );
    $dia = '<option></option>';//Elegir preparacion
    while( $fila = $result->fetch_array() )
    {
        $dia.='<option value="'.$fila["idDia"].'">'.$fila["dia"].'</option>';
    }
    echo $dia;
}
    //////////////////////////////////// llena los ejericico de acuerdo a sub ejercicio
    if(isset($_POST["sub"])){
        $pre=$_POST["sub"];
        $elemento= '<option></option>';//Elegir Categoria
        $result = execSqlA("select idEjer_tecnico, elemento_tecnico from elemento_tecnico where idSub_ejercicio= '".$pre."'");
        while( $fila = $result->fetch_array() )
        {
            $elemento.='<option value="'.$fila["idEjer_tecnico"].'">'.$fila["elemento_tecnico"].'</option>';
        }

        echo $elemento;
        
    }
    ////////////////////////////////////
    if(isset($_POST["equipo-cre"]))
    {
        $plan = '<option value="0"> </option>';//Equipo

        $result= execSqlA("select idPlanificacion, nombre from planificacion where idGrupo=".$_POST["equipo-cre"]);        

        while( $fila = $result->fetch_array() )
        {
            $plan.='<option value="'.$fila["idPlanificacion"].'">'.$fila["nombre"].'</option>';
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
