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
    <link href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript">
    	$(document).ready(function() {

    		$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		
    		muestra_equipo();
    		muestra_planes();

        $('#cierre_sesion').on('click', function()
          {
            cerrar_sesion();            
          });

    	})

      function cerrar_sesion()
        {          
          var id = "opcion=" + encodeURIComponent('cierra_sesion');
          console.log(id);
          $.ajax({
            url: '/Desarrollo_SSPED/entrenador.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            if(resp.res==1)
            {
              window.location="/Desarrollo_SSPED/index.php"; 
            }
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();          
        }


    	function muestra_equipo()
    	{
    		var opc = 'equipo';    
      		$.ajax({
            	url: 'perfil.php',
            	type: 'POST',
            	data: {opcion: opc}
          	})
          	.done(function(data) {
          		var resp = $.parseJSON(data);
	            console.log(resp);
    	        var html = '<table class="table">'+
  								'<thead>'+
  									'<tr>'+
  										'<th>'+
  											'Nro.'+
  										'</th>'+
  										'<th>'+
  											'Equipo'+
  										'</th>'+
  									'</tr>'+
  								'</thead>'+
  								'<tbody>';

				var num = 0; 								
            	for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {	
                    	num += 1;
                    	html += '<tr>'+
                    				'<td>'+
                    					num+
                    				'</td>'+
                    				'<td>'+
                    					resp[i].equipo+
                    				'</td>'+
                    			'</tr>';
                    }

                  }
                  
		 	html+='</tbody>'+	
		 		'</table>';                                                
			$('#equipos').html(html);
			console.log(html);
           
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
                	
    	}
     	
     	function muestra_planes()
    	{
    		var opc = 'planes';    
      		$.ajax({
            	url: 'perfil.php',
            	type: 'POST',
            	data: {opcion: opc}
          	})
          	.done(function(data) {
          		var resp = $.parseJSON(data);
	            console.log(resp);
    	        var html1 = '<table class="table">'+
  								'<thead>'+
  									'<tr>'+
  										'<th>'+
  											'Nro.'+
  										'</th>'+
  										'<th>'+
  											'Nombre_Plan'+
  										'</th>'+
  									'</tr>'+
  								'</thead>'+
  								'<tbody>';

				var num1 = 0; 								
            	for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {	
                    	num1 += 1;
                    	html1 += '<tr>'+
                    				'<td>'+
                    					num1+
                    				'</td>'+
                    				'<td>'+
                    					resp[i].nombre_plan+
                    				'</td>'+
                    			'</tr>';
                    }

                  }
                  
		 	html1+='</tbody>'+	
		 		'</table>';                                                
			$('#planes').html(html1);
			console.log(html1);
           
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
                	
    	}

    </script>
</head>
<body>
<!--  llamada a la cabecera -->
	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/cabecera1.php";
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
 		<h2>Bienvenido<i class="fa fa-exclamation" aria-hidden="true"></i> <?php echo $_SESSION['nombre'].' '.$_SESSION['apellido']?> </h2>
 		<br>
 		<div class="row">
 			<div class="col-sm-offset-2 col-sm-4">
 				<div class="panel panel-default">
				  	<div class="panel-heading">
				  		<i class="fa fa-users" aria-hidden="true"></i> Mis Equipos 
				  	</div>
					<div class="panel-body" id="equipos">
				    	
			  		</div>
				</div>
		
 			</div>
 			<div class="col-sm-4">
 				<div class="panel panel-default">
				  	<div class="panel-heading">
				  		<i class="fa fa-files-o" aria-hidden="true"></i> Mis Planificaciones
				  	</div>
					<div class="panel-body" id="planes">
				    	
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

