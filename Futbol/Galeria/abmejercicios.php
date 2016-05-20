<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.min.js"></script>

    <!-- permitir solo numeros en un input -->
  <script type="text/javascript">
$(document).ready(function() {

    $('#formRegistro').on('submit', RegistrarDatos)
    $('#formModificar').on('submit', modificar_ejercicio)
    $('#modNombre').on('keyup', buscar_teclado)
    $('#eliNombre').on('keyup', buscar_teclado2)

    actualizar_tablas()
   

    //mostramos la imagen por defecto 
    var html2=imagen_defecto()
    $('#mostrar-ima').html(html2);
    $('#mostrar-ima-mod').html(html2);
    $('#mostrar-ima-eli').html(html2);

        //$('#formModificar').on('submit', modificar_grupos)
       $("#prepa-reg").change(function(){
        if($("#prepa-reg").val()==1)
        {
          $("#ejersub-reg").prop('disabled',false);
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"idinputPreparatoriaEj="+$("#prepa-reg").val(),
            success: function(subelemento){
              $("#ejersub-reg").html(subelemento);
            }
          })
        }else{
            $("#ejersub-reg").html('<option value="4">----</option>');
            $("#ejersub-reg").prop('disabled',true);
            $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"elemento="+$("#prepa-reg").val(),
            success: function(elemento){
              $("#ele-reg").html(elemento);
            }
          })
        }
        });
       $("#prepa-mod").change(function(){
        if($("#prepa-mod").val()==1)
        {
          $("#ejersub-mod").prop('disabled',false);
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"idinputPreparatoriaEj="+$("#prepa-mod").val(),
            success: function(subelemento){
              $("#ejersub-mod").html(subelemento);
            }
          })
        }else{
            $("#ejersub-mod").html('<option value="4">----</option>');
            $("#ejersub-mod").prop('disabled',true);
            $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"elemento="+$("#prepa-mod").val(),
            success: function(elemento){
              $("#ele-mod").html(elemento);
            }
          })
        }
        });

       $("#ejersub-reg").change(function(){
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"sub="+$("#ejersub-reg").val(),
            success: function(elemento){
              $("#ele-reg").html(elemento);
            }
          })
        });
       $("#ejersub-mod").change(function(){
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"sub="+$("#ejersub-mod").val(),
            success: function(elemento){
              $("#ele-mod").html(elemento);
            }
          })
        });
      });
function actualizar_tablas(){
  verdatos();
    verdatos2();
}
function verdatos(){
    
      o = "&opcion=" + encodeURIComponent('tabla_llena');
            console.log(o);

          $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-2 col-sm-8" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Preparaciones</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td>'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
         event.preventDefault();

     }
     function verdatos2(){
    
      o = "&opcion=" + encodeURIComponent('tabla_llena');
            console.log(o);

          $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-2 col-sm-8" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th>Categoria</th><th>Preparaciones</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos2(this)"><td>'+resp[i].nombre+'</td><td>'+resp[i].categoria_sub+'</td><td>'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado-eli').html(html);

              })
              .fail(function() {
                console.log("error");
              })
         event.preventDefault();

     }
