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

    	})
     
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

<!--  bienvenida al usuario nueva entrada -->
	<div class="col-sm-8 col-xs-12">
 		<div class="jumbotron">
			<h2>Bienvenido</h2>
			<p><h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem fugit, saepe, impedit exercitationem ipsum aliquid est numquam, fuga illum quia ipsa! Molestiae officiis dolore aspernatur laborum. Repellendus sit, magnam beatae?
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod a, beatae eaque alias. Sunt autem beatae rem repellat est, laborum neque corrupti. Illum modi iure ipsam mollitia asperiores quas magnam?<br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita illum esse nostrum vel accusantium, reiciendis aliquid tempore in quaerat doloremque. Explicabo eligendi ducimus ullam corrupti neque cupiditate quaerat quibusdam ex!</h5></p>
		</div>	
 	</div>


<!--  llamada al pie de pagina -->
 	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
 	?>
</body>
</html>

