<!-- Banda de Presentacion  -->
	<nav class="navbar navbar-default">
  	<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
  		<div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
      			<a class="navbar-brand" href="/Desarrollo_SSPED/index.php"> Home</a>
    		</div>

    		<!-- Collect the nav links, forms, and other content for toggling -->
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="nav navbar-nav">
        		<li><a href="/Desarrollo_SSPED/Futbol/futbol.php">Futbol<span class="sr-only">(current)</span></a></li>
            <li><a href="/Desarrollo_SSPED/Triatlon/triatlonindex.php">Triatlon<span class="sr-only"></span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href=""class="modal1" data-toggle="modal" data-target="#registromodal">Registrarse</a></li>
            <li><a href="" class="modal1" data-toggle="modal" data-target="#modalingreso">Ingresar</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>

<!-- Formulario modal login -->
<div class="modal fade" id="modalingreso" tabindex="-1" role="dialog" aria-labelledby="modalingreso">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
     	<div class="modal-header">
       	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    		<h4 class="modal-title" id="myModalLabel">Ingreso</h4>
   		</div>
           
    	<div class="modal-body">
       	<form class="form-horizontal" method="post" name="login_form" id="login_form">
	 			  <div class="form-group">
            <label class="col-sm-2 col-sm-offset-1 control-label">CI:</label>
  					<div class="col-sm-7">
    					<input type="text" class="form-control" id="inputCi"  name="inputCi" placeholder="Carnet de identidad" required>
   					</div>
 			 		</div>

 			 		<div class="form-group">
    				<label class="col-sm-2 col-sm-offset-1 control-label">Password:</label>
  					<div class="col-sm-7">
    					<input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
   					</div>
 			 		</div>

          <div class="form-group" id="muestra">
                
          </div> 

 			 		<div class="form-group">
			    	<div class="col-sm-offset-3 col-sm-7">
			      	<button type="submit" class="btn btn-success" id="btningresar">Ingresar</button>
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


<!-- Formulario modal registro -->

<div class="modal fade" id="registromodal" tabindex="-1" role="dialog" aria-labelledby="registromodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de Registro</h4>
      </div>
      <div class="modal-body">
        <!-- Formulario de registro -->
        <form action="index.php" class="form-horizontal" id="formRegistrocoach" method="POST">
          <div class="form-group" id="resultado">
                
          </div> 
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombrecoach" name="nombrecoach" placeholder="Juan" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-2 control-label">Apellido P.:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="apellidopcoach" name="apellidopcoach" placeholder="Perez" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-2 control-label">Apellido M.:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="apellidomcoach" name="apellidomcoach" placeholder="Lopez" required>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha de Nacimiento:</label>
            <div class="col-sm-10">
              <input type="date" id="fechanaccoach" name="fechanaccoach" step="1" min="1940-01-01" max="2016-12-31" value="<?php echo date("Y-m-d");?>">
            </div>
          </div> 
        
          <div class="form-group">
            <label class="col-sm-2 control-label">Carnet:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="carnet" name="carnet" placeholder="6482974" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Telefono:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="telefono" name="telefono" placeholder="78595241" required>
            </div>
          </div>
      
          <div class="form-group">
            <label class="col-sm-2 control-label">Correo:</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="mailcoach" name="mailcoach" placeholder="juan.perez@ejemplo.com" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="passwordcoach" name="passwordcoach" placeholder="**********" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Confirmar Password:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password2coach" name="password2coach" placeholder="**********" required>
            </div>
          </div>
        
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success" id="btn-regisentrenador">Registrar</button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-limpiar-en">Limpiar Campos</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>