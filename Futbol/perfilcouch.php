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
        llenar_datos(idcouch);
      });

      function llenar_datos(idcouch){
        var id = "ide=" +encodeURIComponent(idcouch) ;
            id += "&opcion=" + encodeURIComponent('incluye');
          $.ajax({
            url: 'perfil.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp);
            if(resp.res == 1)
            {
              $('#nombrecoach').val(resp.nom);
              $('#apellidopcoach').val(resp.app);
              $('#apellidomcoach').val(resp.apm);
              $('#fechanacimiento').val(resp.fecha);
              $('#carnet').val(resp.ci);
              $('#telefono').val(resp.fono);
              $('#mailcoach').val(resp.mail);
            }
            else
            {

            }
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
 	<div class="col-xs-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        Perfil del Entrenador
      </div>
      <div class="panel-body">
        <h4>Datos del Entrenador</h4>
        <br>
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="nombrecoach" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Apellido P.:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="apellidopcoach" placeholder="Perez" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Apellido M.:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="apellidomcoach" placeholder="Lopez" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Fecha de Nac.:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="fechanacimiento" placeholder="fecha nacimiento" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Carnet:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="carnet" placeholder="6482974" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Telefono:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="telefono" placeholder="78595241" readonly="">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Correo:</label>
            <div class="col-sm-7">
              <input type="email" class="form-control" id="mailcoach" placeholder="juan.perez@ejemplo.com" readonly="">
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