//IMAGEN QUE SE MOSTRAR POR DEFECTO EN LAS VENTANAS
  function imagen_defecto(){
    var html2='<img src="acciones_abm_ejer/fotos/imagenfutbol.png"  alt="..." class="img-rounded" width="200" heigth="200">';
    return html2;
  }

  function RegistrarDatos(){
      setTimeout("$('.ocultar').hide();", 5000);
      var input = $("<input>").attr("type", "hidden").attr("name", "opcion").val("registrar");
      $('#formRegistro').append($(input));
      var formData = new FormData($("#formRegistro")[0]);

        $.ajax({
                type: $('#formRegistro').attr('method'),
                url:'acciones_abm_ejer/ejercicio.php',
                data: formData,
                contentType: false,
          processData: false,
          }).done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              var html='<div class="alert alert-success ocultar" role="alert" center >Insertado!</div>';
              var html2=imagen_defecto();
              $("#formRegistro")[0].reset();
              $('#mostrar-ima').html(html2);
              actualizar_tablas()
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
            $('#resultado').html(html);

       
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
      }

      function Limpiar(){
         $("#formRegistro")[0].reset();
         $("#formModificar")[0].reset();
         $("#formEliminar")[0].reset();
        event.preventDefault();
        var html2=imagen_defecto();
            $('#mostrar-ima').html(html2);
            $('#mostrar-ima-mod').html(html2);
            $('#mostrar-ima-eli').html(html2);


      }

      function eliminarDatos(){

        setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'acciones_abm_ejer/ejercicio.php',
            type: 'POST',
            data: {idEjercicio: idej_eli, opcion: 'eliminar'}
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              var html='<div class="alert alert-success ocultar" role="alert" center >Eliminado!</div>';
            }
            else{
              var html='<div  class="alert alert-danger ocultar" role="alert"> No se pudo eliminar</div>'; 
            }
            var html2=imagen_defecto();
            $('#mostrar-ima-eli').html(html2);
            $('#resultado-men-eli').html(html);      
            $("#formEliminar")[0].reset();
            actualizar_tablas();
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();

