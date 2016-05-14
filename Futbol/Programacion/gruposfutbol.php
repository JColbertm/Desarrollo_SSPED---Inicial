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
          $('.soloL').keydown(function(e){  
            mensaje2($(this),e.keyCode);
          })
          //evento al cambiar de tabla limpia modificar
          $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
             limpiarR();
             limpiarM();
             limpiarE();
             listar();
            listar2();

          });
          $('#formRegistro').on('submit', registro_grupos)
          $('#modNombre').on('keyup', buscar_teclado)
          $('#EliNombre').on('keyup', buscar_teclado2)
          $('#formModificar').on('submit', modificar_grupos)
          $('#modificacion').on('click', eliminar_grupos)
          $('#limpiarRe').on('click', limpiarR)
          $('#limpiarMo').on('click', limpiarM)
          listar();
          listar2();
          
      });
      function registro_grupos()
      {
          setTimeout("$('.ocultar').hide();", 5000);
          var datos= $('#formRegistro').serialize();
          datos += "&opcion=" + encodeURIComponent('registrar');
          console.log(datos);
          $.ajax({
            url: 'grupos.php',
            type: $('#formRegistro').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            //console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              //limpiamos los input del form 
              limpiarR();
              var html='<div  class="alert alert-success ocultar" role="alert"> Equipo agregado!</div>'; 
            }
            else{
              var html='<div  class="alert alert-danger ocultar" role="alert"> No se pudo agregar</div>'; 
            }
            $('#resultado').html(html);      
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
      function limpiarR()
      {
         
         $('#inputNombreR').val('');
         $('#id_categoria').val(0);
      }
      function limpiarE()
      {
         $('#EliNombre').val('');
         $('#elimNombre').val('');
         $('#elimCategoria').val('');
      }

      function modificar_grupos()
      {
        setTimeout("$('.ocultar').hide();", 5000);

          var datos= $('#formModificar').serialize();
          datos += "&idGrupo=" + encodeURIComponent(idg)+"&idcat=" + encodeURIComponent(idc)+"&opcion=" + encodeURIComponent('modificar');
          console.log(datos);
          $.ajax({
            url: 'grupos.php',
            type: $('#formModificar').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
           // console.log(data);
            //console.log(resp);
            var t= resp.resp;
            console.log(t);
            if(t==1)
            {
              //limpiesa del form
              limpiarM();
              listar();
              listar2();
              $('#modNombre').val('');
              var html='<div class="alert alert-success ocultar" role="alert"> Equipo modificado!</div>';

            }
            $('#resultado3').html(html);      
          })
          .fail(function() {
            console.log("error");
          })
          
          event.preventDefault();
        
      }
       function listar()
      {
          //setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'grupos.php',
            type: 'POST',
            data: {opcion: 'listar'}
          })
          .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th width=1 style="visibility:hidden; ">G</th><th width=1 style="visibility:hidden;">i</th><th style="visibility:hidden; " width=1>i</th><th >Equipo</th><th >Categoria</th></tr></thead><tbody>';
                 

                  for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {

                    html+='<tr onclick="mostrar_datos(this)"><td width=1 style="visibility:hidden;">'+resp[i].idGrupo+'</td><td width=1 style="visibility:hidden;">'+resp[i].idCategoria1+'</td><td style="visibility:hidden;" width=1>'+resp[i].idCategoria+'</td><td >'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';
                    }
                  }
                  
                html+= '</tbody></table></div>';

                $('#resultado2').html(html);

              })
          .fail(function() {
            console.log("error");
          })
          
        
      }
      function listar2()
      {
          //setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'grupos.php',
            type: 'POST',
            data: {opcion: 'listar'}
          })
          .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th width=1 style="visibility:hidden; ">G</th><th width=1 style="visibility:hidden;">i</th><th style="visibility:hidden; " width=1>i</th><th >Equipo</th><th >Categoria</th></tr></thead><tbody>';
                  for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {

                    html+='<tr onclick="mostrar_datos2(this)"><td width=1 style="visibility:hidden;" >'+resp[i].idGrupo+'</td><td width=1 style="visibility:hidden;">'+resp[i].idCategoria1+'</td><td style="visibility:hidden;" width=1>'+resp[i].idCategoria+'</td><td >'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';
                    }
                  }
                  
                html+= '</tbody></table></div>';

                $('#resultado5').html(html);

              })
          .fail(function() {
            console.log("error");
          })
          
        
      }
      function limpiarM()
      {
         $('#modNombre').val('');
         $('#modCategoria').val(0);
         $('#modNombre2').val('');
      }
      function eliminar_grupos()
      {
          //var datos = "&idGrupo=" + encodeURIComponent(idg2)+"&opcion=" + encodeURIComponent('eliminar');
          //console.log(datos);
          setTimeout("$('.ocultar').hide();", 5000);
          $.ajax({
            url: 'grupos.php',
            type: 'POST',
            data: {idGrupo: idg2, opcion: 'eliminar'}
          })
          .done(function(data) {
             var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              $('#elimNombre').val('');
              limpiarE();
              listar();
              listar2();
              var html='<div class="alert alert-success ocultar" id="alertaE" role="alert">Eliminado!</div>'; 
            }

            $('#resultado6').html(html);  
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }
      //funcion para buscar pesta;a modificar
      function buscar_teclado(){
            var n = $('#modNombre').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            setTimeout("$('.ocultar').hide();", 5000);
              $.ajax({
                url: 'grupos.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th width=1 style="visibility:hidden; ">G</th><th width=1 style="visibility:hidden;">i</th><th style="visibility:hidden; " width=1>i</th><th>Equipo</th><th >Categoria</th></tr></thead><tbody>';
                 

                  for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {

                    html+='<tr onclick="mostrar_datos(this)"><td width="2" style="visibility:hidden;" width=1>'+resp[i].idGrupo+'</td><td width=1 style="visibility:hidden;">'+resp[i].idCategoria1+'</td><td style="visibility:hidden;" width=1>'+resp[i].idCategoria+'</td><td>'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';
                    }
                  }
                  
                html+= '</tbody></table></div>';

                $('#resultado2').html(html);

              })
            .fail(function() {
                console.log("error");
            })
             
          }
          //busca por nombre de equipo para dar de baja
          function buscar_teclado2(){
            var n = $('#EliNombre').val();
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
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive col-sm-offset-1 col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th style="visibility:hidden;" width=1>E</th><th>Equipo</th><th>Categoria</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {
                    html+='<tr onclick="mostrar_datos2(this)"><td style="visibility:hidden;" width=1>'+resp[i].idGrupo+'</td><td>'+resp[i].nombre_gru+'</td><td>'+resp[i].categoria_sub+'</td></tr>';
                  }
                }
                  html+= '</tbody></table></div>';

                  $('#resultado5').html(html);

              })
              .fail(function() {
                console.log("error");
              })
             
          }
          //obtener valores al hacer click
      var idg;
      var idg2;
      var idc;
      function mostrar_datos(f)
          {
              idg= $(f).find('td:eq(0)').text();
              idc = $(f).find('td:eq(1)').text();
              row= $(f).find('td:eq(2)').text();
              row2 = $(f).find('td:eq(3)').text();
              row3 = $(f).find('td:eq(4)').text();
              $('#modNombre2').val(row2);
              $('#modCategoria').val(row);
              console.log(idg+' '+idc);
              
          }
          function mostrar_datos2(f)
          {
              
              row= $(f).find('td:eq(0)').text();
              row2 = $(f).find('td:eq(3)').text();
              row3 = $(f).find('td:eq(4)').text();
              $('#elimNombre').val(row2);
              $('#elimCategoria').val(row3);
              idg2 = row;
              console.log(idg2);
              
          }

      function justNumbers(e)
      {elimNombre
           var keynum = window.event ? window.event.keyCode : e.which;
           if ((keynum == 8) || (keynum == 46))
                return true;
            return /\d/.test(String.fromCharCode(keynum));
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

<!-- Contenedor Pestaña ABM GRUPOS -->
  <div class="col-xs-12 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-heading">Administracion de equipos</div>
        <div class="panel-body">

          <!-- Pestaña ABM GRUPOS -->

          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-first">Registrar</a></li>
            <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-second">Modificar</a></li>
            <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-third">Eliminar</a></li>
          </ul>
          <!-- Contenido Pestaña ABM GRUPOS -->
          <div class="tab-content">
          <!-- Contenido Pestaña registrar grupo -->
          <div class="active tab-pane fade in" id="tabs-first">
            
          <!-- FORM CREAR GRUPOS -->
          <h4>Registrar nuevo equipo</h4>

          <form class="form-horizontal" id="formRegistro" method="POST">  
          <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label" >Nombre:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control soloL" id="inputNombreR" name="inputNombreR" placeholder="Nombre del equipo"  required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Categoria:</label>
                <div class="col-sm-3">
                  <select class="form-control" name="id_categoria" id="id_categoria">
                   
                    <option value="1">Sub 5</option>
                    <option value="2">Sub 7</option>
                    <option value="3">Sub 9</option>
                    <option value="4">Sub 11</option>
                    <option value="5">Sub 13</option>
                    <option value="6">Sub 15</option>
                    <option value="7">Preprofesional</option>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10 col-xs-3">
                  <button type="button" id="limpiarRe" class="btn btn-primary">Limpiar</button>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-9 col-sm-2 col-xs-3">
                  <button type="submit" class="btn btn-success">Registrar</button>
                </div>
              </div>

              <div class="form-group" id="resultado">
              </div>
            </form>
   <!-- FIN FORM CREAR GRUPOS -->
          </div>
<!-- Fin Contenido Pestaña registrar grupo -->

<!--  Contenido Pestaña modificar grupo -->

           <div class="tab-pane fade" id="tabs-second">
            <!-- FORM MODIFICAR GRUPOS -->
          <h4>Modificar Equipo</h4>
          <form class="form-horizontal" id="formModificar" method="POST">
            <br>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label" id="buscarMod1">Nombre:</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="modNombre" name="modNombre" placeholder="Nombre de equipo" >
              </div>
              <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                       Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>
                 
              </div>
            </div>

       <!--    <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 col-xs-12">
                <label class="radio-inline" >
                  <input type="radio" name="inlineRadioOptionsMod" id="inlineRadio1" value="option1"  checked="">Equipo
                  </label>
                  <label class="radio-inline">
                  <input type="radio" name="inlineRadioOptionsMod" id="inlineRadio2" value="option2">Categoria
                </label>
            </div>
          </div>-->
            
              <!--tabla resultante-->
              <div class="form-group" id="resultado2">    
              </div>        

            <div>
              <center><h4>Datos del Equipo</h4></center>
            </div>
            
            <br>
            <div class="form-group">
              <label for="inputNombre" class="col-xs-offset-1 col-xs-3 control-label">Nombre:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="modNombre2" name="modNombre2" placeholder="Nombre del equipo">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                <div class="col-sm-5">
                  <select class="form-control" id="modCategoria" name="modCategoria">
                    <option value="1">Sub 5</option>
                    <option value="2">Sub 7</option>
                    <option value="3">Sub 9</option>
                    <option value="4">Sub 11</option>
                    <option value="5">Sub 13</option>
                    <option value="6">Sub 15</option>
                    <option value="7">Preprofesional</option>
                  </select>
                </div>
              </div>            

            <div class="form-group" id="resultado3">
                
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10 col-xs-3">
                <button type="button" class="btn btn-primary" id="limpiarMo">Limpiar</button>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-9 col-sm-2 col-xs-3">
                <button type="submit" class="btn btn-success">Modificar</button>
              </div>
            </div>
          </form>
          <!-- FIN FORM MODIFICAR GRUPOS -->
        </div>
<!--  Fin Contenido Pestaña modificar grupo -->

        <div class="tab-pane fade" id="tabs-third">

  <!-- FORM ELIMINAR GRUPOS -->
        <h4>Eliminar equipo</h4>
          <form class="form-horizontal" name="formEliminar" method="POST">
          <br>
           <div class="form-group">
             <label for="inputNombre" class="col-sm-offset-1 col-sm-2 control-label" id="label"> Equipo:  </label>
             <div class="col-sm-6">
                <input type="text" class="form-control" id="EliNombre" name="EliNombre" placeholder="Nombre de equipo">
              </div>

            <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                       Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>
                 
              </div>
          </div>


        <!-- Tabla de resultados -->

           <div class="form-group" id="resultado5">                       
           </div>

          <div>
            <center><h4>Datos del Equipo</h4></center>
          </div>
        <!-- textbox -->
            <br>
            <div class="form-group">
              <label for="inputNombre" class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="elimNombre" name="elimNombre" placeholder="Nombre de equipo" readonly="">
              </div>
            </div>
          <div class="form-group">
            <label for="inputCategoria" class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" id="elimCategoria" name"elimCategoria" placeholder="Categoria" readonly="">
            </div>
          </div>

        <!-- Boton eliminar -->

        <div class="form-group">
          <div class="col-sm-offset-9 col-sm-2">
            <button type="button" class="eliminar btn btn-danger " data-toggle="modal"  data-target="#myModalEliminarGrupo">
            Eliminar
            </button>
          </div>
        </div>

        <!-- Formulario modal2n -->

         <div class="modal fade" id="myModalEliminarGrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
              </div>
                   
              <div class="modal-body">
                <form class="form-horizontal" method="POST" id="elimifinal" >
                  <div class="form-group">
                    <label class=" col-xs-offset-1 col-xs-10">Seguro de eliminar este Equipo?</label>
                  </div>

                  <div class="form-group" id="resultado6">                       
                  </div>
              
                  <div class="form-group">
                    <div class="col-xs-offset-1 col-xs-7">
                      <button type="button" id="modificacion" class="btn btn-success btn-sm">Eliminar</button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
        </div>
      </div>

      </form>

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