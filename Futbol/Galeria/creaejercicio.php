	<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
  	<script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery3.js"></script>
  	<script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery4.js"></script>
    <script type="text/javascript">

    	$(document).ready(function() {
    		 
    		$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
			$(".radio input[name='optionsRadios']").on('click',  select_img)

			$( ".img" ).draggable();

			$( ".droppable" ).droppable();

			var clon = $("#img-cono1").clone();

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
     
    </script>
    <style type="text/css"> 
		#componentes { 
		overflow-y: scroll;
		height: 600px } 
	</style> 
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
    			<div class="col-xs-8" id="imagen">
    			
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
						<h4><b>Conos</b></h4>	
						<div class="row">
							<div class="col-xs-6" id="cono1">  			
					    		<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono.png" class="img-rounded img" id="img-cono1" width="30%">
		    				</div>	
		    				<div class="col-xs-6">  			
		    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono1.png" class="img-rounded img"  width="30%">
		    				</div>
						</div>
						<hr>
						<h4><b>Escaleras</b></h4>
						<div class="row">
				  			<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalera.jpg" class="img-rounded img" width="45%">
				    		</div>	
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalerahor.jpg" class="img-rounded img" width="40%">
				    		</div>	
				  		</div>    
						<hr>
						<h4><b>Banderines</b></h4>
						<div class="row">
				  			<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/banderin.png" class="img-rounded img" width="30%">
							</div>	
		    				<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/banderin.png" class="img-rounded img" width="30%">
				   			</div>	
						</div>
						<hr>
						<h4><b>Equipos</b></h4>
						<div class="row">
				    		<div class="col-xs-6">  			
				   				<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/polera1.png" class="img-rounded img" width="35%">
			 				</div>		
			    			<div class="col-xs-6">  			
			    				<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/polera1.png" class="img-rounded img" width="35%">
		    				</div>
		    			</div>
		    			<br>	
		    			<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/punto2.png" class="img-rounded img" width="30%">
				    		</div>		
				    		<div class="col-xs-6">  			
				  				<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/punto2.png" class="img-rounded img" width="30%">
				   			</div>	
				   		</div>
		    			<hr>
		    			<h4><b>Vallas</b></h4>
		    			<div class="row">
		    				<div class="col-xs-6">  			
		    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/valla1.png" class="img-rounded img" width="40%">
		    				</div>	
		    				<div class="col-xs-6">  			
		    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/valla2.jpg" class="img-rounded img" width="40%">
		    				</div>	
		    			</div>
		    			<hr>
		    			<h4><b>Porterias</b></h4>
		    			<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco1.png" class="img-rounded img" width="50%">
				    		</div>		
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco2.png" class="img-rounded img" width="50%">
				    		</div>
				    	</div>
				    	<br>
				    	<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco3.png" class="img-rounded img" width="50%">
				    		</div>		
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco4.png" class="img-rounded img" width="50%">
				    		</div>
				    	</div>
				    	<hr>
				    	<h4><b>Balones</b></h4>
				    	<div class="row">
				    		<div class="col-xs-6">  			
				   				<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="20%">
			 				</div>		
		    				<div class="col-xs-6">  			
		    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="20%">
		    				</div>		
		    			</div>
		    			<br>
		    			<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pelota4.png" class="img-rounded img" width="25%">
				    		</div>	
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pelota5.png" class="img-rounded img" width="30%">
				    		</div>	
				    	</div>
		    			<hr>
		    			<h4><b>Trazos</b></h4>
						<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pelota4.png" class="img-rounded img" width="30%">
				    		</div>	
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pelota5.png" class="img-rounded img" width="30%">
				    		</div>	
				    	</div>
				    	<br>
				    	<div class="row">
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    		</div>	
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    		</div>	
				    	</div>		    
			  		</div>	 		
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

