        <?php
         $plan=$_GET['plan'];
        ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script src="/Desarrollo_SSPED/jsPDF-1.2.60/jspdf.js"></script>
    <link href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript">
      $(document).ready(function() {

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        });


        $('#btncalcular').on('click', calcular)

      //  $('#plansiguiente').on('click', llena_plan)
        $('#Guardar').on('click', llena_plan)
        $('#btnCotinnuar2').on('click', total)
        //cambiar pestana
        
        
         /*$('#btnCotinnuar2').click(function(){
          $('.nav-tabs > .active').next('li').find('a').trigger('click');

        });*/
        //cambiar radios
        $("#inline_content input[name='optradioS']").on('click',  cambiar_radioPre)
        $("#inline_content2 input[name='optradioSC']").on('click',  cambiar_radioCom)
        $("#pretemp1 input[name='optradioP']").on('click',  cambiar_radioPret)
        $("#preesp1 input[name='optradioE']").on('click',  cambiar_radioEs)
        $("#precomp1 input[name='optradioPC']").on('click',  cambiar_radioPc)
        $("#comp1 input[name='optradioCOM']").on('click',  cambiar_radioCOM)
        $('.mesoo').on('keyup', function(){s_meso($(this))})
        cambiar_radioPre();
        cambiar_radioPret();
        cambiar_radioPc();
        limpiar();  
        $('#to').on('click', imprimirpdf)
      })

      function imprimirpdf()
      {
        var doc = new jsPDF();

        // We'll make our own renderer to skip this editor
        var specialElementHandlers = {
          '#editor': function(element, renderer){
            return true;
          }
        };

        // All units are in the set measurement for the document
        // This can be changed to "pt" (points), "mm" (Default), "cm", "in"
        doc.fromHTML($('#render_me').get(0), 15, 15, {
          'width': 170, 
          'elementHandlers': specialElementHandlers
        });
      }
       function justNumbers(e)
    {
       var keynum = window.event ? window.event.keyCode : e.which;
       if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }

      function total(){
          var s = parseInt($("label[for='lbltotalPG']").text()) + parseInt($("label[for='lblTotalPE']").text())+parseInt($("label[for='lblTotalPC']").text())+parseInt($("label[for='lblTotalC']").text());
          if(s==$('#sema').val())
                {
                
                        $('#pes3').html('<a href="#direcciones" aria-controls="direcciones" role="tab" data-toggle="tab" >Direcciones</a>');  
                        $('.nav-tabs > .active').next('li').find('a').trigger('click');
           
                }
                else{
                   $('#pes3').html('<label style="color: #777; margin-left: 2px; margin-right: 2px; padding-top: 10px; padding-bottom: 10px; padding-right: 15px; padding-left: 15px;">Direcciones</label>');
                }
        }

      function limpiar(){
        $('#tiempo6').text('');
        $('#tiempo5').text('');
        $('#tiempo4').text('');
        $('#tiempo3').text('');
        $('#tiempo2').text('');
        $('#tiempo1').text('');
      }
      function s_meso(id){
        console.log($(id).prop('id'));
        var c=0;
        if($(id).prop('id')=='meso1'){if($('#tiempo3').text()<=3 || $(id).val()> ($('#tiempo3').text()/2)){c=1;}}
        if($(id).prop('id')=='meso2'){if($('#tiempo4').text()<=3 || $(id).val()> ($('#tiempo4').text()/2)){c=1;}}
        if($(id).prop('id')=='meso3'){if($('#tiempo5').text()<=3 || $(id).val()> ($('#tiempo5').text()/2)){c=1;}}
        if($(id).prop('id')=='meso4'){if($('#tiempo6').text()<=3 || $(id).val()> ($('#tiempo6').text()/2)){c=1;}}
        if(c==1)
        {
          if($(id).val()>1)
            {alert('el mesociclo  no se encuentra dentro del rango');}
        }
             if($('#meso1').val()>0 && $('#meso2').val()>0 && $('#meso3').val()>0 && $('#meso4').val()>0){
              $('#btnCotinnuar').click(function(){
              $('#pes2').html('<a href="#mesociclos" aria-controls="mesociclos" role="tab" data-toggle="tab">Mesociclos</a>');
                $('.nav-tabs > .active').next('li').find('a').trigger('click');
              });
             }
      }
      //funcion para calcular la cantidad de semanas de acuerdo al porcentaje
      function newDias(r,p2,p1) {

             var resul = p1*$('#'+r+'').val()/100;
             var resul2 = p2*$('#'+r+'').val()/100;
             //determinamos cual es el que tiene mas decimales
             var d1= resul-Math.floor(resul);
             var d2= resul2-Math.floor(resul2);
             if(d1>d2)
             {
              resul = Math.round(resul);
              resul2 = Math.floor(resul2);
             } else{
              resul = Math.floor(resul);
              resul2 = Math.round(resul2);
             }
             return {r1: resul, r2: resul2};
      }
      function cambiar_radioPre(){
           if($('input:radio[name=optradioS]:checked').val() == 60){
              $("input[name='optradioSC'][value='40']").prop('checked', true);
            }
            if($('input:radio[name=optradioS]:checked').val() == 40){
              $("input[name='optradioSC'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioS]:checked').val() == 50){
             $("input[name='optradioSC'][value='50']").prop('checked', true);}
            var p1= $('input:radio[name=optradioS]:checked').val();
            var p2=100-p1;
            var dias = newDias('sema',p2,p1);

             $('#tiempo1').text(dias.r1);
             $('#tiempo2').text(dias.r2);
             $('#sema1').val(dias.r1);
             $('#sema2').val(dias.r2);      
        }
        function cambiar_radioCom(){
           if($('input:radio[name=optradioSC]:checked').val() == 60){
              $("input[name='optradioS'][value='40']").prop('checked', true);}
            if($('input:radio[name=optradioSC]:checked').val() == 40){
              $("input[name='optradioS'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioSC]:checked').val() == 50){
             $("input[name='optradioS'][value='50']").prop('checked', true);}
              
              var p1= $('input:radio[name=optradioSC]:checked').val();
              var p2=100-p1;
              var dias = newDias('sema',p2,p1);

             $('#tiempo2').text(dias.r1);
             $('#tiempo1').text(dias.r2);
             $('#sema1').val(dias.r2);
             $('#sema2').val(dias.r1); 
              
        }
        function cambiar_radioPret(){

            
           if($('input:radio[name=optradioP]:checked').val() == 60){
              $("input[name='optradioE'][value='40']").prop('checked', true);}
            if($('input:radio[name=optradioP]:checked').val() == 40){
              $("input[name='optradioE'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioP]:checked').val() == 50){
              $("input[name='optradioE'][value='50']").prop('checked', true);}
            if( $('#tiempo1').text()=='')
            {
               $('#tiempo3').text('');
               $('#tiempo4').text('');
              alert('Elija un porcentaje en preparotorio y competitivo para calcular los tiempos.');
            }
            else{
              var p1= $('input:radio[name=optradioP]:checked').val();
              var p2=100-p1;
              var dias = newDias('sema1',p2,p1);

              $('#tiempo3').text(dias.r1);
              $('#tiempo4').text(dias.r2);

            }
         
        }
         function cambiar_radioEs(){
           if($('input:radio[name=optradioE]:checked').val() == 60){
              $("input[name='optradioP'][value='40']").prop('checked', true);}
            if($('input:radio[name=optradioE]:checked').val() == 40){
              $("input[name='optradioP'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioE]:checked').val() == 50){
              $("input[name='optradioP'][value='50']").prop('checked', true);}
              if( $('#tiempo1').text()=='')
              {
                 $('#tiempo3').text('');
                 $('#tiempo4').text('');
                alert('Elija un porcentaje en preparotorio y competitivo para calcular los tiempos.');
              }
              else{
              var p1= $('input:radio[name=optradioE]:checked').val();
              var p2=100-p1;
              var dias = newDias('sema1',p2,p1);
              $('#tiempo4').text(dias.r1);
              $('#tiempo3').text(dias.r2);
            }
          
        }
         function cambiar_radioPc(){
           if($('input:radio[name=optradioPC]:checked').val() == 60){
              $("input[name='optradioCOM'][value='40']").prop('checked', true);}
            if($('input:radio[name=optradioPC]:checked').val() == 40){
              $("input[name='optradioCOM'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioPC]:checked').val() == 50){
              $("input[name='optradioCOM'][value='50']").prop('checked', true);}
              if( $('#tiempo2').text()=='')
              {
                 $('#tiempo5').text('');
                 $('#tiempo6').text('');
                alert('Elija un porcentaje en preparotorio y competitivo para calcular los tiempos.');
              }
              else{
                var p1= $('input:radio[name=optradioPC]:checked').val();
                var p2=100-p1;
                var dias = newDias('sema2',p2,p1);

               $('#tiempo5').text(dias.r1);
               $('#tiempo6').text(dias.r2);
           }
    
        }
        function cambiar_radioCOM(){
           if($('input:radio[name=optradioCOM]:checked').val() == 60){
              $("input[name='optradioPC'][value='40']").prop('checked', true);}
            if($('input:radio[name=optradioCOM]:checked').val() == 40){
              $("input[name='optradioPC'][value='60']").prop('checked', true);}
            if($('input:radio[name=optradioCOM]:checked').val() == 50){
              $("input[name='optradioPC'][value='50']").prop('checked', true);}
              if( $('#tiempo2').text()=='')
              {
                 $('#tiempo5').text('');
                 $('#tiempo6').text('');
                alert('Elija un porcentaje en preparotorio y competitivo para calcular los tiempos.');
              }
              else{
              var p1= $('input:radio[name=optradioCOM]:checked').val();
              var p2=100-p1;
              var dias = newDias('sema2',p2,p1);

             $('#tiempo6').text(dias.r1);
             $('#tiempo5').text(dias.r2);
            }
            
        }

       function calcular(){
        if($('#nombrePlanificacion').val()!=''){
          setTimeout("$('.ocultar').hide();", 5000);
          var datos= $('#calculoplan').serialize();
          if($('#es_comp').val()==1)
          {
            datos += "&opcion=" + encodeURIComponent('calcular_xcompetencia');
          }
          else{
            datos += "&opcion=" + encodeURIComponent('gral');
            datos += "&semanas=" + encodeURIComponent($('#sem').val())+"&meses=" + encodeURIComponent($('#mes').val());
          }
          console.log(datos);
          $.ajax({
            url: 'planificacion.php',
            type: $('#calculoplan').attr('method'),
            data: datos
          })
          .done(function(data) {
              var retorno = $.parseJSON(data);
              console.log(data);
              var sem = retorno.semanas;
              $('#sema').val(retorno.semanas);
              var dia = retorno.dias;
              var tiempo = retorno.tiempo;
              var fech = retorno.fecha;
              var html='<br><div  class="alert alert-info ocultar" role="alert">Planificado!</div>';
              $('#informacion').html(html);

              var cal=$("input[name='t_calentamiento']:checked").val();
              var semf;
             
              var tcal;
              if($('#tiempoclase').val()==60){tcal=15;}
              if($('#tiempoclase').val()==90){tcal=20;}
              if($('#tiempoclase').val()==120){tcal=20;}
              $('#cantisemanas').val(sem+' semanas');
              $('#cantidias').val(dia+' dias');
              $('#calentamiento').val(tcal+' minutos por clase');
              var tf;
              tf = Math.round(tiempo)-tiempo;
              
              if(tf==0.5)
              {
                $('#tiempototal').val(Math.round(tiempo)+' horas y media');
              }
              else{
              $('#tiempototal').val(tiempo+' horas');}
              $('#fechafincomp').val(fech);
              $('#plansiguiente').click(function(){ 
                $('#pes1').html('<a href="#periodos" aria-controls="periodos" role="tab" data-toggle="tab" >Periodos y Etapas</a>');  
                $('.nav-tabs > .active').next('li').find('a').trigger('click');              });
              limpiar();
         })

          }
          else{
            var html='<br><div  class="alert alert-danger ocultar" role="alert">Ingrese nombre de la planificacion!</div>';
              $('#informacion').html(html);
          }
        }

        function sumar_col1(c)
    {
      var subtotal = 0;
      campo = c.form;
        if(!/^\d*$/.test(c.value)) return;
            for (var i = 0; i < campo.length-1; i++) 
            {
                if (!/^\d+$/.test(campo[i].value)) continue;
                subtotal += parseInt(campo[i].value);
            }
           
            if(subtotal==100){
            document.getElementById('res_col1').value = 100;
            document.getElementById('res_col1').style.backgroundColor="#66ff33";
            }
          else{
               if(subtotal<100)
                  {
                    if(subtotal==0)
                    {
                      document.getElementById('res_col1').value = 0;
                    }
                    else{
                      document.getElementById('res_col1').style.backgroundColor="";
                      document.getElementById('res_col1').value = 100-subtotal;
                      }
                  }
                  else{
                    document.getElementById('res_col1').value = subtotal-100;
                    document.getElementById('res_col1').style.backgroundColor="#ff4d4d";
                    }
              }
              habilita_guardar();
    }
  //suma columna 2
    function sumar_col2(c){
    var subtotal = 0;
    campo = c.form;
      if(!/^\d*$/.test(c.value)) return;
          for (var i = 0; i < campo.length-1; i++) {
              if (!/^\d+$/.test(campo[i].value)) continue;
                  subtotal += parseInt(campo[i].value);
          }
          if(subtotal==100)
            {
          document.getElementById('res_col2').value = 100;
          document.getElementById('res_col2').style.backgroundColor="#66ff33";
        }
          else{
                if(subtotal<100)
                  {
                    if(subtotal==0)
                    {
                      document.getElementById('res_col2').value = 0;
                    }
                    else{
                      document.getElementById('res_col2').style.backgroundColor="";
                      document.getElementById('res_col2').value = 100-subtotal;
                      }
                  }
                  else{
                    document.getElementById('res_col2').value = subtotal-100;
                    document.getElementById('res_col2').style.backgroundColor="#ff4d4d";
                    }
            }
            habilita_guardar();
    }
  //suma columna 3
    function sumar_col3(c){
    var subtotal = 0;
    campo = c.form;
      if(!/^\d*$/.test(c.value)) return;
          for (var i = 0; i < campo.length-1; i++) {
              if (!/^\d+$/.test(campo[i].value)) continue;
                  subtotal += parseInt(campo[i].value);
          }
         if(subtotal==100)
            {
            document.getElementById('res_col3').value = 100;
            document.getElementById('res_col3').style.backgroundColor="#66ff33";
           }
           else{
               if(subtotal<100)
                  {
                    if(subtotal==0)
                    {
                      document.getElementById('res_col3').value = 0;
                    }
                    else{
                      document.getElementById('res_col3').style.backgroundColor="";
                      document.getElementById('res_col3').value = 100-subtotal;
                      }
                  }
                  else{
                    document.getElementById('res_col3').value = subtotal-100;
                    document.getElementById('res_col3').style.backgroundColor="#ff4d4d";
                    }
              }
              habilita_guardar();
    }
  //suma columna 4
    function sumar_col4(c){
    var subtotal = 0;
    campo = c.form;
      if(!/^\d*$/.test(c.value)) return;
          for (var i = 0; i < campo.length-1; i++) {
              if (!/^\d+$/.test(campo[i].value)) continue;
                  subtotal += parseInt(campo[i].value);
          }
        if(subtotal==100)
          {
          document.getElementById('res_col4').value = 100;
          document.getElementById('res_col4').style.backgroundColor="#66ff33";
          }
        else{
               if(subtotal<100)
                  {
                    if(subtotal==0)
                    {
                      document.getElementById('res_col4').value = 0;
                    }
                    else{
                      document.getElementById('res_col4').style.backgroundColor="";
                      document.getElementById('res_col4').value = 100-subtotal;
                      }
                  }
                  else{
                    document.getElementById('res_col4').value = subtotal-100;
                    document.getElementById('res_col4').style.backgroundColor="#ff4d4d";
                    }
          }
          habilita_guardar();
    }
    function habilitar()
      {
        if(document.colum1.colum1.value == 100 && document.colum2.colum2.value == 100 && document.colum3.colum3.value == 100 && document.colum4.colum4.value == 100){
              document.gua.to.disabled=false;
          }
          else{
              document.gua.to.disabled=true;
          }
      }
      function habilita_guardar(){
        var total = parseInt($('#res_col1').val())+parseInt($('#res_col2').val())+parseInt($('#res_col3').val())+parseInt($('#res_col4').val());
        if(total==400)
        {
            $('#Guardar').removeAttr('disabled');
        }
        
      }



    function llena_plan()
    {
      var plan;
      if($('#tipo_plan').val()=='Anual'){plan=1;}
      if($('#tipo_plan').val()=='Trimestral'){plan=2;}
      if($('#tipo_plan').val()=='Semestral'){plan=3;}
      if($('#tipo_plan').val()=='Competencia'){plan=4;}
      //habilitar();
      //setTimeout("$('.ocultar').hide();", 5000);
      var datos= $('#calculoplan').serialize();
      datos += "&id_p=" + encodeURIComponent(plan);
       datos += "&tiempo3="+ encodeURIComponent($('#tiempo3').text());
       datos += "&tiempo4="+ encodeURIComponent($('#tiempo4').text());
       datos += "&tiempo5="+ encodeURIComponent($('#tiempo5').text());
       datos += "&tiempo6="+ encodeURIComponent($('#tiempo6').text());
       //guardamos las semanas por mesociclo en un array
       
       var i =1;
       var arr1 = [];
       while(i<=$('#meso1').val())
       {
        arr1.push(''+$('#semanaGen_'+i+'').val()+'');
        i++;
       }

       var j =1;
       var arr2 = [];
       while(j<=$('#meso2').val())
       {
        arr2.push(''+$('#semanaEsp_'+j+'').val()+'');
        j++;
       }
       //console.log(arr1);

       var h =1;
       var arr3 = [];
       while(h<=$('#meso3').val())
       {
        arr3.push(''+$('#semanaPComp_'+h+'').val()+'');
        h++;
       }

       var k =1;
       var arr4 = [];
       while(k<=$('#meso4').val())
       {
        arr4.push(''+$('#semanaComp_'+k+'').val()+'');
        k++;
       }


      datos += "&semanas_1="+arr1;
      datos += "&semanas_2="+arr2;
      datos += "&semanas_3="+arr3;
      datos += "&semanas_4="+arr4;
      var datos2=$('#calculoentre').serialize();
      datos += '&'+datos2;
      datos += '&'+$('#formSemMeso').serialize();
      datos += '&'+$('#colum1').serialize();
      datos += '&'+$('#colum2').serialize();
      datos += '&'+$('#colum3').serialize();
      datos += '&'+$('#colum4').serialize();

      
      console.log(datos);
      datos += "&opcion=" + encodeURIComponent('agregar_plan');
     /* datos += "&plan=" + encodeURIComponent('anual');
      console.log(datos);
     */ 
     $.ajax({
        url: 'planificacion.php',
        type: 'POST',
        data: datos
      })
      .done(function(data) {
        var resp = $.parseJSON(data);
        console.log(resp.resp);
        if(resp.idplani>0){
          $('#planifi').val(resp.idplani);
          $('#boton_proyecto').html('<button type="submit" class="col-xs-6 btn btn-primary"  value="Proyecto" id="Proyecto">Proyecto</button>');
          $('#boton_guardar').html('<button type="button" class="col-xs-6 btn btn-success"   id="Proyecto" disabled>Guardar</button>');
        }
        console.log(resp.resp);
     })
        
      .fail(function() {
        console.log("error");
      })
        
       event.preventDefault();         
    }

    </script>
    
</head>
<body>
<!--  llamada a la cabecera -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/cabecera1.php";
 	?>
  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenureg.php";
  ?>

<!--  llamada a menu de opciones futbol vertical -->
      <?php 
      require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listabotones1.php";
    ?>
 
  <!--  llamada a menu de opciones futbol horizontal -->
    <?php
      require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listahorizontal.php";
    ?>

<!--  Contenedor de planificacion -->
	<div class="col-xs-12 col-sm-8 ">
		<div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-calendar" aria-hidden="true"></i>  Planificacion
      </div>
      <div class="panel-body">  
        <div class="">
        <br><br>
        <!-- Nav tabs --> 
   
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#planificacion" aria-controls="planificacion" role="tab" data-toggle="tab">Planficacion</a></li>
            <li role="presentation" id="pes1"><label style="color: #777; margin-left: 2px; margin-right: 2px; padding-top: 10px; padding-bottom: 10px; padding-right: 15px; padding-left: 15px;">Periodos y etapas</label></li>
            <li role="presentation" id="pes2"><label style="color: #777; margin-left: 2px; margin-right: 2px; padding-top: 10px; padding-bottom: 10px; padding-right: 15px; padding-left: 15px;">Mesociclos</label></li>
            <li role="presentation" id="pes3"><label style="color: #777; margin-left: 2px; margin-right: 2px; padding-top: 10px; padding-bottom: 10px; padding-right: 15px; padding-left: 15px;">Direcciones</label><!--<a href="#direcciones" aria-controls="direcciones" role="tab" data-toggle="tab">Direcciones</a>--></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
              <!-- Primer Panel -->
              <div role="tabpanel" class="tab-pane active" id="planificacion">
              <br>
                <div class="col-sm-2 col-xs-12">
                  <label><strong>Planificacion:</strong></label>
                </div>  
                <div class="col-sm-3 col-xs-12">
                  <label><?php echo $plan?> </label>
                </div>
                <div class="col-sm-12 col-xs-12">
                <br>
                <form class="form-inline" name="calculoplan" id="calculoplan" method="POST">
                  <?php $s=0; $m=0;
                  if($_GET['plan']=='Anual'){$s=48; $m=12;}
                  if($_GET['plan']=='Semestral'){$s=24; $m=6;}
                  if($_GET['plan']=='Trimestral'){$s=12; $m=3;}
                 echo "<input type='hidden' id='sem' value='".$s."'>
                  <input type='hidden' id='mes' value='".$m."'>
                  <input type='hidden' id='tipo_plan' name='tipo_plan' value='".$_GET['plan']."'>
                  <input type='hidden' id='id_grupo' name='id_grupo' value='".$_GET['id']."'>

                  ";
                  ?>
                  <div class="">
                    <div class="col-sm-2 col-xs-12">
                      <label><strong>Nombre:</strong></label>
                    </div>  
                    <div class="col-sm-10 col-xs-12">
                      <input type="text" value="" placeholder="Planificacion" class="form-control" name="nombrePlanificacion" id="nombrePlanificacion" style="" required="" ><br>
                    </div>
                  </div>
                  <br><br><br>
                  <div class="form-group col-xs-12 col-sm-offset-2 col-sm-9">
                    <div class="col-sm-4 col-xs-12">
                      <label>Fecha de inicio de preparacion:</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="date" id="fechainiprepa" name="fechainiprepa" step="1" min="2015-01-01" max="2020-12-31" value="<?php echo date("Y-m-d");?>">
                    </div>              
                  </div>   
                  <?php if($_GET['plan']=='Competencia'){
                    echo "<input type='hidden' id='es_comp' value='1'></input>";
                  ?>
                  <div class="form-group col-xs-12 col-sm-offset-2 col-sm-9">
                    <div class="col-xs-4">
                      <label>Fecha de inicio de competencia:</label>
                    </div>
                    <div class="col-sm-5 col-xs-12">
                      <input type="date" id="fechainicomp" name="fechainicomp" step="1" min="2015-01-01" max="2020-12-31" value="<?php echo date("Y-m-d");?>">
                    </div>              
                  </div>
                  <br><br>
                  <div class="form-group col-xs-12 col-sm-offset-2 col-sm-9">
                    <div class="col-xs-4">
                      <label>Fecha fin de competencia:</label>
                    </div>
                    <div class="col-xs-5">
                      <input type="date" id="fechafincomp2" name="fechafincomp" step="1" min="2015-01-01" max="2020-12-31" value="<?php echo date("Y-m-d");?>">
                    </div>              
                  </div>         
                  <?php }  else{ ?>
                  <input type="hidden" id="fechainicomp" name="fechainicomp" value"">
                  <?php }   ?>
                  <div class="col-xs-12">
                  <br><br>
                    <div class="form-group col-sm-6 col-xs-12">
                      <div class="col-sm-4 col-xs-12">
                        <label>Frecuencia Semanal:</label>
                      </div>
                      <div class="col-sm-2 col-xs-12">
                        <select class="form-control" id="diassemana" name="diassemana">
                          <option value="2">2 Dias</option>
                          <option value="3">3 Dias</option>
                          <option value="4">4 Dias</option>
                          <option value="5">5 Dias</option>
                          <option value="6">6 Dias</option>
                          <option value="7">7 Dias</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12">
                      <div class="col-sm-4 col-xs-12">
                        <label>Tiempo de Clase:</label>
                      </div>
                      <div class="col-sm-2 col-xs-12">
                        <select class="form-control" id="tiempoclase" name="tiempoclase">
                          <option value="60">60 Minutos</option>
                          <option value="90">90 Minutos</option>
                          <option value="120">120 Minutos</option>
                        </select>
                      </div>
                    </div>  
                  </div>
                  <div class="col-xs-12">
                  <br><br>                   
                    <label class="col-sm-offset-2 col-sm-2 col-xs-12">Transito:</label> 
                    <div class="form-group" id="radioption" name="radioption">
                      <label class="radio-inline">
                        <input type="radio" name="t_calentamiento" id="inlineRadio1" value="0" checked>0 Semanas
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="t_calentamiento" id="inlineRadio2" value="1">1 Semana
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="t_calentamiento" id="inlineRadio3" value="2">2 Semanas
                      </label>
                    </div>       
                  </div>          
                  <div class="col-sm-offset-1 col-sm-2 col-xs-12">
                  <br>
                    <button type="button" class="form-control btn btn-primary" id="btncalcular" name="btncalcular">
                      <span><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                      <span class="hidden-xs">
                        Calcular
                      </span>
                    </button>
                  </div>              
                  <br>
                  <div class="form-group row col-xs-12" id="informacion">        
                  
                  </div>
                  <div class="form-group col-sm-7 col-sm-offset-5 col-xs-12">
                  <br>
                    <div class="col-sm-4 col-xs-12">
                      <label>Cantidad de Semanas:</label>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                      <input type="text" class="form-control" id="cantisemanas" name="cantisemanas" placeholder="Cantidad de Semanas" readonly="">
                    </div>
                  </div>
                  <div class="form-group col-sm-7 col-sm-offset-5 col-xs-12">
                  <br>
                    <div class="col-sm-4 col-xs-12">
                      <label>Calentamiento:</label>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                      <input type="text" class="form-control" id="calentamiento" name="calentamiento" placeholder="Tiempo de calentamiento" readonly="">
                    </div>
                  </div>
                  <div class="form-group col-sm-7 col-sm-offset-5 col-xs-12">  
                  <br>
                    <div class="col-sm-4 col-xs-12">
                      <label>Cantidad de Dias:</label>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                      <input type="text" class="form-control" id="cantidias" name="cantidias" placeholder="Cantidad de Dias" readonly="">
                    </div>
                  </div>
                  <div class="form-group col-sm-7 col-sm-offset-5 col-xs-12">  
                  <br>
                  <div class="col-sm-4 col-xs-12">
                      <label>Tiempo Total:</label>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                      <input type="text" class="form-control" id="tiempototal" name="tiempototal" placeholder="Tiempo Total" readonly="">
                    </div>
                  </div>
                  <?php if($_GET['plan']!='Competencia'){ ?>
                  <div class="form-group col-sm-7 col-sm-offset-5 col-xs-12">   <br>         
                    <div class="col-sm-4 col-xs-12">
                      <label>Fecha Final:</label>
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="fechafincomp" name="fechafincomp" placeholder="Fecha Final" readonly>
                    </div>
                  </div>
                  <?php }?>
                  <div class="col-sm-offset-9 col-sm-3 col-xs-12">
                  <br>
                    <button type="button" class="form-control btn btn-success" id="plansiguiente">
                      <span><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                      <span class="hidden-xs">
                        Siguiente
                      </span>
                    </button>
                  </div>                
                </form>
              </div>
            </div>
            <!-- SEGUNDO PANEL -->
            <div role="tabpanel" class="tab-pane" id="periodos">  
              <!-- CONTENEDOR DEL ENTRENAMIENTO PREPARATORIO -->
              <div class="row">
                <form class="form-inline" name="calculoentre" id="calculoentre" method="POST">
                  <div class="col-xs-12 col-sm-6">
                  <br>
                    <input type="hidden" id="sema" value="">
                    <input type="hidden" id="sema1" name="sema1" value="">
                    <input type="hidden" id="sema2" name="sema2" value="">
                    <div class="col-xs-12" id="inline_content">
                    <center>
                      <h4><u>Preparatorio</u></h4>
                      <br>
                      <label class="radio-inline "><input type="radio" name="optradioS" value=60 id="p1">60 %</label>
                      <label class="radio-inline"><input type="radio" name="optradioS" value=50 id="p2">50 %</label>
                      <label class="radio-inline"><input type="radio" name="optradioS" value=40 id="p3">40 %</label>
                      <br><br>
                      <label >Tiempo en semanas: </label>
                      <label id="tiempo1" > 30 </label> Semanas.
                    </center>
                    </div>
                    <div class="col-xs-6" id="pretemp1">
                    <center>
                      <u>Pre-Temporada</u>
                      <br><br>
                      <label class="radio-inline"><input type="radio" name="optradioP" value=60>60 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioP" value=50>50 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioP" value=40>40 %</label><br>
                      <br><br>
                      <label >Tiempo en semanas: </label>
                      <label id="tiempo3"> 30 </label> Semanas.
                    </center>
                    </div>
                    <div class="col-xs-6" id="preesp1">
                    <center>
                      <u>Preparacion Especial</u>
                      <br><br>
                      <label class="radio-inline"><input type="radio" name="optradioE" value=60>60 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioE" value=50>50 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioE" value=40>40 %</label><br>
                      <br><br>
                      <label>Tiempo en semanas: </label>
                      <label id="tiempo4"> 30 </label> Semanas.
                    </center>
                    </div>                       
                    <div class="col-xs-6">
                      <label>Mesociclos:</label>
                      <input type="text" class="col-xs-10 mesoo" id="meso1" name="meso1" onkeypress="return justNumbers(event);">
                    </div>
                    <div class="col-xs-6">
                      <label>Mesociclos:</label>
                      <input type="text" class="col-xs-10 mesoo" id="meso2" name="meso2" onkeypress="return justNumbers(event);">
                    </div>
                  </div>      
                  <div class="col-xs-12 col-sm-6 col-xs-12" >
                  <br>
                    <div class="col-xs-12" id="inline_content2">
                    <center>
                      <h4><u>Competitivo</u></h4>
                      <br>
                      <label class="radio-inline"><input type="radio" name="optradioSC" value=60 id="c1">60 %</label>
                      <label class="radio-inline"><input type="radio" name="optradioSC" value=50  id="c2">50 %</label>
                      <label class="radio-inline"><input type="radio" name="optradioSC" value=40  id="c3">40 %</label>
                      <br><br>
                      <label>Tiempo en semanas: </label>
                      <label id="tiempo2"> 30 </label> Semanas.
                    </center>
                    </div>         
                    <div class="col-xs-6 col-sm-6 " id="precomp1">
                    <center>
                      <u>Pre Competitivo</u>
                      <br><br>
                      <label class="radio-inline"><input type="radio" name="optradioPC" value=60>60 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioPC" value=50>50 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioPC" value=40>40 %</label><br>
                      <br><br>
                      <label>Tiempo en semanas: </label>
                      <label id="tiempo5"> 30 </label> Semanas.
                    </center>
                    </div>
                    <div class="col-xs-6 col-sm-6 " id="comp1">
                    <center>
                      <u>Competitivo</u>
                      <br><br>
                      <label class="radio-inline"><input type="radio" name="optradioCOM" value=60>60 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioCOM" value=50>50 %</label><br>
                      <label class="radio-inline"><input type="radio" name="optradioCOM" value=40>40 %</label><br>
                      <br><br> 
                      <label>Tiempo en semanas: </label>
                      <label id="tiempo6"> 30 </label> Semanas.
                    </center>
                  </div>                    
                  <div class="col-xs-6">
                    <label>Mesociclos:</label>
                    <input type="text" class="col-xs-10 mesoo" id="meso3" name="meso3" onkeypress="return justNumbers(event);">
                  </div>          
                  <div class="col-xs-6">
                    <label>Mesociclos:</label>
                    <input class="col-xs-10 mesoo" type="text" id="meso4" name="meso4" onkeypress="return justNumbers(event);">
                  </div>         
                </div>
              </form>
            </div>
            <!-- CONTENEDOR DEL ENTRENAMIENTO COMPETITIVO -->
            <div class="col-md-3 col-xs-offset-10 row">
            <br>
              <button type="button" class="btn btn-success" data-dixsiss="modal" id="btnCotinnuar"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Continuar</button>
            </div>
          </div>
          <!-- TERCER PANEL -->
          <div role="tabpanel" class="tab-pane" id="mesociclos" >
            <form method="post" id="formSemMeso">
              <div class="row">
                <!-- PRIMER TABLA-->
                <div class="col-md-6">
                  <label>Pre-temporada</label>                
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Mesociclo</th>
                        <th>Semanas</th> 
                      </tr>
                    </thead>                    
                    <tbody id="cuerpoTablaPG">
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>             
                  </table>
                </div>          
                <!-- SEGUNDA TABLA-->
                <div class="col-md-6">
                  <label>Preparacion Especial</label>                  
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Mesociclo</th>
                        <th>Semanas</th> 
                      </tr>
                    </thead>                
                    <tbody id="cuerpoTablaPE">
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>  
                  </table>
                </div>        
              </div>
              <!-- TERCERA TABLA-->
              <div class="row">
                <div class="col-md-6">
                  <label>Pre competitivo</label>                    
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Mesociclo</th>
                        <th>Semanas</th> 
                      </tr>
                    </thead>                    
                    <tbody id="cuerpoTablaPC">
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>          
                <!-- CUARTA TABLA-->
                <div class="col-md-6">
                  <label>Competitivo</label>
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>Mesociclo</th>
                        <th>Semanas</th> 
                      </tr>
                    </thead>
                    <tbody id="cuerpoTablaC">
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-xs-offset-10 row">
                  <button type="button" class="btn btn-success" data-dixsiss="modal" id="btnCotinnuar2"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Continuar</button>
                </div>
              </div>
            </form>
          </div>          
          <!-- Cuarto Panel -->
          <div role="tabpanel" class="tab-pane" id="direcciones">                
            <!--  definicion de lugar (center) -->
            <div id="home" class="tab-pane fade in active">
              <div class="col-md-3">
                <div class="row">
                  <div><center><h4> Pre<br>Temporada</h4></center>
                    <div class="col-xs-7 col-md-7">
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico Fisico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Tecnico Tactico</h6></div>  
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Pre Psicologico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Competencia</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Total</h6></div>
                    </div>
                    <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                      <form class="form-inline text-left" role="form" id="colum1" name="colum1" action="" method="post">
                        <input type="text" class="form-control" name="gen_tec" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                        <input type="text" class="form-control" name="gen_fis" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="gen_tac" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="gen_psi" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="gen_com" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" id="res_col1" name="colum1" placeholder="0" maxlength="3" size="1" readonly="" />
                      </form>
                    </div>
                  </div>         
                </div>
              </div>                     
              <div class="col-md-3">
                <div class="row">
                  <div> <center><h4> Preparacion<BR>Especial</h4></center>
                    <div class="col-xs-7 col-md-7">
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico Ficico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Tecnico Tactico</h6></div>  
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Pre<BR>Psicologico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Competencia</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Total</h6></div>
                    </div>
                    <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                      <form class="form-inline text-left" role="form" id="colum2" name="colum2" action="" method="post" >        
                        <input type="text" class="form-control" name="esp_tec" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="esp_fis" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                        <input type="text" class="form-control" name="esp_tac" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="esp_psi" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="esp_com" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" id="res_col2" name="colum2" placeholder="0" maxlength="3" size="1" readonly="" />
                      </form>
                    </div>
                  </div>         
                </div>
              </div>                     
              <div class="col-md-3">
                <div class="row">
                  <div><center><h4> Pre<BR>Competitivo</h4></center>
                    <div class="col-xs-7 col-md-7">
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico Fisico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Tecnico Tactico</h6></div>  
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Pre<BR>Psicologico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Competencia</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Total</h6></div>
                    </div>
                    <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                      <form class="form-inline text-left" role="form" name="colum3" id="colum3" action="" method="post">
                        <input type="text" class="form-control" name="pcom_tec" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="pcom_fis" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                        <input type="text" class="form-control" name="pcom_tac" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="pcom_psi" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="pcom_com" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" id="res_col3" name="colum3" placeholder="0" maxlength="3" size="1" readonly="" />
                      </form>
                    </div>
                  </div>         
                </div>
              </div>                     
              <div class="col-md-3">
                <div class="row">
                  <div><center><h4><BR>Competitivo</h4></center>
                    <div class="col-xs-7 col-md-7">
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Tecnico Fisico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Tecnico Tactico</h6></div>  
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Pre<BR>Psicologico</h6></div>
                      <div class="form-group" align="center"><h6 style="margin-bottom: 17px;">Competencia</h6></div>
                      <div class="form-group" align="center" ><h6 style="margin-bottom: 17px;">Total</h6></div>
                    </div>
                    <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                      <form class="form-inline text-left" role="form" name="colum4" id="colum4" action="" method="post">   
                        <input type="text" class="form-control" name="com_tec" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="com_fis" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                        <input type="text" class="form-control" name="com_tac" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="com_psi" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" name="com_com" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                        <input type="text" class="form-control" id="res_col4" name="colum4" placeholder="0" maxlength="3" size="1" readonly="" />
                      </form>
                    </div>
                  </div>         
                </div>            
              </div>
              <br><br>
              <div class="col-xs-offset-6 col-xs-6">
              <br><br>          
              <form method="POST" action="/Desarrollo_SSPED/Futbol/Programacion/tablas_pdf.php" target="_blank">
                <div id="boton_guardar">                    
                  <input type="button" class="col-xs-6 btn btn-success"  value="Guardar" id="Guardar" method="post" disabled="">
                </div>
                <input type="hidden" value="" id="planifi" name="planifi">
                 <?php 
                 echo "
                  <input type='hidden' id='id_categ' name='id_categ' value='".$_GET['idc']."'>
                  ";
                  ?>
               
                <div id="boton_proyecto">
                  <button type="submit" class="col-xs-6 btn btn-primary"  value="Proyecto" id="" disabled="">Proyecto</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="/Desarrollo_SSPED/Futbol/Programacion/cargarTablasProgramacion.js"></script>
  </div>
</div>
</div>

<!--  llamada al pie de pagina -->

  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
  ?>

</body>
</html> 