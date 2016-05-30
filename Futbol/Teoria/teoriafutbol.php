<!DOCTYPE html>
<html> 
<head>
	<title></title>
	<link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>

    <script type="text/javascript"> 
		$(document).ready(function() {

			$('#btnregistro').on('click', function(){
				$('.form-horizontal').on('submit', function(evento){evento.preventDefault();})

        $('#close').on(click,function(){
          var Id = $('close').attr('name');
          alert("valor = "+Id);
        })

			})

    		$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})

			$('#formRegistropagina').on('submit', registro_pagina)


			$('#formRegistrovideo').on('submit', registro_video)

			mostrar_pagina();

			mostrar_video();


		})

		function mostrar()
		{
			mostrar_pagina();
			mostrar_video();
		}


		 function elimina_pag(e)
      	{
          var id = "datos=" +encodeURIComponent(e) ;
          id += "&opcion=" + encodeURIComponent('elimina');
          console.log(id);
          $.ajax({
            url: 'teoria.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp);
            var t= resp.resp; 
            if(t==1)
            {
              mostrar();   
            }
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }


      function elimina_vid(e)
      	{
          setTimeout("$('.ocultar').hide();", 1000);
          var id = "datos=" +encodeURIComponent(e) ;
          id += "&opcion=" + encodeURIComponent('elimina');
          console.log(datos);
          $.ajax({
            url: 'teoria.php',
            type: 'POST',
            data: id
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp; 
            if(t==1)
            {
              var html='<div  class="alert alert-info ocultar" role="alert"> Pagina eliminada!</div>'; 
              mostrar();    
            }
            $('#resultado4').html(html); 
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }

		 function registro_pagina()
      	{
          setTimeout("$('.ocultar').hide();", 1000);
         setTimeout("$('#modalregistrolink').modal('hide');", 2000);
          var datos= $('#formRegistropagina').serialize();
          datos += "&opcion=" + encodeURIComponent('registrar_pagina');
          console.log(datos);
          $.ajax({
            url: 'teoria.php',
            type: $('#formRegistropagina').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp; 
            if(t==1)
            {
              $('#nombrepagina').val('');
              $('#descripcionpagina').val('');
              $('#linkpagina').val('');
              var html='<div  class="alert alert-success ocultar" role="alert"> Pagina agregada!</div>'; 
              mostrar();   
            }
            else{
              var html='<div  class="alert alert-danger ocultar" role="alert"> No se pudo agregar la Pagina</div>'; 
            }
            $('#resultado2').html(html);   
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
        
      }


       function registro_video(){
         setTimeout("$('.ocultar').hide();", 1000);
         setTimeout("$('#modalregistrovideo').modal('hide');", 2000);
          var datos= $('#formRegistrovideo').serialize();
          datos += "&opcion=" + encodeURIComponent('registrar_video');
          console.log(datos);
          $.ajax({
            url: 'teoria.php',
            type: $('#formRegistrovideo').attr('method'),
            data: datos
          })
          .done(function(data) {
            var resp = $.parseJSON(data);
            console.log(data);
            console.log(resp);
            var t= resp.resp;
            if(t==1)
            {
              $('#nombrevideo').val('');
              $('#descripcionvideo').val('');
              $('#linkvideo').val('');
              var html='<div  class="alert alert-success ocultar" role="alert"> Video agregado!</div>'; 
              mostrar(); 
            }
            else{
              var html='<div  class="alert alert-danger ocultar" role="alert"> No se pudo agregar el Video</div>'; 
            }
            $('#resultado3').html(html); 
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
            
      }


      function mostrar_pagina()
      {
      	var opc = 'mostrar';
      	var id = 2;
      	$.ajax({
            url: 'teoria.php',
            type: 'POST',
            data: {opcion: opc, ide: id}
          })
          .done(function(data) {
          	var resp = $.parseJSON(data);
            console.log(resp);
            var html = '<ol class="lista_paginas">';		

            	for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {
                    	html += '<li><h4>'+resp[i].nombre+'</h4> <a target="_blank" href="'+resp[i].link+'">ver pagina</a><button type="submit" class="close" name="'+resp[i].nombre+'" id="'+resp[i].idpag+'" onclick="elimina_pag(this.id)"><span aria-hidden="true">&times;</span></button>'+
					       			'<ul>'+
					       				'<li>'+
					       					'Descripcion:'+
					       					'<p>'+resp[i].descripcion+'</p>'+
					       				'</li>'+
					       			'</ul>'+
					       		'</li>';
                    }

                  }
                  
		 	html+='</ol>';                                                
			$('#resultado').html(html);
			console.log(html);
           
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
          
      	var html = '<div class="table-responsive col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th width=1 style="visibility:hidden; ">G</th><th width=1 style="visibility:hidden;">i</th><th style="visibility:hidden; " width=1>i</th><th >Equipo</th><th >Categoria</th></tr></thead><tbody>';
      }


      function mostrar_video()
      {
      	var opc = 'mostrar';
      	var id = 3;
      	$.ajax({
            url: 'teoria.php',
            type: 'POST',
            data: {opcion: opc, ide: id}
          })
          .done(function(data) {
          	var resp = $.parseJSON(data);
            console.log(resp);
            var html = '<ol class="lista_paginas">';		

            	for(i in resp){ 
                    //si encuentra un resultado
                    if(resp[i].res==1)
                    {
                    	html += '<li><h4>'+resp[i].nombre+'</h4> <a target="_blank" href="'+resp[i].link+'">ver pagina</a> <button type="button" class="close" name="'+resp[i].nombre+'" id='+resp[i].idpag+' onclick="elimina_pag(this.id)"><span aria-hidden="true">&times;</span></button>'+
					       			'<ul>'+
					       				'<li>'+
					       					'Descripcion:'+
					       					'<p>'+resp[i].descripcion+'</p>'+
					       				'</li>'+
					       			'</ul>'+
					       		'</li>';
                    }

                  }
                  
		 	html+='</ol>';                                                
			$('#resultado1').html(html);
			console.log(html);

            
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();
          
      	var html = '<div class="table-responsive col-sm-10" style="height: 200px; overflow-y:scroll;"><table class="table table-hover"  ><thead><tr><th width=1 style="visibility:hidden; ">G</th><th width=1 style="visibility:hidden;">i</th><th style="visibility:hidden; " width=1>i</th><th >Equipo</th><th >Categoria</th></tr></thead><tbody>';
      }

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


<!-- PAGINA DE TEORIA -->

<div class="col-xs-12 col-sm-8">	

	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Libros / Paginas / Videos</h4>
		</div>
  		<div class="panel-body">
    		<div class="panel-group col-xs-12" id="accordion" role="tablist" aria-multiselectable="true">
	  			<div class="panel panel-default">
	    			<div class="panel-heading" role="tab" id="headingOne">
	      				<h4 class="panel-title">
	        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          					Libros
	        				</a>
	      				</h4>
	    			</div>
		    		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
		      			<div class="panel-body">

				    		<div class="col-sm-11 col-xs-12">
				    			<ol>
				    			<li> <h4>Dejad que los niños y niñas jueguen </h4> <a target="_blank" href="/Desarrollo_SSPED/Futbol/Teoria/Libros/DEJAD QUE LOS NIÑOS Y NIÑAS JUEGUEN.pdf">ver libro</a>
				    				<ul>
				    					<li>Descripcion:
				    						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus fugiat neque excepturi corporis eius dolores tempore aperiam cupiditate nesciunt optio, repudiandae, quis natus magnam omnis velit at reprehenderit eaque alias!</p>
				    					</li>
				    				</ul>
				    			</li>

				    			<li> <h4>150 Ejercicios Tecnicos </h4> <a target="_blank" href="/Desarrollo_SSPED/Futbol/Teoria/Libros/150 EJERCICIOS TECNICOS.pdf">ver libro</a>
				    				<ul>
				    					<li>Descripcion:
				    						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, omnis placeat. Nemo quas neque laudantium. Adipisci, maxime. Quod nihil odio culpa, iste, necessitatibus consequatur, aut numquam reprehenderit cupiditate aperiam doloribus!</p>
				    					</li>
				    				</ul>
 								</li>	

				    			<li> <h4>Orientacion Formativas Para el Entrenador de Futbol </h4> <a target="_blank" href="/Desarrollo_SSPED/Futbol/Teoria/Libros/ORIENTACIONES FORMATIVAS PARA EL ENTRENADOR DE FUTBOL.pdf">ver libro</a>
				    				<ul>
				    					<li>Descripcion:
				    						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias laudantium, libero odio obcaecati velit temporibus debitis, eum. Cum quia, porro animi impedit odit eos sequi recusandae accusamus error ratione, enim.</p>
				    					</li>
				    				</ul>
				    			</li>


                  <li> <h4>Futbol Base Fifa </h4> <a target="_blank" href="/Desarrollo_SSPED/Futbol/Teoria/Libros/FUTBOL BASE FIFA.pdf">ver libro</a>
                    <ul>
                      <li>Descripcion:
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias laudantium, libero odio obcaecati velit temporibus debitis, eum. Cum quia, porro animi impedit odit eos sequi recusandae accusamus error ratione, enim.</p>
                      </li>
                    </ul>
                  </li>


				    			</ol>
				    		</div>
	
		      			</div>
		    		</div>
	  			</div>

				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingTwo">
				      <h4 class="panel-title">
				        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#pagina" aria-expanded="false" aria-controls="pagina">
				          Paginas Externas
				        </a>
				      </h4>
				    </div>
				    <div id="pagina" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pagina">
				      	<div class="panel-body">
				      		<div class="col-sm-11" id="resultado">
				       		 				       		
				       		</div>
                  

				       		<div class="col-sm-offset-9 col-sm-3">
				       		<br>
				       			<button type="button" class="modal1 btn btn-primary" data-toggle="modal" data-target="#modalregistrolink" data-toggle="tooltip" data-placement="bottom" title="Añadir"> 
				       				Agregar 
				       			</button>	
				       		</div>
				      	</div>
				    </div>
				</div>

				<div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="headingThree">
				      <h4 class="panel-title">
				        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#video" aria-expanded="false" aria-controls="collapseTwo">
				        	Videos 
				        </a>
				      </h4>
				    </div>
				    <div id="video" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				      	<div class="panel-body">

				      		<div class="col-sm-11" id="resultado1">
				       		 				       		
				       		</div>

                  <div class="form-group" id="resultado4">
                
                  </div>
				       		<div class="col-sm-offset-9 col-sm-3">
				       		<br>
				       			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalregistrovideo" data-toggle="tooltip" data-placement="bottom" title="Añadir"> 
				   					Agregar 
			    				</button>	
			       			</div>
				      	</div>	

				    </div>
				 </div>
	 		</div>	
  		</div>
	</div>
	<!-- PANELES DESPLEGABLES -->
</div>
	

		
<!-- Modal de registro de paginas -->
<div class="modal fade" id="modalregistrolink" tabindex="-1" role="dialog" aria-labelledby="modalregistrolink">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro de pagina</h4>
      </div>
    
    <div class="modal-body">
      	<!-- Formulario de registro -->
    		<form class="form-horizontal" id="formRegistropagina" method="POST">
				<div class="form-group">
			    <label class="col-sm-2 control-label">Nombre:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="nombrepagina" name="nombrepagina" placeholder="Nombre de la pagina" required="">
			    	</div>
			  	</div>
			  	
			  	<div class="form-group">
			   	<label class="col-sm-2 control-label">Descripcion:</label>
			    	<div class="col-sm-10">
			      		<textarea class="form-control" rows="4" type="text" class="form-control" id="descripcionpagina" name="descripcionpagina" placeholder="Descripcion de la pagina" required=""></textarea>
			   	 	</div>
			  	</div>
			  	<div class="form-group">
			    <label class="col-sm-2 control-label">Link:</label>
			    	<div class="col-sm-10">
			     		<input type="text" class="form-control" id="linkpagina" name="linkpagina" placeholder="www.ejemplopagina.com" required="">
			  		</div>
			  	</div>
			  
			  	<div class="form-group">
			  		<div class="col-sm-offset-2 col-sm-10">
			      		<button id="btnregistropagina" type="submit" class="btn btn-success">Registrar</button>
			    	</div>			  	
			  	</div>
			  	<div class="form-group" id="resultado2">
                
              </div>
			   
			</form>
			
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
    </div>
    </div>
  </div>
</div>


<!-- Modal de registro de videos -->
<div class="modal fade" id="modalregistrovideo" tabindex="-1" role="dialog" aria-labelledby="modalregistrolink">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro de Video</h4>
      </div>
    
    <div class="modal-body">
      	<!-- Formulario de registro -->
    		<form class="form-horizontal" id="formRegistrovideo" method="POST">  
				<div class="form-group">
			    <label class="col-sm-2 control-label">Nombre:</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="nombrevideo" name="nombrevideo" placeholder="Nombre del Video" required="">
			    	</div>
			  	</div>
			  	
			  	<div class="form-group">
			   	<label class="col-sm-2 control-label">Descripcion:</label>
			    	<div class="col-sm-10">
			      		<textarea class="form-control" rows="4" type="text" class="form-control" id="descripcionvideo" name="descripcionvideo" placeholder="Descripcion del Video" required=""></textarea>
			   	 	</div>
			  	</div>
			  	<div class="form-group">
			    <label class="col-sm-2 control-label">Link:</label>
			    	<div class="col-sm-10">
			     		<input type="text" class="form-control" id="linkvideo" name="linkvideo" placeholder="www.ejemplovideo.com" required="">
			  		</div>
			  	</div>

			  	<div class="form-group" id="resultado3">
                
              </div>
			  
			  	<div class="form-group">
			  		<div class="col-sm-offset-2 col-sm-10">
			      		<button id="btnregistrovideo" type="submit" class="btn btn-success">Registrar</button>
			    	</div>			  	
			  	</div>
			   
			</form>
			
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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