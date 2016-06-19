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
    <div class="panel-heading">
      Plan Escrito
    </div>
    <div class="panel-body">
      <div class="panel panel-default">
        <div class="panel-body">
          <center><h4><u>PLAN ESCRITO</u></h4></center>
          <br>
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-1 control-label">Deporte:</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="" value="Triatlon" readonly="">
              </div>
              <label class="col-sm-1 control-label">Año:</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="" value="2016" readonly="">
              </div>
              <label class="col-sm-2 control-label">Instituci&oacute;n:</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="" placeholder="Instituci&oacute;n">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="row">
                <div class="col-sm-12">
                  An&aacute;lisis del Macro anterior. 
                </div>
              </div>
              <div class="row" >
                <div class="col-sm-5">En el macro anterior se realizo un VG en: </div><div class="col-sm-3"><input type="text" class="form-control"></div>
              </div>
              <div class="row">
                <div class="col-sm-2">Nataci&oacute;n:</div><div class="col-sm-2"><input type="text" class="form-control"></div>
                <div class="col-sm-2">Ciclismo:</div><div class="col-sm-2"><input type="text" class="form-control"></div>
                <div class="col-sm-2">Carrera:</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              </div>
              <div class="row">
                <div class="col-sm-2">Mesociclos:</div><div class="col-sm-2"><input type="text" class="form-control"></div>
                <div class="col-sm-2">Microciclo:</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-12">Cronograma  de los Test. Pedagógicos  por Mesociclos  del macro anterior:</div>
              </div>
              <div class="row">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Mesociclo</th>
                      <th>Tipo_de_Control</th>
                      <th>Objetivos</th>
                      <th>Cumplimiento</th>
                      <th>Si</th>
                      <th>No</th>
                      <th>%Cumplimiento</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h6>COMPORTAMIENTO DE LA ASISTENCIA</h6>
              </div>
            </div> 
            <div class="row">
              <div class="col-xs-12">
                Cuantas veces vinieron y sacar el %
              </div>
            </div>  
            <div class="row">
              <div class="col-sm-6">En el plan general  se realizaron modificaciones:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-sm-1">Lesiones:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-xs-12">De la relación  de los atletas:  Bajas</div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <h4><u>Nuevo Macro de Entrenamiento</u></h4>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <b>1. Objetivos Generales</b>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-xs-12">
                <b>2. Objetivos Espec&iacute;ficos</b>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <b>Objetivos Espec&iacute;ficos por Mesosciclos</b>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-2">Meso 1:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">Comienzo del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">al</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">tiene</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-2">microciclos</div>
            </div>
            <div class="row">        
              <div class="col-sm-2">Tipos de micro</div><div class="col-sm-4"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                Objetivos
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">Meso 2:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">Comienzo del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">al</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">tiene</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-2">microciclos</div>
            </div>
            <div class="row">        
              <div class="col-sm-2">Tipos de micro</div><div class="col-sm-4"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                Objetivos
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">Meso 3:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">Comienzo del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">al</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">tiene</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-2">microciclos</div>
            </div>
            <div class="row">        
              <div class="col-sm-2">Tipos de micro</div><div class="col-sm-4"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                Objetivos
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">Meso 4:</div><div class="col-sm-3"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-sm-2">Comienzo del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">al</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-1">tiene</div><div class="col-sm-2"><input type="text" class="form-control"></div>
              <div class="col-sm-2">microciclos</div>
            </div>
            <div class="row">        
              <div class="col-sm-2">Tipos de micro</div><div class="col-sm-4"><input type="text" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                Objetivos
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
              </div>
            </div>    
            <div class="row">
              <div class="col-xs-12">
                <b><u>CRONOGRAMA DE LOS TEST PEDAG&Oacute;GICOS</u></b>
              </div>
            </div>
            <br>  
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Mesociclo</th>
                      <th>Tipo_de_Control</th>
                      <th>Objetivos</th>
                      <th>Cumplimiento</th>
                      <th>Si</th>
                      <th>No</th>
                      <th>%Cumplimiento</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="checkbox" class=" check form-control"></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>        
            <div class="row">
              <div class="col-xs-12">
                <b><u>CRONOGRAMA DE LOS TEST MEDICOS Y PSICOLOGICOS</u></b>
              </div>
            </div>
            <br>  
            <div class="row">
              <div class="col-xs-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Mesociclo</th>
                      <th>Test</th>
                      <th>Fecha</th>
                      <th>Micro</th>
                      <th>Objetivos</th>
                      <th>Resultados</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>                      
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                    <tr>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                      <td><input type="text" class="form-control"></div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> 
            <div class="row">
              <div class="col-xs-12">
                <h4><b>Nuevo Macro</b></h4>
              </div>
            </div> 
            <div class="row">
              <div class="col-sm-3">El periodo preparatorio del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
            </div>  
            <div class="row">
              <div class="col-sm-2">Competitivo del</div><div class="col-sm-2"><input type="text" class="form-control"></div>
            </div> 
            <div class="row">              
              <div class="col-sm-2">Transito del</div><div class="col-sm-2"><input type="text" class="form-control"></div>              
            </div>  
            <div class="row">
              <div class="col-sm-2">Consta de</div><div class="col-sm-2"><input type="text" class="form-control"></div><div class="col-sm-2">Mesociclos</div>
            </div>
            <div class="row">
              <div class="col-sm-1">Tiene</div><div class="col-sm-2"><input type="text" class="form-control"></div><div class="col-sm-2">Microciclos</div>
            </div>  
            <div class="row">
              <div class="col-xs-12">
                Mesociclos:
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <ul>
                  <li>Meso</li>
                  <li>Meso</li>
                  <li>Meso</li>
                  <li>Meso</li>
                  <li>Meso</li>
                  <li>Meso</li>
                </ul>
              </div>
            </div>
          </form>
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