/*
        .done(function(respuesta){
              
            if(respuesta==1)
            {
              var html='<div class="alert alert-success" role="alert">Insertado!</div>'; 
            }
            $('#resultado').html(html); 
            })
      */  
      }
      function buscar_teclado(){
            var n = $('#modNombre').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            
              $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-2 col-sm-8" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Preparaciones</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td>'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
           var idej_mod;
           function mostrar_datos(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(1)').text();
              prepa_mod = $(f).find('td:eq(3)').text();
              ele_mod = $(f).find('td:eq(5)').text();
              metodo_mod = $(f).find('td:eq(6)').text();
              tarea_mod = $(f).find('td:eq(7)').text();
              desc_mod = $(f).find('td:eq(8)').text();
              foto_mod = $(f).find('td:eq(9)').text();
              idej_mod = $(f).find('td:eq(10)').text();
              

              $('#nombre-mod').val(nom_mod);
              $('#cate-mod').val(cate_mod);
              $('#prepa-mod').val(prepa_mod);
              if(prepa_mod!=1){
                $("#ejersub-mod").html('<option value="4">----</option>');
            $("#ejersub-mod").prop('disabled',true);
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"elemento="+$("#prepa-mod").val(),
            success: function(elemento){
              $("#ele-mod").html(elemento).val(ele_mod);
            }
          });}
          else{

          $("#ejersub-mod").prop('disabled',false);
          $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"idinputPreparatoriaEj="+$("#prepa-mod").val(),
            success: function(elemento){
              if(ele_mod==1 || ele_mod==2 || ele_mod==3|| ele_mod==4 || ele_mod==5 || ele_mod==6 || ele_mod==7)
              {
                $("#ejersub-mod").html(elemento).val(1);
              }
              if(ele_mod==8 || ele_mod==9 || ele_mod==10 || ele_mod==11  )
              {
                $("#ejersub-mod").html(elemento).val(2);
              }
              if(ele_mod==12 || ele_mod==13 )
              {
                $("#ejersub-mod").html(elemento).val(3);
              }

               $.ajax({
            url:"acciones_abm_ejer/llenado_selects.php",
            type: "POST",
            data:"sub="+$("#ejersub-mod").val(),
            success: function(elemento){
              $("#ele-mod").html(elemento).val(ele_mod);
            }
          })
            }
          })

            

          }
              $('#met-mod').val(metodo_mod);
              $('#tarea-mod').val(tarea_mod);
              $('#des-mod').val(desc_mod);
              var html4='<img src="acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200">'
              $('#mostrar-ima-mod').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
          function buscar_teclado2(){
            var n = $('#eliNombre').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            
              $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-2 col-sm-8" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th>Categoria</th><th>Preparaciones</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos2(this)"><td>'+resp[i].nombre+'</td><td>'+resp[i].categoria_sub+'</td><td>'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado-eli').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          function mostrar_datos2(f)
          {
              nom_eli = $(f).find('td:eq(0)').text();
              cate_eli = $(f).find('td:eq(1)').text();
              prepa_eli = $(f).find('td:eq(2)').text();
              ele_eli = $(f).find('td:eq(3)').text();
              des_eli = $(f).find('td:eq(4)').text();
              foto_eli = $(f).find('td:eq(5)').text();
              idej_eli = $(f).find('td:eq(6)').text();
              var html4='<img src="acciones_abm_ejer/'+foto_eli+'"  alt="..." class="img-rounded" width="200" heigth="200">'
              $('#mostrar-ima-eli').html(html4);
              
              $('#Nombre-eli').val(nom_eli);
              $('#Categoria-eli').val(cate_eli);
              $('#Preparaciones-eli').val(prepa_eli);
              $('#Elemento-eli').val(ele_eli);
              $('#Des-eli').val(des_eli);
              console.log(nom_eli+' '+cate_eli);
              
          }
      function modificar_ejercicio()
      {
                setTimeout("$('.ocultar').hide();", 5000);

        var input = $("<input>").attr("type", "hidden").attr("name", "opcion").val("modificar");
        var input2 = $("<input>").attr("type", "hidden").attr("name", "idejer").val(idej_mod);
        var input3 = $("<input>").attr("type", "hidden").attr("name", "foto-mod").val(foto_mod);//si ya tiene una foto seleccionada no la borrara
      $('#formModificar').append($(input));
      $('#formModificar').append($(input2));
      $('#formModificar').append($(input3));
      var formData = new FormData($("#formModificar")[0]);
          console.log(formData);
          $.ajax({
                type: $('#formModificar').attr('method'),
                url:'acciones_abm_ejer/ejercicio.php',
                data: formData,
                contentType: false,
                processData: false,
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              var html='<div class="alert alert-success ocultar" role="alert" center >Modificardo!</div>';
              var html2=imagen_defecto();
              $('#mostrar-ima-mod').html(html2);
              $("#formModificar")[0].reset();
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
            $('#resultado-mod').html(html);
            actualizar_tablas();
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
      }

     
           
           function mensaje2(q, t)
      { 
          if(t > 48 && t < 57)
          {
            $(q).parent().siblings('.btn').find('input').attr('disabled','disabled').off('click');
            //alert("hola");
            $(q).tooltip('show');
          }
          else{
                  $(q).tooltip('destroy');
            }
      }
      </script>
      
      
</head>
<body>
<?php 
      include("acciones_abm_ejer/llenado_selects.php");

?>
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

<!-- Contenedor Pestaña ABM Ejercicios -->
<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">Administracion de Ejercicios</div>
      <div class="panel-body">
        <!-- Pestaña ABM Ejercicios -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="javascript:;" role="tab" data-toggle="tab" data-target="#altaejercicio">Ingresar</a></li>
          <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#modejercicio">Modificar</a></li>
          <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#bajaejercicio">Eliminar</a></li>
        </ul>
        <!-- Contenido Pestaña ABM Ejercicios -->
        <div class="tab-content">
          <!-- Contenido Pestaña registrar ejercicio -->
          <div class="active tab-pane fade in" id="altaejercicio">
            <!-- FORM CREAR Ejercicios -->
            <h4>Ingresar nuevo ejercicio</h4>
            <form class="form-horizontal" id="formRegistro" method="POST" enctype="multipart/form-data">
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control soloL" id="nombre-reg" name="nombre-reg" placeholder="Nombre del ejercicio" required >
                </div>
              </div>
              <div class="row">
                <label class="col-sm-offset-1 col-sm-2 control-label">Categor&iacutea:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="cate-reg" name="cate-reg" required>
                    <?php echo $categoria; ?>                  
                  </select>
                </div>
                <label class=" col-sm-2 control-label">Preparaciones:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="prepa-reg" name="prepa-reg" required>
                    <?php echo $preparaciones; ?>                   
                  </select>
                </div>
              </div>
              <div class="row">
                <br>
                <label class="col-sm-offset-1 col-sm-2 control-label">Sub Ejercicio:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="ejersub-reg" name="ejersub-reg" >
                    <option></option>
                  </select>
                </div>
                <label class=" col-sm-2 control-label">Elemento Tecnico:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="ele-reg" name="ele-reg" required>
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="row">
                <br>
                <label class="col-sm-offset-1 col-sm-2 control-label">Metodo:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="met-reg" name="met-reg">
                    <option></option>
                    <option value="Analitico">Analitico</option>
                    <option value="Global">Global</option>
                  </select>
                </div>
                <label class=" col-sm-2 control-label">Tarea:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="tarea-reg" name="tarea-reg">
                    <option></option>
                    <option value="ataquevs def">Ataque vs Defensa</option>
                    <option value="Situacion de juego">Situacion de juego</option>
                    <option value="Posicion de balon">Posicion de balon</option>
                    <option value="Posecion de balon">Posecion de balon</option>
                    <option value="Rondo">Rondo</option>
                    <option value="Juegos de Aplicacion">Juegos de Aplicacion</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Descripci&oacuten:</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="4" type="text" class="form-control"  placeholder="Descripcion del Ejercicio" id="des-reg" name="des-reg" ></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Imagen Ejercicio:</label>
                <div class="col-sm-3" >
                  <div  id="mostrar-ima" name="mostrar-ima" class="img-rounded"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Subir imagen:</label>
                <label class=" control-label"></label>
                <div class="col-sm-3" >
                  <input type="file" id="abrir-ima" class="form-control-file col-xs-12" name="abrir-ima" value="ser">
                </div>
              </div>
              <script src="acciones_abm_ejer/mostrar_ima.js"></script>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-2 col-xs-6">
                  <button type="submit" class="btn btn-primary" onclick="javascript:Limpiar()">Limpiar</button>
                </div>
                <div class="col-sm-offset-2 col-sm-2 col-xs-6">
                  <button type="submit" class="btn btn-success" >Registrar</button>
                </div>
              </div>
              <div class="form-group" id="resultado"></div>
            </form>
            <!-- FIN FORM CREAR ejercicios -->
          </div>
          <!-- Fin Contenido Pestaña registrar ejercicios -->
          <!--  Contenido Pestaña modificar grupo -->
          <div class="tab-pane fade" id="modejercicio">
            <!-- FORM MODIFICAR Ejericios -->
            <h4>Modificar ejercicio</h4>
            <form class="form-horizontal" name="formModificar" id="formModificar" enctype="multipart/form-data" method="POST">
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label" >Nombre:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="modNombre" placeholder="Nombre de ejercicio" >
                </div>
                <div class="col-sm-2">
                <br>
                  <button type="button" class="btn btn-default ">
                    <span class="glyphicon glyphicon-search " aria-hidden="true"></span>
                    Buscar
                  </button>
                </div>
              </div>
              <!--tabla resultante-->
              <div class="form-group" id="resultado2">
      
              </div>
              <div>
                <center><h4>Datos del Ejercicio</h4></center>
              </div>
              <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="nombre-mod" name="nombre-mod" placeholder="Nombre Ejercicio" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Categor&iacutea:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="cate-mod" name="cate-mod" required>
                    <?php echo $categoria; ?>                   
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Preparaciones:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="prepa-mod" name="prepa-mod" required>
                    <?php echo $preparaciones; ?>                   
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Sub Ejercicio:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="ejersub-mod">

                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Elemento Tecnico:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="ele-mod" name="ele-mod" required>
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Metodo:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="met-mod" name="met-mod">
                    <option></option>
                    <option value="Analitico">Analitico</option>
                    <option value="Global">Global</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Tarea:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="tarea-mod" name="tarea-mod">
                    <option></option>
                    <option value="ataquevs def">Ataque vs Defensa</option>
                    <option value="Situacion de juego">Situacion de juego</option>
                    <option value="Posicion de balon">Posicion de balon</option>
                    <option value="Posecion de balon">Posecion de balon</option>
                    <option value="Rondo">Rondo</option>
                    <option value="Juegos de Aplicacion">Juegos de Aplicacion</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label ">Descripci&oacuten:</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="4" type="text" class="form-control" name="des-mod" id="des-mod" placeholder="Descripcion del Ejercicio" ></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Imagen Ejercicio:</label>
                <div class="col-sm-3" >
                  <div  id="mostrar-ima-mod" name="mostrar-ima-mod"></div>
        
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label">Subir imagen:</label>
                  <div class="col-sm-3">
                    <input type="file" id="abrir-ima-mod" class="form-control-file col-xs-12" name="abrir-ima-mod">
                  </div>
                </div>
                <script src="acciones_abm_ejer/mostrar_ima_mod.js"></script>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-2 col-xs-6">
                    <button type="submit" class="btn btn-primary" onclick="javascript:Limpiar()">Limpiar</button>
                  </div>
                  <div class="col-sm-offset-2 col-sm-2 col-xs-6">
                    <button type="submit" class="btn btn-success" >Modificar</button>
                  </div>
                </div>
                <div class="form-group" id="resultado-mod"></div>
              </form>
              <!-- FIN FORM MODIFICAR Ejericicios -->
            </div>
            <!--  Fin Contenido Pestaña modificar ejercicios -->
            <div class="tab-pane fade" id="bajaejercicio">
              <!-- FORM ELIMINAR Ejercicios -->
              <h4>Eliminar ejercicio</h4>
              <form class="form-horizontal" name="formEliminar" id="formEliminar">
              <br>
                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label" >Nombre:</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="eliNombre" id="eliNombre" placeholder="Nombre de ejercicio"  >
                  </div>
                  <div class="col-sm-2">
                  <br>
                    <button type="button" class="btn btn-default ">
                      <span class="glyphicon glyphicon-search " aria-hidden="true"></span>
                        Buscar
                    </button>
                  </div>
                </div>
                <div class="form-group" id="resultado-eli" name="resultado-eli">
          
                </div>
                <div>
                  <center><h4>Datos del Ejercicio</h4></center>
                </div>
                <br>
                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label">Imagen Ejercicio:</label>
                  <div class="col-sm-3" >
                    <div  id="mostrar-ima-eli" name="mostrar-ima-eli"></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="Nombre-eli" name="Nombre-eli" placeholder="Nombre " readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label">Categor&iacutea:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="Categoria-eli" name="Categoria-eli" placeholder="Categoria" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label">Preparaciones:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="Preparaciones-eli" name="Preparaciones-eli" placeholder="Preparacion" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label">Elementos Tec.:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="Elemento-eli" name="Elemento-eli" placeholder="Elemento Tec." readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputDescripcion" class="col-sm-offset-1 col-sm-2 control-label ">Descripci&oacuten:</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" rows="4" type="text" class="form-control" id="Des-eli" placeholder="Descripcion del Ejercicio"  readonly=""></textarea>
                  </div>
                </div>                 
                <!-- Boton Limpiar -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-2 col-xs-6">
                    <button type="button" class="btn btn-primary" onclick="javascript:Limpiar()" >Limpiar</button>
                  </div>
                  <!-- Boton eliminar -->
                  <div class="col-sm-offset-2 col-sm-2 col-xs-6">
                    <button type="button" class="eliminar btn btn-danger " data-toggle="modal" data-target="#myModalEliminarEjercicio">
                      Eliminar
                    </button>
                  </div>
                </div>
                <div class="form-group" id="resultado-men-eli"></div>
              </form>
              <!-- modal confirmar eliminacion de ejercicio -->
              <div class="modal fade" id="myModalEliminarEjercicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="post" action='' name="login_form">
                        <div class="form-group">
                        <br>
                          <label for="inputCI" class="col-sm-11">Seguro de eliminar este ejercicio?</label>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" onclick="javascript:eliminarDatos()" class="btn btn-success btn-sm" data-dismiss="modal">Eliminar</button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer" >
    
                    </div>
                  </div>
                </div>
              </div>
              <!-- FIN FORM ELIMINAR GRUPOS -->
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