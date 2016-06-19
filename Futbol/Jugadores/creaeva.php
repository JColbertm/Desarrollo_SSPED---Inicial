
        <div align="center">
              <h3>Evaluacion</h3>  
            </div> 
            <br>
          <form class="form-horizontal" id="formCreacioneva" name="formCreacioneva" method="POST" enctype="multipart/form-data">
            <div class="row">
              <label class="col-sm-offset-2 col-sm-1 control-label">Equipo:</label>
              <div class="col-sm-2">
                <select class="form-control" id="equipo-cre" name="creacion-equi" required>
                  <?php echo $equipo; ?>                  
                </select>
              </div>
              <label class=" col-sm-2 control-label">Nombre Planificacion:</label>
              <div class="col-sm-2">
                <select class="form-control" id="plan-cre" name="creacion-tipo" required>
                
                </select>
              </div>
            </div>
            <br> 
            <div class="row">
              <label class="col-sm-offset-2 col-sm-1 control-label">Etapas:</label>
              <div class="col-sm-2">
                <select class="form-control" id="etapas-cre" name="creacion-meso" required>
                  <?php echo $etapas; ?>                  
                </select>
              </div>
              <label class=" col-sm-2 control-label">Mesociclos:</label>
              <div class="col-sm-2">
                <select class="form-control" id="meso-cre" required>
            
                </select>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-offset-9 col-sm-3 col-xs-6">
                <button type="button" class="btn btn-primary" id="generareva" disabled>
                  <i class="fa fa-download" aria-hidden="true"></i> Generar
                </button>
              </div>  
            </div> 
          </form>  
          <div id="nota">
          
          </div>
          <br>
          <!-- Table -->
          <div class=" col-xs-12" id="Exportar_a_Excel">
            <div class="col-xs-12">
              <div id="nota1">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota2">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota3">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota4">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota5">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota6">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota7">
              
              </div>
            </div>
            <div class="col-xs-12">
              <div id="nota8">
              
              </div>
            </div>
            <div class="col-sm-12 col-xs-12">
              <div id="nombre" class="table table-responsive">

              </div>              
            </div>       
          </div>         
          <br>
          <div>
          <form class="form-horizontal" id="formboton_eva" name="formboton_eva" method="POST" enctype="multipart/form-data">  
            <div class="col-sm-offset-7 col-sm-2 col-xs-6">
            <br>
              <button  type="button" class="btn btn-primary" id="btnguarda_eva" disabled>
                <span><i class="fa fa-upload" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                  Guardar
                </span>
              </button>
            </div>
            <div class="col-sm-2 col-xs-6">
            <br>
              <button  type="button" class="btn btn-success" id="exportar_eva" data-toggle="modal" data-target="#myModal" disabled>
                <span><i class="fa fa-external-link" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                  Exportar
                </span>
              </button>
            </div>
          </form>
          </div>