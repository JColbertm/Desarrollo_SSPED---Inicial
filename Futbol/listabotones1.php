<div class="hidden-xs">
<!--  lista de botones del menu de futbol -->
<div class=" col-sx-offset-1 col-xs-3 col-sm-offset-1 col-sm-2">    
<br><br><br><br>
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <!--  PRIMERA OPCION (PROGRAMACION) -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
              <span class="hidden-xs">
                Programaci&oacute;n
              </span>
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="list-group">
                <!--  OPCION DENTRO DE PROGRAMACION (ADMINISTRACION DE EQUIPOS) -->
                <a href="/Desarrollo_SSPED/Futbol/Programacion/gruposfutbol.php">
                <button  type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Administracion de Equipos">
                <span><i class="fa fa-users" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                    Admi. de Equipos
                </span>
                </button>
                </a>
                <!--  OPCION DENTRO DE PROGRAMACION (PLANIFICACION DE ENTRENAMIENTOS) -->
                <a href="/Desarrollo_SSPED/Futbol/Programacion/planfutbol.php">
                <button  type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Planificacion de entrenamientos">
                  <span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                    <span class="hidden-xs">
                    Planificaci&oacute;n
                </span>
                </button>
                </a>
        
          </div>
        </div>
      </div>
      <!--  SEGUNDA OPCION (DOSIFICACION) -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a class="collapsed" role="button" href="/Desarrollo_SSPED/Futbol/Dosificacion/dosificacion2.php">
            <span><i class="fa fa-fire" aria-hidden="true"></i></span>
              <span class="hidden-xs">
                Dosificaci&oacute;n
              </span>
            </a>
          </h4>
        </div>
      </div>
      <!--  TERCERA OPCION (JUGADORES) -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <span><i class="fa fa-user" aria-hidden="true"></i></span>
              <span class="hidden-xs">
                Jugadores
              </span>
            </a>
          </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
          <div class="list-group">
            <!--  OPCION DENTRO DE JUGADORES (ADMINISTRACION DE JUGADORES) -->
            <a href="/Desarrollo_SSPED/Futbol/Jugadores/jugadoresfutbol.php">
            <button  type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Administracion de Jugadores">
            <span><i class="fa fa-user" aria-hidden="true"></i></span>
            <span class="hidden-xs">
                Admi. Jugadores
            </span>
            </button>
            <!--  OPCION DENTRO DE JUGADORES (ASISTENCIA DE JUGADORES) -->
            <a href="/Desarrollo_SSPED/Futbol/Jugadores/asistenciafutbol.php">
            <button  type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Asistencia de Jugadores">
            <span><i class="fa fa-list-alt" aria-hidden="true"></i></span>
            <span class="hidden-xs">
                Asistencia
            </span>
            </button>
            <!--  OPCION DENTRO DE JUGADORES (EVALUACION DE JUGADORES) -->
            <a href="/Desarrollo_SSPED/Futbol/Jugadores/evaluacionjugadores.php">
            <button  type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Evaluacion de Jugadores">
            <span><i class="fa fa-pencil" aria-hidden="true"></i></span>
            <span class="hidden-xs">
                Evaluaci&oacute;n
            </span>
            </button>
            </a>
            
          </div>
        </div>
      </div>
      <!--  CUARTA OPCION (GALERIA) -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <span><i class="fa fa-picture-o" aria-hidden="true"></i></span>
              <span class="hidden-xs">
                Galeria
              </span>
            </a>
          </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
          <div class="list-group">
                <!--  OPCION DENTRO DE GALERIA (VER EJERCICIOS) -->
                <a href="/Desarrollo_SSPED/Futbol/Galeria/galeriafutbol.php">
                <button type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Galeria de Ejercicio">
                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                    Ejercicios
                </span>
                </button>
                </a>
                <!--  OPCION DENTRO DE GALERIA (ADMINISTRACION DE EJERCICIOS) -->
                <a href="/Desarrollo_SSPED/Futbol/Galeria/abmejercicios.php">
                <button type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Administracion Ejercicios">
                <span><i class="fa fa-cubes" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                    Admi. Ejercicios
                </span>
                </button>
                </a>
                <!--  OPCION DENTRO DE GALERIA (CREACION DE EJERCICIOS) -->
                <a href="/Desarrollo_SSPED/Futbol/Galeria/creaejercicio.php">
                <button type="button" class="list-group-item" data-toggle="tooltip" data-placement="top" title="Creacion de Ejercicios">
                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                <span class="hidden-xs">
                    Creaci&oacute;n Ejercicio
                </span>
                </button>
                </a>                
          </div>
        </div>
      </div>
      <!--  QUINTA OPCION (TEORIA) -->
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
          <h4 class="panel-title">
            <a class="collapsed" role="button" href="/Desarrollo_SSPED/Futbol/Teoria/teoriafutbol.php">
            <span><i class="fa fa-book" aria-hidden="true"></i></span>
              <span class="hidden-xs">
                Teoria
              </span>
            </a>
          </h4>
        </div>
      </div>
    </div>

</div>
</div>