<div class="col-xs-12">
    <br><br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#planificacion" aria-controls="planificacion" role="tab" data-toggle="tab">Planficacion</a></li>
      <li role="presentation"><a href="#periodos" aria-controls="periodos" role="tab" data-toggle="tab">Periodos y Etapas</a></li>
      <li role="presentation"><a href="#mesociclos" aria-controls="mesociclos" role="tab" data-toggle="tab">Mesociclos</a></li>
      <li role="presentation"><a href="#direcciones" aria-controls="direcciones" role="tab" data-toggle="tab">Direcciones</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Primer Panel -->
      <div role="tabpanel" class="tab-pane active" id="planificacion">
      <br>
        <div class="col-xs-2">
          <label><strong>Planificacion:</strong></label>
        </div>  
        <div class="col-xs-3">
          <label>Semestral</label>
        </div>
        <div class="col-xs-12">
        <br>
          <form class="form-inline" id="formPlanSemestral" method="POST">
            <div class="form-group col-xs-offset-2 col-xs-9">
              <div class="col-xs-4">
                <label>Fecha de inicio de preparacion:</label>
              </div>
              <div class="col-xs-5">
                <input type="date" name="fechainiprepaS" step="1" min="2015-01-01" max="2020-12-31" value="<?php echo date("Y-m-d");?>">
              </div>              
            </div>            
        
          <div class="col-xs-12">
            <br><br>
              <div class="form-group col-xs-6">
                <div class="col-xs-4">
                  <label>Frecuencia Semanal:</label>
                </div>
                <div class="col-xs-2">
                  <select class="form-control" name="diassemanaS">
                    <option value="2">2 Dias</option>
                    <option value="3">3 Dias</option>
                    <option value="4">4 Dias</option>
                    <option value="5">5 Dias</option>
                    <option value="6">6 Dias</option>
                    <option value="7">7 Dias</option>
                  </select>
                </div>
              </div>
            
              <div class="form-group col-xs-6">
                <div class="col-xs-4">
                  <label>Tiempo de Clase:</label>
                </div>
                <div class="col-xs-2">
                  <select class="form-control" name="tiempoclaseS">
                    <option value="60">60 Minutos</option>
                    <option value="90">90 Minutos</option>
                    <option value="120">120 Minutos</option>
                  </select>
                </div>
              </div>
          </div>
          
          <div class="col-xs-12">
            <br><br>                   
              <label class="col-xs-offset-2 col-xs-2">Transito:</label>
              <div class="form-group">
                  <label class="radio-inline" >
                    <input type="radio" name="inlineRadioOptions"  id="inlineRadio1" value="0" checked>0 Semanas
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions"  id="inlineRadio2" value="1">1 Semana
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions"  id="inlineRadio2" value="2">2 Semanas
                  </label>
              </div>       
          </div>

          <div class="col-xs-offset-1 col-xs-2">
          <br>
            <button type="button" class="form-control btn btn-primary" id="btncalcularS">
              <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
              <span class="hidden-xs">
                Calcular
              </span>
            </button>
          </div>
          
          <div class="form-group col-xs-7 col-xs-offset-5">
          <br>
            <div class="col-xs-4">
              <label>Cantidad de Semanas:</label>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="cantisemanasS" placeholder="Cantidad de Semanas" readonly="">
            </div>
          </div>

          <div class="form-group col-xs-7 col-xs-offset-5">  
            <div class="col-xs-4">
              <label>Cantidad de Dias:</label>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="cantidiasS" placeholder="Cantidad de Dias" readonly="">
            </div>
          </div>

          <div class="form-group col-xs-7 col-xs-offset-5">            
            <div class="col-xs-4">
              <label>Tiempo Total:</label>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="tiempototalS" placeholder="Tiempo Total" readonly="">
            </div>
          </div>

          <div class="form-group col-xs-7 col-xs-offset-5">            
            <div class="col-xs-4">
              <label>Fecha Final:</label>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="fechafinalS" placeholder="Fecha Final" readonly="">
            </div>
          </div>

          <div class="col-xs-offset-9 col-xs-3">
          <br>
         <a class="form-control btn btn-success" href="#" id="siguiente_tab" disabled>
              <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
              <span class="hidden-xs">
                Siguiente
              </span>
         </a>
          </div>

          

        </form>
      </div>
    </div>

    <!-- SEGUNDO PANEL -->
    <div role="tabpanel" class="tab-pane" id="periodos">  

    <!-- CONTENEDOR DEL ENTRENAMIENTO PREPARATORIO -->
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <br>
          
            <div class="col-xs-12" id="inline_content">
              <center>
                <h4><u>Preparatorio</u></h4>
                <br>
                <label class="radio-inline "><input type="radio" name="optradioS" value=60 id="p1">60 %</label>
                <label class="radio-inline"><input type="radio" name="optradioS" value=50 id="p2">50 %</label>
                <label class="radio-inline"><input type="radio" name="optradioS" value=40 id="p3">40 %</label>
                <br><br>
                <label>Tiempo en semanas: </label>
                <label id="tiempo_semanas" > 30 </label> Semanas.
              </center>
            </div>

            <div class="col-xs-6" id="pretemp1">
              <center>
                <u>Pre-Temporada</u>
                <br><br>
                <label class="radio-inline"><input type="radio" name="optradioP" value=60>60 %</label><br>
                <label class="radio-inline"><input type="radio" name="optradioP" value=50>50 %</label><br>
                <label class="radio-inline"><input type="radio" name="optradioP" value=40>40 %</label><br>
                <br><br>
                <label>Tiempo en semanas: </label>
                <label> 30 </label> Semanas.
              </center>
            </div>

            <div class="col-xs-6" id="preesp1">
              <center>
                <u>Preparacion Especial</u>
                <br><br>
                <label class="radio-inline"><input type="radio" name="optradioE" value=60>60 %</label><br>
                <label class="radio-inline"><input type="radio" name="optradioE" value=50>50 %</label><br>
                <label class="radio-inline"><input type="radio" name="optradioE" value=40>40 %</label><br>
                <br><br>
                <label>Tiempo en semanas: </label>
                <label> 30 </label> Semanas.
              </center>
            </div>           

            <div class="col-xs-6">
              <label>Mesociclos:</label>
                <input type="text" class="form-control" id="imputCiclosPG">
            </div>

            <div class="col-xs-6">
              <label>Mesociclos:</label>
                <input type="text" class="form-control" id="imputCiclosPE">
            </div>

        </div>
      

  
      <div class="col-xs-12 col-sm-6" >
      <br>
      <div class="col-xs-12" id="inline_content2">
             <center>
                <h4><u>Competitivo</u></h4>
                <br>
                <label class="radio-inline"><input type="radio" name="optradioSC" value=60 id="c1">60 %</label>
                <label class="radio-inline"><input type="radio" name="optradioSC" value=50  id="c2">50 %</label>
                <label class="radio-inline"><input type="radio" name="optradioSC" value=40  id="c3">40 %</label>
                <br><br>
                <label>Tiempo en semanas: </label>
                <label> 30 </label> Semanas.
              </center>
              </div>         
              <div class="col-xs-12 col-sm-6" id="precomp1">
                <center>
                  <u>Pre Competitivo</u>
                  <br><br>
                  <label class="radio-inline"><input type="radio" name="optradioPC" value=60>60 %</label><br>
                  <label class="radio-inline"><input type="radio" name="optradioPC" value=50>50 %</label><br>
                  <label class="radio-inline"><input type="radio" name="optradioPC" value=40>40 %</label><br>
                  <br><br>
                  <label>Tiempo en semanas: </label>
                  <label> 30 </label> Semanas.
                </center>
              </div>

              <div class="col-xs-12 col-sm-6" id="comp1">
                <center>
                  <u>Competitivo</u>
                  <br><br>
                  <label class="radio-inline"><input type="radio" name="optradioCOM" value=60>60 %</label><br>
                  <label class="radio-inline"><input type="radio" name="optradioCOM" value=50>50 %</label><br>
                  <label class="radio-inline"><input type="radio" name="optradioCOM" value=40>40 %</label><br>
                  <br><br> 
                  <label>Tiempo en semanas: </label>
                  <label> 30 </label> Semanas.
                </center>
              </div>

           

            <div class="col-xs-6">
              <label>Mesociclos:</label>
              <input type="text" class="form-control" id="imputCiclosPC">
            </div>

            <div class="col-xs-6">
              <label>Mesociclos:</label>
              <input type="text" class="form-control" id="imputCiclosC">
            </div> 
        
      </div>
    </div>

    <!-- CONTENEDOR DEL ENTRENAMIENTO COMPETITIVO -->

    <div class="col-md-3 col-xs-offset-10 row">
    <br>
      <button type="button" class="btn btn-success" data-dixsiss="modal" id="btnCotinnuar">Continuar</button>
    </div>
  </div>




    <!-- TERCER PANEL -->
    <div role="tabpanel" class="tab-pane" id="mesociclos">
      
      <div class="row">
        <!-- PRIMER TABLA-->
        <div class="col-md-6">
          <label>Preparacion General</label>

          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Ciclo</th>
                <th>Tiempo</th> 
              </tr>
            </thead>

            <tbody id="cuerpoTablaPG">
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>   
          
          </table>
        </div>
          
        <!-- SEGUNDA TABLA-->
        <div class="col-md-6">
          <label>Preparacion Especial</label>

          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Ciclo</th>
                <th>Tiempo</th> 
              </tr>
            </thead>

            <tbody id="cuerpoTablaPE">
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>  
          </table>
        </div>
        
      </div>

      <!-- TERCERA TABLA-->
      <div class="row">
        <div class="col-md-6">
          <label>Pre competitivo</label>

          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Ciclo</th>
                <th>Tiempo</th> 
              </tr>
            </thead>

              <tbody id="cuerpoTablaPC">
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
          
    <!-- CUARTA TABLA-->
      <div class="col-md-6">
        <label>Competitivo</label>

        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Ciclo</th>
              <th>Tiempo</th> 
            </tr>
          </thead>

          <tbody id="cuerpoTablaC">
            <tr>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 col-xs-offset-10 row">
        <button type="button" class="btn btn-success" data-dixsiss="modal" id="btnCotinnuar">Continuar</button>
      </div>
    </div>
  
  </div>

