<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <!-- permitir solo numeros en un input -->
    <script type="text/javascript">
      $(document).ready(function() {

          $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
        imagen_defecto()
        llena_select()
        llena_select2()
        $('#formRegistroJ').on('submit', registro_jugadores)
        $('#formModificarJ').on('submit', modificar_jugadores)
        $('#buscarMod1').on('keyup', buscar_tecladoJ)
        $('#eliminacion').on('click', eliminar_jugadores)
        $('#EliJugador').on('keyup', buscar_tecladoJ2)
        listarJ();
        listarJ2();
        limpiarRJ();
        
         $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
             listarJ();
              listarJ2();
              limpiarEJ();
              limpiarMJ();
              limpiarRJ();

          });
      })
      //funcion registrar jugadores
      function registro_jugadores()
      {
          setTimeout("$('.ocultar').hide();", 5000);
          var formData = new FormData($('#formRegistroJ')[0]); 
          formData.append( 'opcion','registrar');
          console.log(formData.toString());
          $.ajax({
            url: 'jugadores.php',
            type: $('#formRegistroJ').attr('method'),
            data: formData,
            contentType: false,
            processData: false,
          })
          .done(function(data) {
              var resp = $.parseJSON(data);
            listarJ();
            limpiarMJ();
            console.log(data);
            console.log(resp);
            var t= resp.resp;
           
            if(t==1)
            {
              var html='<div  class="alert alert-success ocultar" role="alert">Insertado!</div>'; 
                //$("#formRegistroJ")[0].reset();
            }
            if(t==0)
            {
              var html='<div class="alert alert-danger ocultar" role="alert" center >No se pudo Registrar!</div>';
            }
            if(t==2)
              {
              var html='<div class="alert alert-danger ocultar" role="alert" center >NO es imagen!</div>';
            }
            if(t==3)
              {
              var html='<div class="alert alert-danger ocultar" role="alert" center >Insertar Imagenes menores a 8mb</div>';
            }
            limpiarRJ();
            imagen_defecto();
            $('#resultado').html(html); 

          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
       function modificar_jugadores()
      {
          setTimeout("$('.ocultar').hide();", 5000);
          var formData = new FormData($('#formModificarJ')[0]);
          formData.append( 'opcion','modificar');
          formData.append( 'idJugador',idj);          
          console.log(formData);
          $.ajax({
            url: 'jugadores.php',
            type: $('#formModificarJ').attr('method'),
            data: formData,
            contentType: false,
            processData: false,
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            listarJ();
            limpiarMJ();
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              var html='<div class="alert alert-success ocultar" role="alert">Modificado!</div>'; 
              listarJ();
            }
            if(t==0)
            {
              var html='<div class="alert alert-danger ocultar" role="alert" center >No se pudo Registrar!</div>';
            }
            if(t==2)
              {
              var html='<div class="alert alert-danger ocultar" role="alert" center >NO es imagen!</div>';
            }
            if(t==3)
              {
              var html='<div class="alert alert-danger ocultar" role="alert" center >Insertar Imagenes menores a 8mb</div>';
            }
            imagen_defecto();
            $('#resultado3').html(html);      
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
      function limpiarRJ()
      {
        $("#formRegistroJ")[0].reset();
        $('#regFechana').val('');
        $('#regFechana').val(0);
      
      }
      function eliminar_jugadores()
      {
          //var datos = "&idGrupo=" + encodeURIComponent(idg2)+"&opcion=" + encodeURIComponent('eliminar');
          //console.log(datos);
          setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'jugadores.php',
            type: 'POST',
            data: {idJugador: idj, opcion: 'eliminar'}
          })
          .done(function(data) {
             var resp = $.parseJSON(data);
             listarJ2();
             limpiarEJ();
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              var html='<div class="alert alert-success ocultar" id="alertaE" role="alert">Eliminado!</div>'; 
            }
            imagen_defecto();
            $('#resultado6').html(html);  
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
      function imagen_defecto(){
    var html2='<img src="fotos/people.png"  alt="..." class="img-rounded" width="150" heigth="150">';
        $('#mostrar-ima').html(html2);
        $('#mostrar-ima-mod').html(html2);
        $('#mostrar-ima-eli').html(html2);
  }
      function listarJ(){
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: {opcion: 'listar'}
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th>Nombre</th><th>Apellido P.</th><th>Apellido M.</th><th>Fecha N.</th><th>NomGrupo</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                        html+='<tr onclick="mostrar_datosJ(this)"><td style="display:none">'+resp[i].idJugador+'</td><td style="display:none">'+resp[i].idGrupo+'</td><td style="display:none"></td><td>'+resp[i].nombre_ju+'</td><td>'+resp[i].apellidop_ju+'</td><td>'+resp[i].apellidom_ju+'</td><td>'+resp[i].fechana_ju+'</td><td>'+resp[i].nombre_grupo+'</td><td style="display:none">'+resp[i].imagen_ju+'</td></tr>';
                    }
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          function listarJ2(){
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: {opcion: 'listar'}
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th>Nombre</th><th>Apellido P.</th><th>Apellido M.</th><th>Fecha N.</th><th>NomGrupo</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                        html+='<tr onclick="mostrar_datosJ2(this)"><td style="display:none">'+resp[i].idJugador+'</td><td style="display:none">'+resp[i].idGrupo+'</td><td style="display:none"></td><td>'+resp[i].nombre_ju+'</td><td>'+resp[i].apellidop_ju+'</td><td>'+resp[i].apellidom_ju+'</td><td>'+resp[i].fechana_ju+'</td><td>'+resp[i].nombre_grupo+'</td><td style="display:none">'+resp[i].imagen_ju+'</td></tr>';
                    }
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado4').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
      //busca jugadores por nombre
      function buscar_tecladoJ(){
            var n = $('#buscarMod1').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            //setTimeout("$('.ocultar').hide();", 5000);
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                 var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th>Nombre</th><th>Apellido P.</th><th>Apellido M.</th><th>Fecha N.</th><th>NomGrupo</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                        html+='<tr onclick="mostrar_datosJ(this)"><td style="display:none">'+resp[i].idJugador+'</td><td style="display:none">'+resp[i].idGrupo+'</td><td style="display:none"></td><td>'+resp[i].nombre_ju+'</td><td>'+resp[i].apellidop_ju+'</td><td>'+resp[i].apellidom_ju+'</td><td>'+resp[i].fechana_ju+'</td><td>'+resp[i].nombre_grupo+'</td></tr>';
                    }
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          //busqueda para eliminar
           function buscar_tecladoJ2(){
            var n = $('#EliJugador').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            //setTimeout("$('.ocultar').hide();", 5000);
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                 var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th>Nombre</th><th>Apellido P.</th><th>Apellido M.</th><th>Fecha N.</th><th>NomGrupo</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    if(resp[i].res==1)
                    {
                        html+='<tr onclick="mostrar_datosJ2(this)"><td style="display:none">'+resp[i].idJugador+'</td><td style="display:none">'+resp[i].idGrupo+'</td><td style="display:none"></td><td>'+resp[i].nombre_ju+'</td><td>'+resp[i].apellidop_ju+'</td><td>'+resp[i].apellidom_ju+'</td><td>'+resp[i].fechana_ju+'</td><td>'+resp[i].nombre_grupo+'</td></tr>';
                    }
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado4').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
      //llena select registro jugadores: grupos
      function llena_select(){
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: {opcion: 's_buscar'}
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<select class="form-control" id="modGrupoJ" name="regGrupo" required><option></option>';
                  for(i in resp){ 
                    html+='<option value="'+resp[i].idGrupo+'">'+resp[i].nombre_gru+'</option> ';
                  }
                  html+= '</select>';

                  $('#select1').html(html);
                  

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          //llena el select de la pestaña modificar
          function llena_select2(){
              $.ajax({
                url: 'jugadores.php',
                type: 'POST',
                data: {opcion: 's_buscar'}
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<select class="form-control" id="modGrupoJ2" name="modGrupoJ2" name="regGrupo" required>';
                  for(i in resp){ 
                    html+='<option value="'+resp[i].idGrupo+'">'+resp[i].nombre_gru+'</option> ';
                  }
                  html+= '</select>';

    
                  $('#select2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          var idj;
          var url;
          function mostrar_datosJ(f)
          {
              row0= $(f).find('td:eq(0)').text();
              row1 = $(f).find('td:eq(1)').text();
              row2 = $(f).find('td:eq(2)').text();
              row3 = $(f).find('td:eq(3)').text();
              row4 = $(f).find('td:eq(4)').text();
              row5 = $(f).find('td:eq(5)').text();
              row6 = $(f).find('td:eq(6)').text();
              row7 = $(f).find('td:eq(8)').text();
              idj=row0;
              url=row2;
              $('#modNombreJ').val(row3);
              $('#modApellido1J').val(row4);
              $('#modApellido2J').val(row5);
              $('#modFechaJ').val(row6);
              $('#modGrupoJ2').val(row1);
              var html4='<img src="'+row7+'"  alt="..." class="img-rounded" width="200" heigth="200">'
              $('#mostrar-ima-mod').html(html4);
              //console.log(row6);
              //console.log(idg+' '+idc);

              
              
          }
           function limpiarMJ()
          {
              $('#modNombreJ').val('');
              $('#modApellido1J').val('');
              $('#modApellido2J').val('');
              $('#modFechaJ').val('');
              $('#modGrupoJ2').val('');
              $('#buscarMod1').val('');
        
          }

           function mostrar_datosJ2(f)
          {
              row0= $(f).find('td:eq(0)').text();
              row1 = $(f).find('td:eq(1)').text();
              row2 = $(f).find('td:eq(2)').text();
              row3 = $(f).find('td:eq(3)').text();
              row4 = $(f).find('td:eq(4)').text();
              row5 = $(f).find('td:eq(5)').text();
              row6 = $(f).find('td:eq(6)').text();
              row7 = $(f).find('td:eq(7)').text();
              row8 = $(f).find('td:eq(8)').text();
              idj=row0;
              $('#elNombreJ').val(row3);
              $('#elApellido1J').val(row4);
              $('#elApellido2J').val(row5);
              $('#elFechaJ').val(row6);
              $('#elGrupoJ2').val(row7);
              url=row2;
              var html4='<img src="'+row8+'"  alt="..." class="img-rounded" width="200" heigth="200">'
              $('#mostrar-ima-eli').html(html4);

              //console.log(row6);
              //console.log(idg+' '+idc);
              
          }
          function limpiarEJ()
          {   
              $('#elNombreJ').val('');
              $('#elApellido1J').val('');
              $('#elApellido2J').val('');
              $('#elFechaJ').val('');
              $('#elGrupoJ2').val('');
              $('#EliJugador').val('');
 
          }
      //funcion para aceptar solo numeros
     function justNumbers(e)
    {
       var keynum = window.event ? window.event.keyCode : e.which;
       if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
    //funcion para aceptar solo letras
    function sololetras(){
      if (event.keyCode >45 && event.keyCode  <57) event.returnValue = false;
      }

    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";
       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
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


<!-- Contenedor Pestaña ABM Equipo -->
<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">Administrar Jugadores</div>
      <div class="panel-body">
        <!-- Pestaña ABM Equipo -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-first">Registrar</a></li>
          <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-second">Modificar</a></li>
          <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-third">Eliminar</a></li>
        </ul>
        <!-- Contenido Pestaña ABM Equipo -->
        <div class="tab-content">
          <!-- Contenido Pestaña registrar Equipo-->
          <div class="active tab-pane fade in" id="tabs-first">
            <!-- FORM CREAR Equipo -->
            <h4>Registrar nuevo jugador</h4>
            <form class="form-horizontal" method="post" id="formRegistroJ" enctype="multipart/form-data">            
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regNombre" name="regNombre" placeholder="Nombre " onkeypress="return soloLetras(event);" >
                </div> 
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regAp1" name="regAp1" placeholder="Apellido paterno" onkeypress="return soloLetras(event);">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regAp2" name="regAp2" placeholder="Apellido materno" onkeypress="return soloLetras(event);">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
                <div class="col-sm-7">
                  <input type="date" id="regFechana" name="regFechana" step="1" min="01-01-1900" max="31-12-2100" value="<?php echo date("d-m-Y");?>">
                </div>
              </div>            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Equipo</label>
                <div class="col-sm-3" id="select1">              
                
                </div>
              </div>            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia:</label>
                <div class="col-sm-3" >
                  <output  id="mostrar-ima" name="mostrar-ima" > 
                
                 </output></div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">                  
                  Subir imagen:
                </label>        
                              
                <input type="file" id="abrir-ima" class="form-control-file col-sm-7 col-xs-12" name="abrir-ima">

              </div>
              <script src="mostrar_ima.js"></script>                        
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-2 col-xs-6">
                  <button type="button" class="btn btn-primary">Limpiar</button>
                </div>
                <div class="col-sm-offset-2 col-sm-2 col-xs-6">
                  <button type="submit" class="btn btn-success">Registrar</button>
                </div>
              </div>
              <div id="resultado"></div>
            </form>
            <!-- FIN FORM CREAR Equipo -->
           </div>
          <!-- Fin Contenido Pestaña registrar Equipo-->
          <!--  Contenido Pestaña modificar Equipo-->
          <div class="tab-pane fade" id="tabs-second">
            <!-- FORM MODIFICAR Equipo -->
            <h4>Modificar informacion jugador</h4>
            <form class="form-horizontal"  id="formModificarJ" method="POST" enctype="multipart/form-data">
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label"  >Nombre:</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="buscarMod1" placeholder="Nombre de jugador"  onkeypress="return soloLetras(event);">
              </div>
              <div class="col-xs-6 col-sm-3 hidden-xs">
                <label class="col-sm-offset-1  control-label">
                  Buscar
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </label>                
              </div>
            </div>
            <div id="resultado2" class="form-group">          
            
            </div>
            <div>
              <center><h4>Datos del Jugador</h4></center>
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="modNombreJ" name="modNombreJ" placeholder="Nombre " onkeypress="return soloLetras(event);" required >
              </div>            
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="modApellido1J" name="modApellido1J" placeholder="Apellido paterno" onkeypress="return soloLetras(event);" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" id="modApellido2J" name="modApellido2J" placeholder="Apellido materno" onkeypress="return soloLetras(event);" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
              <div class="col-sm-7">
                <input type="date" id="modFechaJ" name="modFechaJ" step="1" min="01-01-1900" max="31-12-2100" value="<?php echo date("d-m-Y");?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Equipo</label>
              <div class="col-sm-3" id="select2">
              
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia del jugador:</label>
              <div class="col-sm-3" >
                <output  id="mostrar-ima-mod" name="mostrar-ima-mod" > 
                
                </output></div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Subir imagen:</label>                
                <label class=" control-label"></label>                  
                <input type="file" id="abrir-ima-mod" class="form-control-file col-sm-7 col-xs-12 " name="abrir-ima-mod">
              </div>
              <script src="mostrar_ima_mod.js"></script>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-2 col-xs-6">
                  <button type="button" class="btn btn-primary">Limpiar</button>
                </div>
                <div class="col-sm-offset-2 col-sm-2 col-xs-6">
                  <button type="submit" class="btn btn-success">Modificar</button>
                </div>
              </div>            
              <div class="form-group">              
              
              </div>
              <div id="resultado3">              
              
              </div>                          
            </form>
            <!-- FIN FORM MODIFICAR Equipo -->
          </div>
          <!--  Fin Contenido Pestaña modificar Equipo-->
          <div class="tab-pane fade" id="tabs-third">            
            <!-- FORM ELIMINAR Equipo -->
            <h4>Eliminar jugador</h4>
            <form class="form-horizontal"  id="formEliminarJ" method="POST">
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label"  >Nombre:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="EliJugador" placeholder="Nombre de jugador"  onkeypress="return soloLetras(event);">
                </div>
                <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                    Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>                 
                </div>
              </div>
              <div class="form-group" id="resultado4">              
              
              </div>
              <div>
                <center><h4>Datos del Jugador</h4></center>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia del Jugador:</label>
                <div class="col-sm-7">
                  <div  id="mostrar-ima-eli" name="mostrar-ima-eli">
                    
                  </div>                  
                </div>
              </div>            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elNombreJ" placeholder="Nombre " onkeypress="return soloLetras(event);" readonly="">
                </div>                
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elApellido1J" placeholder="Apellido paterno" onkeypress="return soloLetras(event);" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elApellido2J" placeholder="Apellido materno" onkeypress="return soloLetras(event);" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elFechaJ" placeholder="Fecha de nacimiento" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Equipo</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="elGrupoJ2" placeholder="Equipo" readonly="">
                </div>
              </div>          
              <!-- Boton eliminar -->
              <div class="form-group">
                <div class="col-sm-offset-7 col-sm-2">
                  <button type="button" class="eliminar btn btn-danger " data-toggle="modal" data-target="#myModalEliminarJugador">
                    Eliminar
                  </button>
                </div>
              </div>
              <!-- Formulario modal2n -->
              <div class="modal fade" id="myModalEliminarJugador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xs" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
                    </div>                     
                    <div class="modal-body">
                      <form class="form-horizontal" method="post" action='' name="login_form">
                        <div class="form-group">
                          <br>
                          <label for="inputCI" class=" col-xs-offset-1 col-xs-11">Seguro de eliminar este Jugador?</label>
                        </div>                
                        <div class="form-group">
                          <div class="col-xs-offset-1 col-xs-7">
                            <button type="button" id="eliminacion" class="btn btn-success" data-dismiss="modal">Eliminar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                        <div id="resultado6"></div>
                      </form>
                    </div>                    
                  </div>
                </div>
              </div>
            </form>
            <!-- FIN FORM ELIMINAR Equipo -->
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