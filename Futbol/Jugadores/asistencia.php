<form class="form-horizontal" id="formCreacion" name="formCreacion" method="POST" enctype="multipart/form-data">
  <!-- Contenido pestana Programacion de microciclos -->
  <div class="tab-content">
    <!-- Contenido Pestaña creacion -->
    <div class="tab-pane fade in active" id="creacion">
      <div align="center">
        <h3>Asistencia</h3>  
      </div> 
      <br>
      <form class="form-horizontal" id="formCreacion" name="formCreacion" method="POST" enctype="multipart/form-data">
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
          <label class=" col-sm-offset-2 col-sm-1 control-label">Etapas:</label>
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
            <button type="button" class="btn btn-primary" id="generarasi" disabled >
              Generar
            </button>
          </div>  
        </div>    
      </form>  
      <br>         
      <br>
      <!-- Table -->
      <div class=" col-sm-12" id="Exportar_a_Excel">
        <div id="nombre" class="table-editable table-responsive">

        </div>
      </div>             
                  
      <div align="right">
        <form id="form" name="gua">
          <button type="button" class="btn btn-primary" id="btnguardaasis">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
            <span class="hidden-xs">
              Guardar
            </span>
          </button>
          <button type="button" class="btn btn-success" id="exportar" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-export" aria-hidden="true"></span>
            <span class="hidden-xs">
              Exportar
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</form>
