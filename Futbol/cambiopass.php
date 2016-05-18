<?php
@session_start();
  if (isset($_SESSION['id_en']))
  {
  
  }
  else
  {
    header('Location: /Desarrollo_SSPED/index.php');  
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var idcouch= <?php echo $_SESSION['id_en'];?>;
        $('#btncambio').on('click', function()
        {
          verfifica_pass($('#passact').val(), $('#nuevopass').val(), $('#confpass').val());
        });
      });

      function verfifica_pass(pass, nuevo, conf){
        setTimeout("$('.ocultar').hide();", 3000);
         var id = "datos=" +encodeURIComponent(pass) ;
          id += "&opcion=" + encodeURIComponent('verifica');
          id += "&ide=" + encodeURIComponent(<?php echo $_SESSION['id_en']?>);
          console.log(id);
          $.ajax({
            url: 'perfil.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp);
            var t= resp.res; 
            if(t==1)
            {
              if(nuevo == conf)
              {
                cambiar_pass(nuevo, conf);
              }
              else
              {
                var nota1 ='<div class="alert alert-danger ocultar" role="alert"> Los passwords no coinciden</div>';    
              }
            }
            else
            {
              var nota ='<div class="alert alert-danger ocultar" role="alert"> Password actual incorrecto</div>'; 
            }
            $('#nota').html(nota);
            $('#nota1').html(nota1);
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
      }

      function cambiar_pass(nuevo)
      {
         var id = "nuevopass=" +encodeURIComponent(nuevo) ;
          id += "&opcion=" + encodeURIComponent('cambiar');
          id += "&ide=" + encodeURIComponent(<?php echo $_SESSION['id_en']?>);
          console.log(id);
          $.ajax({
            url: 'perfil.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp);
            var t= resp.resp; 
            if(t==1)
            {
              var nota ='<div class="alert alert-success ocultar" role="alert"> Password Actualizado!</div>'; 
              $('#passact').val("");
              $('#nuevopass').val(""); 
              $('#confpass').val("");
            }
            $('#nota').html(nota);
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
      }
    </script>
</head>
<body>
  <!--  LLAMADO A LA CABECERA -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera1.php";
 	?>
  <!--  LLAMADO A LA BARRA DE MENU -->
  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenureg.php";
  ?>
  
  <!--  LLAMADA A LA LISTA DE BOTONES "MENU" -->
  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listabotones1.php";
  ?>
  <!--  menu de deportes existentes -->
 	<div class="col-sm-7 col-xs-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        Cambio de Password
      </div>
      <div class="panel-body">
        <h4>Password</h4>
        <br>
        <form class="form-horizontal">
         
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-2 control-label">Password Actual:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="passact" placeholder="Password Actual" required>
            </div>
          </div>
          <div id="nota" class="row">
            
          </div>
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-2 control-label">Nuevo Password:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="nuevopass" placeholder="Nuevo Password" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-2 control-label">Confirmar Password:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="confpass" placeholder="Confirmar Password" required>
            </div>
          </div>
          <div id="nota1" class="row">
            
          </div>
        <div class="form-group">
          <div class="col-sm-offset-9 col-sm-2">
            <button id="btncambio" type="button" class="btn btn-success">Cambiar</button>
          </div>
        </div>
        </form>
      </div>
  </div>

 	  
 	</div>
  <!--  llamada al pie de pagina -->
 	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
 	?>
</body>
</html>

