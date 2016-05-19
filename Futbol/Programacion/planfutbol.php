<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
        $('#BuscaEquipo').on('keyup', busqueda_equipo)

        $('#buscaNomP').on('keyup', busqueda_planificacion)

        listar();
        $('#eliminaPlani').on('click',eliminar)
      })

      //listar planificaciones

      function listar()
      {
          //setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'planificacion.php',
            type: 'POST',
            data: {opcion: 'listar'}
          })
          .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-1 col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th style="visibility:hidden;">Nro.</th><th >Nombre</th><th>Grupo</th><th>tipo_plan</th></tr></thead><tbody>';
                 

                  for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {

                    html+='<tr onclick="mostrar_datos(this)"><td style="visibility:hidden;">'+resp[i].id+'</td><td>'+resp[i].nombre+'</td><td >'+resp[i].grupo+'</td><td >'+resp[i].tipo_plan+'</td></tr>';
                    }
                  }
                  
                html+= '</tbody></table></div>';

                $('#planificaciones').html(html);

              })
          .fail(function() {
            console.log("error");
          })
          
        
      }

       function eliminar()
      {
          //var datos = "&idGrupo=" + encodeURIComponent(idg2)+"&opcion=" + encodeURIComponent('eliminar');
          //console.log(datos);
          setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'planificacion.php',
            type: 'POST',
            data: {idP: $('#idP').val(), opcion: 'eliminar'}
          })
          .done(function(data) {
             var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              $('#nombreP').val('');
              $('#grupoP').val('');
              $('#planP').val('');
              listar();

              
              var html='<div class="alert alert-success ocultar" id="alertaE" role="alert">Eliminado!</div>'; 
            }

            $('#alerta').html(html);  
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }

      function mostrar_datos(f)
          {
             
              row= $(f).find('td:eq(0)').text();
              row2 = $(f).find('td:eq(1)').text();
              row3 = $(f).find('td:eq(2)').text();
              row4= $(f).find('td:eq(3)').text();
              $('#nombreP').val(row2);
              $('#grupoP').val(row3);
              $('#planP').val(row4);
              $('#idP').val(row);
              $('#planifi').val(row);
              console.log(row);
             
              
          }

      //busca por nombre de equipo para el seguimiento
          function busqueda_equipo(){
            var n = $('#BuscaEquipo').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar2');//{a: n, opcion:'buscar'};
            console.log(o);
            setTimeout("$('.ocultar').hide();", 5000);
              $.ajax({
                url: 'grupos.php', 
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                var html = '<div class="table-responsive  col-sm-11 col-xs-11" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th style="display:none;">id</th><th style="display:none;">idc</th><th>Equipo</th><th>Categoria</th></tr></thead><tbody>';
        


                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                    html+='<tr onclick="click_datos(this)"><td style="display:none;">'+resp[i].idGrupo+'</td><td style="display:none;">'+resp[i].idCat+'</td><td>'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';}
                  }
                  html+= '</tbody></table></div>';

                  $('#ResBusqueda').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }

          function busqueda_planificacion(){
            var n = $('#buscaNomP').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            setTimeout("$('.ocultar').hide();", 5000);
              $.ajax({
                url: 'planificacion.php', 
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                var html = '<div class="table-responsive col-sm-offset-1 col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th style="visibility:hidden;">Nro.</th><th >Nombre</th><th>Grupo</th><th>tipo_plan</th></tr></thead><tbody>';
        


                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                    html+='<tr onclick="mostrar_datos(this)"><td style="visibility:hidden;">'+resp[i].id+'</td><td>'+resp[i].nombre+'</td><td >'+resp[i].grupo+'</td><td >'+resp[i].tipo_plan+'</td></tr>';}
                  }
                  html+= '</tbody></table></div>';

                  $('#planificaciones').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }

          var idg2;
          //Mostrar datos al hacer click
          function click_datos(f)
          {

          //  html+='<tr onclick="click_datos(this)"><td style="display:none;">'+resp[i].idGrupo+'</td><td style="display:none;">'+resp[i].idCat+'</td><td>'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';}
              
              row= $(f).find('td:eq(0)').text();
              row4= $(f).find('td:eq(1)').text();
              row2 = $(f).find('td:eq(2)').text();
              row3 = $(f).find('td:eq(3)').text();
              $('#ReadEquipo').val(row2);
              $('#ReadCategoria').val(row3);
              idg2 = row;
              console.log(idg2);
              $('#mensaje').html('');
              $('#plani').html('<div class="col-sm-2">'+
                  ' <a href="/Desarrollo_SSPED/Futbol/Programacion/tiempo_plan.php?plan=Anual&id='+idg2+'&idc='+row4+'">'+
                    ' <button type="button" class="form-control">'+
                      '   Anual'+
                     '  </span>'+
                    ' </button>'+
                     ' </a>  '+
                   '</div> '+

                   '<div class="col-sm-3">'+
                  ' <a href="/Desarrollo_SSPED/Futbol/Programacion/tiempo_plan.php?plan=Trimestral&id='+idg2+'&idc='+row4+'">'+
                    ' <button type="button" class="form-control">'+
                      '   Trimestral'+
                     '  </span>'+
                    ' </button>'+
                     ' </a>  '+
                   '</div> '+


              '<div class="col-sm-3">'+
                  ' <a href="/Desarrollo_SSPED/Futbol/Programacion/tiempo_plan.php?plan=Semestral&id='+idg2+'&idc='+row4+'">'+
                    ' <button type="button" class="form-control">'+
                      '   Semestral'+
                     '  </span>'+
                    ' </button>'+
                     ' </a>  '+
                   '</div> '+

                   '<div class="col-sm-4">'+
                  ' <a href="/Desarrollo_SSPED/Futbol/Programacion/tiempo_plan.php?plan=Competencia&id='+idg2+'&idc='+row4+'">'+
                    ' <button type="button" class="form-control">'+
                      '   Competencia'+
                     '  </span>'+
                    ' </button>'+
                     ' </a>  '+
                   '</div> ' );
              
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
    }
    function guardar()
{
  if(document.colum1.colum1.value == 100 && document.colum2.colum2.value == 100 && document.colum3.colum3.value == 100 && document.colum4.colum4.value == 100){
        document.gua.to.disabled=false;
    }
    else{
        document.gua.to.disabled=true;
    }
}
  
    </script>
    
</head>
<body>
<!--  llamada a la cabecera -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera1.php";
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
<div class="col-xs-12 col-sm-8  ">
  <div class="panel panel-default">
		<div class="panel-heading">Planificacion</div>
			<div class="panel-body">
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="#primera" aria-controls="" role="tab" data-toggle="tab">
            Crear Planificacion</a>
          </li>
          <li role="presentation"><a href="#segunda" aria-controls="s" role="tab" data-toggle="tab" >
            Planificaciones pasadas</a>
          </li>
        </ul>
        <div class="tab-content">
          <!-- Primer Panel -->
          <div role="tabpanel" class="tab-pane active" id="primera">
            <div>
              <h4>Planificacion de Entrenamiento</h4>
            </div>
              <!--  Formulario de Busqueda -->
            <br>
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label" id="buscarMod1" >Equipo:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="BuscaEquipo" placeholder="Nombre de equipo" >
                </div>
                <div class="col-sm-3">
                  <button  type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <span class="hidden-xs">
                      Buscar
                    </span>
                  </button>
                </div>
              </div>        
              <div>
                <center><h4>Datos del Equipo</h4></center>
              </div>
              <!--  Tabla de resultado de busqueda -->
              <div class="col-sm-7 col-xs-12 form-group table-responsive" id="ResBusqueda">
                        
              
              </div>
              <!--  formulario de muestra de informacion -->
              <br>
              <div class="col-sm-5 col-xs-12">
                <form class="form-horizontal">
                  <div class="form-group">              
                    <label>Equipo:</label>  
                    <input type="text" class="form-control" id="ReadEquipo" placeholder="equipo" readonly="">              
                  </div> 
                  <div class="form-group">              
                    <label>Categoria:</label>   
                    <input type="text" class="form-control" id="ReadCategoria" placeholder="Categoria" readonly="">              
                  </div>                 
                </form>
              </div> 
              <!-- Tipo de Planificacion -->
              <div class="col-sm-12 col-xs-12" id="plani">
                <h4>Planificacion</h4>
                <div id="mensaje">
                  <div  class="alert alert-info" role="alert">
                    Para iniciar la planificacion, primero seleccione un equipo.
                  </div>
                </div>
                <br>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane " id="segunda">
            <!-- FORM MODIFICAR planificacion -->
            <h4>Buscar Planificacion</h4>
            <form class="form-horizontal" id="formModificar" method="POST" action="/Desarrollo_SSPED/Futbol/Programacion/tablas_pdf.php" target="_blank">
             <input type="hidden" value="" id="planifi" name="planifi">
            <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label" id="buscaNo">Nombre:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="buscaNomP" name="buscaNomP" placeholder="Nombre de planificacion" >
                </div>
                <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                    Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>                 
                </div>
              </div>        
              <!--tabla resultante-->
              <div class="form-group" id="planificaciones">    
              
              </div>        
              <div>
                <center><h4>Datos de la planificacion</h4></center>
              </div>            
              <br>
              <div class="form-group">
                <label for="inputNombre" class="col-xs-offset-1 col-xs-3 control-label">Nombre:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="nombreP" name="nombreP" placeholder="Nombre del plan" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputNombre" class="col-xs-offset-1 col-xs-3 control-label">Grupo:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="grupoP" name="grupoP" placeholder="Nombre del grupo" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputNombre" class="col-xs-offset-1 col-xs-3 control-label">Tipo plan:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="planP" name="planP" placeholder="Tipo de plan" readonly="">
                </div>
              </div>
              <input type="hidden" class="form-control" id="idP" name="idP" placeholder="Tipo de plan" readonly="">                  
            
              <div id="alerta"></div>
              <div class="form-group">
                <div class="col-sm-offset-8 col-sm-4 col-xs-3">
                  <button type="submit" class="btn btn-success">Ver</button>
                  <button type="submit" id="eliminaPlani" class="btn btn-danger">Eliminar</button>
                </div>
              </div>          
            </form>
            <!-- FIN FORM  -->        
          </div>
        </div>      
      </div>
    </div>
  </div>
  <!--  llamada al pie de pagina -->
 	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
 	?>
</body>
</html> 