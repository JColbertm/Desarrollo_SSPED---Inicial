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
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera2.php";
 	?>
 	<?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenuregtriatlon.php";
    ?>
<!--  llamada a lo menu desplegables -->
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Triatlon/opctriatlon.php";
    ?>

    
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Teoria Triatlon</div>
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
                                <li> <h4>Libro 1 </h4> <a target="_blank" href="">ver libro</a>
                                    <ul>
                                        <li>Descripcion:
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus fugiat neque excepturi corporis eius dolores tempore aperiam cupiditate nesciunt optio, repudiandae, quis natus magnam omnis velit at reprehenderit eaque alias!</p>
                                        </li>
                                    </ul>
                                </li>

                                <li> <h4>Libro 2 </h4> <a target="_blank" href="">ver libro</a>
                                    <ul>
                                        <li>Descripcion:
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, omnis placeat. Nemo quas neque laudantium. Adipisci, maxime. Quod nihil odio culpa, iste, necessitatibus consequatur, aut numquam reprehenderit cupiditate aperiam doloribus!</p>
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
        
    </div>
 
<!--  llamada al pie de pagina -->
 	<?php 
		require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/pie1.php";
 	?>
</body>
</html>

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