<!-- Cuarto Panel -->
<div role="tabpanel" class="tab-pane" id="direcciones">

<!--  definicion de lugar (center) -->
  <div id="home" class="tab-pane fade in active">
                  <div class="col-md-3">
                            <div class="row">
                                    <div><center><h4> Preparacion<BR>General</h4></center>
                                <div class="col-xs-7 col-md-7">
                              <div class="form-group" align="center" ><h6>Tecnico</h6></div>
                              <div class="form-group" align="center" ><h6>Tecnico Fisico</h6></div>
                              <div class="form-group" align="center"><h6>Tecnico Tactico</h6></div>  
                              <div class="form-group" align="center"><h6>Pre Psicologico</h6></div>
                              <div class="form-group" align="center"><h6>Competencia</h6></div>
                              <div class="form-group" align="center" ><h6>Total</h6></div>
                                </div>
                                <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                                          <form class="form-inline text-left" role="form" name="colum1" action="" method="post">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                            <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col1(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" id="res_col1" name="colum1" placeholder="0" maxlength="3" size="1" disabled/>
                                    </form>
                                </div>
                            </div>         
                            </div>

                    </div>                     
                  <div class="col-md-3">
                            <div class="row">
                                    <div> <center><h4> Preparacion<BR>Especial</h4></cemter>
                                <div class="col-xs-7 col-md-7">
                              <div class="form-group" align="center" ><h6>Tecnico</h6></div>
                              <div class="form-group" align="center" ><h6>Tecnico Ficico</h6></div>
                              <div class="form-group" align="center"><h6>Tecnico Tactico</h6></div>  
                              <div class="form-group" align="center"><h6>Pre<BR>Psicologico</h6></div>
                              <div class="form-group" align="center"><h6>Competencia</h6></div>
                              <div class="form-group" align="center" ><h6>Total</h6></div>
                                </div>
                                <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                                      <form class="form-inline text-left" role="form" name="colum2" action="" method="post" >
                                          
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col2(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" id="res_col2" name="colum2" placeholder="0" maxlength="3" size="1" disabled/>
                                    </form>
                                </div>
                            </div>         
                            </div>

                    </div>                     
                  <div class="col-md-3">
                            <div class="row">
                                    <div><center><h4> Pre<BR>Competitivo</h4></center>
                                <div class="col-xs-7 col-md-7">
                              <div class="form-group" align="center" ><h6>Tecnico</h6></div>
                              <div class="form-group" align="center" ><h6>Tecnico Fisico</h6></div>
                              <div class="form-group" align="center"><h6>Tecnico Tactico</h6></div>  
                              <div class="form-group" align="center"><h6>Pre<BR>Psicologico</h6></div>
                              <div class="form-group" align="center"><h6>Competencia</h6></div>
                              <div class="form-group" align="center" ><h6>Total</h6></div>
                                </div>
                                <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                                          <form class="form-inline text-left" role="form" name="colum3" action="" method="post">
                                          
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col3(this);" maxlength="2" size="1" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    <input type="text" class="form-control" id="res_col3" name="colum3" placeholder="0" maxlength="3" size="1" disabled/>
                                    </form>
                                </div>
                            </div>         
                            </div>

                    </div>                     
                  <div class="col-md-3">
                            <div class="row">
                                    <div><center><h4><BR>Competitivo</h4></center>
                                <div class="col-xs-7 col-md-7">
                              <div class="form-group" align="center" ><h6>Tecnico</h6></div>
                              <div class="form-group" align="center" ><h6>Tecnico Fisico</h6></div>
                              <div class="form-group" align="center"><h6>Tecnico Tactico</h6></div>  
                              <div class="form-group" align="center"><h6>Pre<BR>Psicologico</h6></div>
                              <div class="form-group" align="center"><h6>Competencia</h6></div>
                              <div class="form-group" align="center" ><h6>Total</h6></div>
                                </div>
                                <div class="col-xs-5 col-md-1"style="line-height: 2.7" >
                                          <form class="form-inline text-left" role="form" name="colum4" action="" method="post">
                                          
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"> 
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                      <input type="text" class="form-control" name="sum[]" placeholder="0" onkeyup="sumar_col4(this);" maxlength="2" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    <input type="text" class="form-control" id="res_col4" name="colum4" placeholder="0" maxlength="3" size="1" disabled/>
                                    </form>
                                </div>
                            </div>         
                            </div>

            </div>
            <br><br>
                  <div class="col-xs-offset-8 col-xs-4">
                  <br><br>
                    <form id="form" name="gua">
                      <input type="button" class="btn btn-success" onclick="guardar()" value="Guardar" method="post" value="POST VAL"/>
                      <input type="button" class="btn btn-success" onclick="#" name="proyecto" value="Proyecto" id="to" value="POST VAL" disabled />
                    </form>
                  </div>
                  </div>
</div>
</div>
</div>

<script type="text/javascript" src="/Desarrollo_SSPED/Futbol/Programacion/cargarTablasProgramacion.js"></script>