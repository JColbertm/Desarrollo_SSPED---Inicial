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
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera4.php";
 	?>
 	<?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenuregtriatlon.php";
    ?>
<!--  llamada a lo menu desplegables -->
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Natacion/opcnatacion.php";
    ?>

    
<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      Plan Semanal
    </div>
    <div class="panel-body">            
      <form class="form-horizontal">
        <div class="form-group">                      
          <label class="col-sm-2 control-label">Nombre Atleta:</label>
          <div class="col-sm-4">
            <input class="form-control" type="text" name="" value="Juan Perez" readonly>
          </div>
          <label class="col-sm-1 control-label">Semana:</label>
          <div class="col-sm-2">
            <select class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>                
          <label class="col-sm-1 control-label">Dia:</label>
          <div class="col-sm-2">
            <select class="form-control">
              <option>Lunes</option>
              <option>Martes</option>
              <option>Miercoles</option>
              <option>Jueves</option>
              <option>Viernes</option>
              <option>Sabado</option>
              <option>Domingo</option>
            </select>
          </div>                            
        </div>                  
      </form>
      <br>
      <div class="row">
        <center><h4>Distribucion de Vol&uacute;men</h4></center>
      </div>
      <div class="row">
        <label class="col-sm-2 control-label">Dia:</label>
        <div class="col-sm-2">
          <input class="form-control" type="text" name="" value="Lunes" readonly>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-sm-offset-1 col-sm-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px"> Natacion
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>    
                    <tr>
                      <th class="col-xs-3"><center>Serie_Atleta</center></th>                    
                      <th class="col-xs-3"><center> Porcentaje </center></th>                    
                      <th class="col-xs-3"><center>Tiempo_Realizar</center></th>   
                      <th class="col-xs-3"><center>Fre_Cardiaca</center></th>                    
                      <th class="col-xs-3"><center>Pausa</center></th>                                           
                    </tr>                                
                  </thead>
                  <tbody>
                    <tr>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                    </tr> 
                    <tr>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                    </tr> 
                    <tr>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                    </tr>                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>          
        </div>   
        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px"> Prep. Fisica
            </div>
            <div class="panel-body">
              <div align="right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  <span class="hidden-xs">
                    Añadir
                  </span>
                </button>
                <br><br>
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>    
                    <tr>
                      <th class="col-xs-3"><center>Ejercicio</center></th>                    
                      <th class="col-xs-3"><center>Repeticiones</center></th>                    
                      <th class="col-xs-3"><center>Tonelaje</center></th>                                                                 
                    </tr>                                
                  </thead>
                  <tbody>
                    <tr>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>                      
                    </tr> 
                    <tr>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                      <td><input class="col-xs-4 form-control" type="text"></td>                      
                      <td><input class="col-xs-4 form-control" type="text"></td>
                    </tr>                               
                  </tbody>
                </table>
              </div>            
            </div>
          </div>          
        </div>
      </div>
    </div>

    <div class="col-xs-offset-9 col-xs-3">
      <button type="text" class="btn btn-success">
        <span class="glyphicon glyphicon-floppy-disk"></span>
        <span>
          Guardar
        </span>
      </button>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Preparaci&oacute;n F&iacute;sica</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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


