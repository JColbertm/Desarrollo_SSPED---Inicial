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

    
<!--  bienvenida al usuario nueva entrada -->
    <div class="col-xs-12 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-heading">Administracion de Atletas</div>
      <div class="panel-body">
        

          <!-- Pestaña ABM Equipo -->

          <ul class="nav nav-tabs" role="tablist">
           <li class="active"><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-first">Registrar</a></li>
            <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-second">Modificar</a></li>
            <li><a href="javascript:;" role="tab" data-toggle="tab" data-target="#tabs-third">Eliminar</a></li>
          </ul>
          <!-- Contenido Pestaña ABM Equipo -->
          <div class="tab-content">

          <!-- Contenido Pestaña registrar Equipo-->

           <div class="active tab-pane fade in" id="tabs-first">
            
          <!-- FORM CREAR Equipo -->
          <h4>Registrar nuevo atleta</h4>
          <form class="form-horizontal" method="post" id="formRegistroJ" enctype="multipart/form-data">
            
            <br>
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regNombre" name="regNombre" placeholder="Nombre " onkeypress="return soloLetras(event);" >
                </div> 
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regAp1" name="regAp1" placeholder="Apellido paterno" onkeypress="return soloLetras(event);">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
                <div class="col-sm-7">
                  <input required type="text" class="form-control" id="regAp2" name="regAp2" placeholder="Apellido materno" onkeypress="return soloLetras(event);">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
                <div class="col-sm-7">
                  <input type="date" id="regFechana" name="regFechana" step="1" min="01-01-1900" max="31-12-2100" value="<?php echo date("d-m-Y");?>">
                </div>
              </div>
                        

            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Categoria</label>
              <div class="col-sm-3" id="selectCat">
                <select class="form-control" id="modCatJ2" name="modCatJ2">
                   
                    <option value="1"></option>
                    <option value="2">Menores</option>
                    <option value="3">Cadetes</option>
                    <option value="4">Mayores</option>
                    
                  </select>
              </div>
            </div>
            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia:</label>
                <div class="col-sm-3" >
                <output  id="mostrar-ima" name="mostrar-ima" > 
                 </output></div>
              </div>

                <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label">Subir imagen:</label>
                 
                    <label class=" control-label"></label>
                    
                      <input type="file" id="abrir-ima" class="form-control-file " name="abrir-ima">
                  </div>
                     <script src="mostrar_ima.js"></script>


            
            

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-2">
                <button type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-success">Registrar</button>
              </div>
            </div>

                    <div id="resultado"></div>
             
          </form>
           <!-- FIN FORM CREAR Equipo -->

           </div>

          <!-- Fin Contenido Pestaña registrar Equipo-->

          <!--  Contenido Pestaña modificar Equipo-->

           <div class="tab-pane fade" id="tabs-second">


            <!-- FORM MODIFICAR Equipo -->
          <h4>Modificar informacion atleta</h4>
          <form class="form-horizontal"  id="formModificarJ" method="POST" enctype="multipart/form-data">
            <br>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label"  >Nombre:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="buscarMod1" placeholder="Nombre de jugador"  onkeypress="return soloLetras(event);">
              </div>
              <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                       Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>
                 
              </div>
            </div>



            <div id="resultado2" class="form-group">
              
            </div>

            <div>
              <center><h4>Datos del Atleta</h4></center>
            </div>
           
            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="modNombreJ" name="modNombreJ" placeholder="Nombre " onkeypress="return soloLetras(event);" required >
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="modApellido1J" name="modApellido1J" placeholder="Apellido paterno" onkeypress="return soloLetras(event);" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="modApellido2J" name="modApellido2J" placeholder="Apellido materno" onkeypress="return soloLetras(event);" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
                <div class="col-sm-7">
                  <input type="date" id="modFechaJ" name="modFechaJ" step="1" min="01-01-1900" max="31-12-2100" value="<?php echo date("d-m-Y");?>">
                </div>
              </div>
            

            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Categoria</label>
              <div class="col-sm-3" id="selectCat2">
          
                
              <select class="form-control" id="modCatJ2" name="modCatJ2">
                   <option value="1"></option>
                    <option value="2">Menores</option>
                    <option value="3">Cadetes</option>
                    <option value="4">Mayores</option>
                    
                  </select>
 

             
              </div>
            </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia del atleta:</label>
                <div class="col-sm-3" >
                <output  id="mostrar-ima-mod" name="mostrar-ima-mod" > 
                 </output></div>
              </div>

             <div class="form-group">
                  <label class="col-sm-offset-1 col-sm-2 control-label">Subir imagen:</label>
                 
                    <label class=" control-label"></label>
                    
                      <input type="file" id="abrir-ima-mod" class="form-control-file " name="abrir-ima-mod">
                  </div>
                     <script src="mostrar_ima_mod.js"></script>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-2">
                <button type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-success">Modificar</button>
              </div>
            </div>

            

            <div class="form-group">
              
            </div>

            <div id="resultado3">
              
            </div>
            
              
          </form>
          <!-- FIN FORM MODIFICAR Equipo -->
           </div>
          <!--  Fin Contenido Pestaña modificar Equipo-->


           <div class="tab-pane fade" id="tabs-third">


            <!-- FORM ELIMINAR Equipo -->


          <h4>Eliminar atleta</h4>

          <form class="form-horizontal"  id="formEliminarJ" method="POST">
            <br>
            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label"  >Nombre:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="EliJugador" placeholder="Nombre de jugador"  onkeypress="return soloLetras(event);">
              </div>
              <div class="col-xs-6 col-sm-3 hidden-xs">
                  <label class="col-sm-offset-1  control-label">
                       Buscar
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  </label>
                 
              </div>
            </div>



            <div class="form-group" id="resultado4">
              
            </div>

            <div>
              <center><h4>Datos del Atleta</h4></center>
            </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fotografia del Atleta:</label>
                <div class="col-sm-7">
                <div  id="mostrar-ima-eli" name="mostrar-ima-eli"></div>
                </div>
              </div>
            
              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Nombre:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elNombreJ" placeholder="Nombre " onkeypress="return soloLetras(event);" readonly="">
                </div>
                
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido paterno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elApellido1J" placeholder="Apellido paterno" onkeypress="return soloLetras(event);" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Apellido materno:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elApellido2J" placeholder="Apellido materno" onkeypress="return soloLetras(event);" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-offset-1 col-sm-2 control-label">Fecha de nacimiento:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="elFechaJ" placeholder="Fecha de nacimiento" readonly="">
                </div>
              </div>
            

            <div class="form-group">
              <label class="col-sm-offset-1 col-sm-2 control-label">Categoria</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="elCatJ2" placeholder="Categoria" readonly="">
              </div>
            </div>

          
          <!-- Boton eliminar -->

          <div class="form-group">
              <div class="col-sm-offset-7 col-sm-2">
            <button type="button" class="eliminar btn btn-danger " data-toggle="modal" data-target="#myModalEliminarJugador">
            Eliminar
            </button>
            </div>
          </div>
          <!-- Formulario modal2n -->

           <div class="modal fade" id="myModalEliminarJugador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-xs" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Eliminar</h4>
                     </div>
                     
                    <div class="modal-body">
                      <form class="form-horizontal" method="post" action='' name="login_form">
                        <div class="form-group">
                          <br>
                          <label for="inputCI" class=" col-xs-offset-1 col-xs-11">Seguro de eliminar este Atleta?</label>
                        </div>

                
                      <div class="form-group">
                        <div class="col-xs-offset-1 col-xs-7">
                          <button type="button" id="eliminacion" class="btn btn-success" data-dismiss="modal">Eliminar</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                     </div>
                     <div id="resultado6"></div>


                    </form>
                    </div>

                    
                  </div>
              </div>
            </div>




          </form>


<!-- FIN FORM ELIMINAR Equipo -->
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

