	<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
	<link rel="stylesheet" href="/Desarrollo_SSPED/Futbol/Galeria/estilo_creacion.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
  	<script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery3.js"></script>
  	<script src="/Desarrollo_SSPED/Futbol/Galeria/html2canvas.js"></script>
  	<script src="/Desarrollo_SSPED/Futbol/Galeria/promise.min.js"></script>
  	<script src="/Desarrollo_SSPED/Futbol/Galeria/interact.min.js"></script>
  	<script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery4.js"></script>
    <script type="text/javascript">

    	$(document).ready(function() {
    		 
    		$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
			$(".radio input[name='optionsRadios']").on('click',  select_img)

			//$( ".img" ).draggable();

			//$( ".droppable" ).droppable();

    	})
    	function select_img()
    	{
    		if($('input:radio[id=optionsRadios1]:checked').val() == 1)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cancha-entera.jpg"  alt="Cancha Entera" class="img-rounded ui-widget-header" width="100%">'}
    		if($('input:radio[id=optionsRadios2]:checked').val() == 2)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/media-cancha1.jpg"  alt="Media Cancha" class="img-rounded" width="100%">'}
    		if($('input:radio[id=optionsRadios3]:checked').val() == 3)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/rectangulo.jpg"  alt="Espacio Reducido" class="img-rounded" width="100%">'}
	
	 		$('#imagen').html(img);  
    	}  

    	//Inicio funcion para caputar la imagen del ejercicio
    	function genScreenshot() {
				html2canvas($("#imagen"), {
			    onrendered: function(canvas) {			      
			    if (navigator.userAgent.indexOf("MSIE ") > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) 
					{	
				     	var blob = canvas.msToBlob();
				        window.navigator.msSaveBlob(blob,'Ejercicio.jpeg');
			    	}
			    else 
			    	{
				        $('#test').attr('href', canvas.toDataURL("image/jpeg"));
				        $('#test').attr('download','Ejercicio.jpeg');
				        $('#test')[0].click();
			    	}  	
			     }
			    });
			};	
		//Fin de la funcion para capturar imagen 
     
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
<div class="col-xs-12 col-sm-8">
	<div class="panel panel-default ui-widget-content" >
  		<div class="panel-heading">
  			Creacion de Ejercicio
  		</div>
  		<div class="panel-body">
    		<div class="col-xs-12" id="componentes">
    			<a class="test"></a>
    			<div class="col-xs-8">
    				<a href="javascript:genScreenshot()" class="btn btn-info">
    				<span class="glyphicon glyphicon-import" aria-hidden="true"></span> 
    				<span class="hidden-xs">
    					Caputrar
    				</span>
    				</a>
    				<a id="test"></a>
    			</div>
    			<div class="droppable col-xs-8" id="imagen" ondrop="drop(event)" ondragover="allowDrop(event)">    			
    					
    			</div>
				<div class="panel panel-default col-xs-4"  id="material">
			  		<div class="panel-heading">
			  				Componentes
			  			</div>
			  			<div class="panel-body">

						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" >
						    Cancha Entera
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios2" value="2" >
						    Media Cancha
						  </label>
						</div>
						<div class="radio">
						  <label>
						    <input type="radio" name="optionsRadios" id="optionsRadios3" value="3" >
						    Espacio Reducido
						  </label>
						</div>
						<hr>
	 		
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

