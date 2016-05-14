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
	
	$('#form-ver').on('submit', ver_check)
	var html1=verdatos()
	$('#resultado').html(html1);

    	})
     function verdatos(){
 		
			o = "&opcion=" + encodeURIComponent('tabla_llena');
            console.log(o);

          $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive" style="height: 300px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th>Categoria</th><th>Preparaciones</th><th>Elemento Tecnico</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos(this)"><td>'+resp[i].nombre+'</td><td>'+resp[i].categoria_sub+'</td><td>'+resp[i].ejercicio+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
         event.preventDefault();

     }
     function mostrar_datos(f)
          {
              nom= $(f).find('td:eq(0)').text();
              cate = $(f).find('td:eq(1)').text();
              des = $(f).find('td:eq(4)').text();
              foto = $(f).find('td:eq(5)').text();


              $('#nombre').val(nom);
              $('#descripcion').val(des);
              $('#categorias').val(cate);
              var html4='<img src="acciones_abm_ejer/'+foto+'"  alt="..." class="img-rounded" width="200" heigth="200">'
              $('#mostrar-ima').html(html4);
              
          }
     function ver_check(){
 		var cate=document.getElementById("categoria").value;
          var check_selec=$('input[type=checkbox]:checked').serialize();
                      console.log(check_selec);

 		check_selec +="&cate=" + encodeURIComponent(cate)+ "&opcion=" + encodeURIComponent('busqueda_general');
            console.log(check_selec);

          $.ajax({
                url: 'acciones_abm_ejer/ejercicio.php',
                type: 'POST',
                data: check_selec
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                var html = '<div class="table-responsive" style="height: 300px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th>Categoria</th><th>Preparaciones</th><th>Elemento Tecnico</th></tr></thead><tbody>';
        
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos(this)"><td>'+resp[i].nombre+'</td><td>'+resp[i].categoria_sub+'</td><td>'+resp[i].ejercicio+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })
         event.preventDefault();

     }
    </script>
</head>
<body>
<!--  llenado de selects -->

<?php 
	    include("acciones_abm_ejer/llenado_selects.php");

?>
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

<div class="col-xs-12 col-sm-8">
	<div class="col">
		<div class="panel panel-default">
    		<div class="panel-heading">Galeria</div>
  				<div class="panel-body">
	        		<!--  Formulario de Busqueda -->
	      			<form action="" class="form-horizontal" name="form-ver" id="form-ver" method="POST">
	        			<div class="container-fluid">
	        				<div class="row">
	        					<div class="col-sm-7">
				             		<div class="form-group" id="resultado2"></div>
					  
	        						</div>
				  					<div class="col-sm-5">
				    					<div id="MainMenu">
						  					<div class="list-group panel">
						    					<a href="#tecnico" class="list-group-item list-group-item-default" data-toggle="collapse" data-parent="#MainMenu">Ejercicio Tecnico</a>
						    					<div class="collapse" id="tecnico">
													<?php echo $ejercicio_tecnico; ?>
						    					</div>
						    					<a href="#tactico" class="list-group-item list-group-item-default" data-toggle="collapse" data-parent="#MainMenu">Ejercicio Tecnico Tactico</a>
						    					<div class="collapse" id="tactico">
						      						<?php echo $Ejercicio_Tecnico_tactico; ?>
						    					</div>
						    					<a href="#fisico" class="list-group-item list-group-item-default" data-toggle="collapse" data-parent="#MainMenu">Ejercicio Tactico fisico</a>
						    					<div class="collapse" id="fisico">
						      						<?php echo $Ejercicio_Tactico_fisico; ?>
						    					</div>
						    					<a href="#acciones" class="list-group-item list-group-item-default" data-toggle="collapse" data-parent="#MainMenu">Acciones Psicologicas</a>
						    					<div class="collapse" id="acciones">
						      						<?php echo $Acciones_Psicologicas; ?>    	
						    					</div>
						    					<a href="#competencia" class="list-group-item list-group-item-default" data-toggle="collapse" data-parent="#MainMenu">Competencia</a>
						    					<div class="collapse" id="competencia">
						      						<?php echo $Competencia; ?>    	
						    					</div>
						  					</div>
						 					<div class="form-group">
				 								<label class="control-label col-sm-4">Categoria:</label>
					 							<div class="col-sm-7">
				 									<select class="form-control" name="categoria" id="categoria" required>
														<?php echo $categoria; ?>    																						
                        							</select>
				 								</div>	
											</div> 
										</div>
										<div class="col-sm-offset-2 col-sm-2">
      										<button type="submit" class="btn btn-success" >Buscar</button>
    									</div>
									</div>						
									<div class="col-sm-7">
										<div class="form-group">
				  							<div class="col-md-12" align="center">
                								<div  id="mostrar-ima" name="mostrar-ima"></div>
											</div>
										</div>
				 						<div class="form-group">
				 							<label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
				 							<div class="col-sm-7">
				 								<input type="text" class="form-control" id="nombre" placeholder="Nombre del ejercicio" readonly="">
				 							</div>	
				 						</div>
										<div class="form-group">
				 							<label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
				 							<div class="col-sm-4">
				 								<input type="text" class="form-control" id="categorias" placeholder="Categoria" readonly="">
				 							</div>	
				 						</div>
										<div class="form-group">
											<label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
											<div class="col-sm-7">
												<textarea class="form-control" rows="4" type="text" class="form-control" id="descripcion" placeholder="Descripcion del ejercicio" readonly=""></textarea>
											</div>				
										</div>				
				 					</div>		
								</div>
							</form>
						</div>						
					</div>
          			<br>
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