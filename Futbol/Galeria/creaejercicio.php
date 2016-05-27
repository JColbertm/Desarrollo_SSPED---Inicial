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

			$( ".img" ).draggable();

			/*$( "#droppable" ).droppable({
				drop: function( event, ui ) {
					var ji ='<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono.png" class="img-rounded img" width="50px">';
				$( this )
          			.addClass( "ui-state-highlight" )
          			.find( "#droppable" )
            		.html(ji);
            		console.log("hecho");
            	}
			});*/
			var picture = 0;
			$('#btn_cono').on('click', function(){

        		eval("var total" + picture + " = " + $("#cono1").clone());

				$('#contenido').html(eval("var total"+picture));
				picture +=1;
				console.log('clonado');
			})


    	})
    	function select_img() 
    	{
    		if($('input:radio[id=optionsRadios1]:checked').val() == 1)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cancha-entera.png"  alt="Cancha Entera" class="img-rounded" width="100%">'}
    		if($('input:radio[id=optionsRadios2]:checked').val() == 2)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/media-cancha1.jpg"  alt="Media Cancha" class="img-rounded" width="100%">'}
    		if($('input:radio[id=optionsRadios3]:checked').val() == 3)
    		{var img = '<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/rectangulo.jpg"  alt="Espacio Reducido" class="img-rounded" width="100%">'}
	
	 		$('#imagen').html(img);  
    	}  

    	//Inicio funcion para caputar la imagen del ejercicio
    	function genScreenshot() {
				html2canvas($("#droppable"), {
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
    					Capturar
    				</span>
    				</a>
    				<a id="test"></a>
    			</div>
    			<div class="col-xs-8" id="droppable" class="ui-widget-header">    			
    				<div class="col-xs-12 img" id="contenido">
    					
    				</div>
    				<div class="col-xs-12" id="imagen">
    					
    				</div>
    			</div>
				<div class="panel panel-default col-xs-4 ui-widget-content movimiento"  id="material">
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
						<div class="row" id="conos">
							<div class="col-xs-6"> 
								<button class="btn" id="btn_cono" name="btn_cono" type="button">
					    		<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono.png" class="img-rounded img" width="15px" name="cono1" id="cono1">
					    		</button> 			
		    				</div>	
		    				<div class="col-xs-6">  			
		    					<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/cono1.png" class="img-rounded img"  width="15px">
		    				</div>
						</div>
						<h4><b>Escaleras</b></h4>
						<div class="row">
				  			<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalera.jpg" class="img-rounded img" width="65%">
				    		</div>	
				    		<div class="col-xs-6">  			
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/escalerahor.jpg" class="img-rounded img" width="60%">
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
				    			<img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/flecha.png" class="img-rounded img" width="30%">
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

