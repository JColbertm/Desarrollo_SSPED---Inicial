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
              <input type="text" class="form-control" id="passact" placeholder="Password Actual" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-2 control-label">Nuevo Password:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="nuevopass" placeholder="Nuevo Password" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-offset-1 col-sm-2 control-label">Confirmar Password:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="confpass" placeholder="Confirmar Password" required>
            </div>
          </div>

        <div class="form-group">
          <div class="col-sm-offset-9 col-sm-2">
            <button id="btnregistro" type="submmit" class="btn btn-success">Cambiar</button>
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

