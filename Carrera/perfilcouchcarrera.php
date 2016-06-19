<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
     
    </script>
</head>
<body>
  <!--  LLAMADO A LA CABECERA -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera2.php";
 	?>
  <!--  LLAMADO A LA BARRA DE MENU -->
  <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenureg.php";
  ?>
  
  <!--  LLAMADA A LA LISTA DE BOTONES "MENU" -->
  <?php 
    
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
              <input type="text" class="form-control" id="nombrecoach" placeholder="Juan" readonly="">
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

          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Password:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="passwordcoach" placeholder="**********" readonly="">
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-xs-offset-1 col-sm-2 control-label">Confirmar Password:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="password2coach" placeholder="**********" readonly="">
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

