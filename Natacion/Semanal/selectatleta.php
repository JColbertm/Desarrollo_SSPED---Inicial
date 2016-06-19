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
        <div class="panel-heading">Plan Semanal</div>
          <div class="panel-body">
            
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#distribuir" aria-controls="distribuir" role="tab" data-toggle="tab">Seleccion</a></li>
                <li role="presentation"><a href="#edicion" aria-controls="edicion" role="tab" data-toggle="tab">Edicion</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="distribuir">
                  
                  
            <div class="">
              <div>
                <h4>Planificacion Semanal</h4>
              </div>
              <!--  Formulario de Busqueda -->
              <br>
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label" id="buscarMod1" >Atleta:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="BuscaEquipo" placeholder="Nombre de atleta" >
                  </div>
                  <div class="col-sm-3">
                    <button  type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      <span class="hidden-xs">
                        Buscar
                      </span>
                    </button>
                  </div>
                </div>        
                <div>
                  <center><h4>Datos del Atleta</h4></center>
                </div>
                <!--  Tabla de resultado de busqueda -->
                <div class="col-sm-7 col-xs-12 form-group table-responsive" id="ResBusqueda">
                  <div class="col-sm-5 col-xs-12 form-group "></div>
                </div>
                <!--  formulario de muestra de informacion -->
                <br>
                <div class="col-sm-5 col-xs-12">
                  <form class="form-horizontal">
                    <div class="form-group">              
                      <label>Atleta:</label>  
                      <input type="text" class="form-control" id="ReadEquipo" placeholder="Atleta" readonly="">              
                    </div> 
                    <div class="form-group">              
                      <label>Categoria:</label>   
                      <input type="text" class="form-control" id="ReadCategoria" placeholder="Categoria" readonly="">              
                    </div>                 
                  </form>
                </div> 
                <!-- Tipo de Planificacion -->
                <div class="col-sm-12 col-xs-12" id="plani">
                  <form class="form-horizontal">
                    <div>
                      <center><h4>Programaci&oacute;n de semanas</h4></center>
                    </div>
                    <br>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-offset-3 control-label">Cantidad de semanas:</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="30">
                      </div>
                    </div>                                        
                    <div class="form-group">
                      <div class="col-sm-offset-9 col-sm-3">
                        <a href="/Desarrollo_SSPED/Natacion/Semanal/plansemana.php";">
                          <button  type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            <span class="hidden-xs">
                              Distr. Semanas
                            </span>
                          </button>  
                        </a>                      
                      </div>
                    </div>
                  </form>
                </div>
              </form>
            </div>
                       
                </div>
                <div role="tabpanel" class="tab-pane" id="edicion">
                  
            <div class="">
              <div>
                <h4>Planificacion Semanal</h4>
              </div>
              <!--  Formulario de Busqueda -->
              <br>
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputNombreMo" class="col-sm-offset-1 col-sm-2 control-label" id="buscarMod1" >Atleta:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="BuscaEquipo" placeholder="Nombre de atleta" >
                  </div>
                  <div class="col-sm-3">
                    <button  type="button" class="btn btn-default">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      <span class="hidden-xs">
                        Buscar
                      </span>
                    </button>
                  </div>
                </div>        
                <div>
                  <center><h4>Datos del Atleta</h4></center>
                </div>
                <!--  Tabla de resultado de busqueda -->
                <div class="col-sm-7 col-xs-12 form-group table-responsive" id="ResBusqueda">
                  <div class="col-sm-5 col-xs-12 form-group "></div>
                </div>
                <!--  formulario de muestra de informacion -->
                <br>
                <div class="col-sm-5 col-xs-12">
                  <form class="form-horizontal">
                    <div class="form-group">              
                      <label>Atleta:</label>  
                      <input type="text" class="form-control" id="ReadEquipo" placeholder="Atleta" readonly="">              
                    </div> 
                    <div class="form-group">              
                      <label>Categoria:</label>   
                      <input type="text" class="form-control" id="ReadCategoria" placeholder="Categoria" readonly="">              
                    </div>                 
                  </form>
                </div> 
                <!-- Tipo de Planificacion -->
                <div class="col-sm-12 col-xs-12" id="plani">
                  <form class="form-horizontal">
                    <div>
                      <center><h4>Programaci&oacute;n de semanas</h4></center>
                    </div>
                    <br>                                                        
                    <div class="form-group">
                      <div class="col-sm-offset-9 col-sm-3">
                        <a href="/Desarrollo_SSPED/Natacion/Semanal/editadistr.php";">
                          <button  type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            <span class="hidden-xs">
                              Editar Distri.
                            </span>
                          </button>  
                        </a>                      
                      </div>
                    </div>
                  </form>
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

