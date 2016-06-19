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
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera5.php";
 	?>
 	<?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenuregtriatlon.php";
    ?>
<!--  llamada a lo menu desplegables -->
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/NAtacion/opcnatacion.php";
    ?>

    
    <div class="col-xs-12 col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">Edicion Plan Semanal</div>
          <div class="panel-body">            
            
              
                  <form class="form-horizontal">
                    <div class="form-group">                      
                      <label class="col-sm-2 control-label">Nombre Atleta</label>
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
                    </div>
                  </form>
                  <br>
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Lunes</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Martes</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Miercoles</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Jueves</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Viernes</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Sabado</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">Domingo</div>
                          <div class="panel-body">
                            <form>   
                            <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-1 form-group">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                            
                              </div>
                              <div class="col-xs-6">
                                  <input class="form-control" type="text" name="">
                              </div>
                              <div class="col-xs-2">
                                <span>Km.</span>
                              </div>
                              </div>

                              <div class="row">
                              <div class="checkbox col-xs-3">
                                <label>
                                  <input type="checkbox"> <img src="/Desarrollo_SSPED/Triatlon/Imagenes/pesas.png" width="25px">
                                </label>                            
                              </div>                              
                              </div>
                            </form>

                          </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-info">
                          <div class="panel-heading">Resumen (Totales)</div>
                          <div class="panel-body">                              
                            <form class="form-horizontal">
                              <div class="form-group">
                                <label class="col-xs-1">
                                  <img src="/Desarrollo_SSPED/Triatlon/Imagenes/natacion.png" width="25px">
                                </label>
                                <div class="col-xs-8">
                                  <input class="form-control" placeholder="0" readonly>
                                </div>
                                <span>Km.</span>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-1">
                                  <img src="/Desarrollo_SSPED/Triatlon/Imagenes/ciclismo.png" width="25px">
                                </label>                                                                
                                <div class="col-xs-8">
                                  <input class="form-control" placeholder="0" readonly>
                                </div>
                                <span>Km.</span>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-1">
                                  <img src="/Desarrollo_SSPED/Triatlon/Imagenes/atletismo.png" width="25px">
                                </label>                                
                                <div class="col-xs-8">
                                  <input class="form-control" placeholder="0" readonly>
                                </div>
                                <span>Km.</span>
                              </div>
                                                            
                            </form>
                          </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Adicional</div>
                          <div class="panel-body">                            
                            <form>                                                                                      
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> Test Pedag&oacute;gico
                                </label>
                              </div>
                              <div class="col-xs-12">
                                <div class="alert alert-info" role="alert">
                                  Marque si desea realizar "Test Pedag&oacute;gico".
                                </div>
                              </div>
                              <div class="col-xs-offset-5 col-xs-3">
                                <button type="button" class="btn btn-default">
                                  <span class="glyphicon glyphicon-floppy-disk"></span>
                                  <span class="hidden-xs">
                                    Guardar
                                  </span>
                                </button>
                              </div>
                            </form>
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

