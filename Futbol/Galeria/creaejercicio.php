	<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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

 <!--  llamada a menu de opciones futbol -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listabotones1.php";
 	?>

<!--  bienvenida al usuario nueva entrada -->
	<div class="col-xs-8 col-sm-7">
	
		<div class="panel panel-default ui-widget-content" >
  			<div class="panel-heading">
  				Creacion de Ejercicio
  			</div>
  			<div class="panel-body">
    			<div class="col-xs-12" id="componentes">
    				<div class="col-xs-8" id="imagen">
    					
    				</div>
					<div class="panel panel-default col-xs-4"  >
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

						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          <h5>Conos</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						      <div class="panel-body">
						        	<div class="row">
					  					<div class="col-xs-6" id="cono1">  			
					    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono.png" class="img-rounded img" id="img-cono1" width="40%">
					    				</div>	
					    				<div class="col-xs-6">  			
					    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono1.png" class="img-rounded img"  width="40%">
					    				</div>
					  				</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingTwo">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#escaleras" aria-expanded="false" aria-controls="escaleras">
						          <h5>Escaleras</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="escaleras" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="panel-body">
						        <div class="row">
				  					<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalera.jpg" class="img-rounded img" width="60%">
				    				</div>	
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalera.jpg" class="img-rounded img" width="60%">
				    				</div>	
				  				</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingTwo">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#banderin" aria-expanded="false" aria-controls="banderin">
						          <h5>Banderines</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="banderin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="panel-body">
						        <div class="row">
				  					<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/banderin.png" class="img-rounded img" width="50%">
				    				</div>	
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/banderin.png" class="img-rounded img" width="50%">
				    				</div>	
				  				</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#equipos" aria-expanded="false" aria-controls="equipos">
						          <h5>Equipos</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="equipos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
						      	<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/polera1.png" class="img-rounded img" width="50%">
				    				</div>		
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/polera1.png" class="img-rounded img" width="50%">
				    				</div>	
				    			</div>
				    			<br>
				    			<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/punto2.png" class="img-rounded img" width="50%">
				    				</div>		
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/punto2.png" class="img-rounded img" width="50%">
				    				</div>	
				    			</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#vallas" aria-expanded="false" aria-controls="vallas">
						          <h5>Vallas</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="vallas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
						      	<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/valla1.png" class="img-rounded img" width="50%">
				    				</div>	
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/valla2.jpg" class="img-rounded img" width="50%">
				    				</div>	
				    			</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#porterias" aria-expanded="false" aria-controls="porterias">
						          <h5>Porterias</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="porterias" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
						      	<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco1.png" class="img-rounded img" width="50%">
				    				</div>		
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/arco1.png" class="img-rounded img" width="50%">
				    				</div>
				    			</div>
						      </div>
						    </div>
						  </div>
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#balones" aria-expanded="false" aria-controls="balones">
						          <h5>Balones</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="balones" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
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
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingThree">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#trazos" aria-expanded="false" aria-controls="trazos">
						          <h5>Trazos</h5>
						        </a>
						      </h4>
						    </div>
						    <div id="trazos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						      <div class="panel-body">
						      	<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    				</div>	
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    				</div>	
				    			</div>
				    			<br>
				    			<div class="row">
				    				<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    				</div>	<div class="col-xs-6">  			
				    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/balon.png" class="img-rounded img" width="30%">
				    				</div>	
				    			</div>
						      </div>
						    </div>
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

