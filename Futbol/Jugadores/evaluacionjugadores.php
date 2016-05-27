 <?php 
      include("llenado_selects.php");
  ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(function() 
    {
      $('#generareva').on('click', function()
      {
        $('#equipo-cre').prop('disabled',true);
        $('#plan-cre').prop('disabled',true);
        $('#etapas-cre').prop('disabled',true);
        $('#meso-cre').prop('disabled',true);
        var plan=$("#plan-cre").val();
        var idequipo = $('#equipo-cre').val();
        var meso=$('#meso-cre').val();
        var etapa=$('#etapas-cre').val();
        var o = "equipo="+ encodeURIComponent(idequipo)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+encodeURIComponent(plan)+"&opc="+encodeURIComponent('clases')+"&etapa="+encodeURIComponent(etapa);
        console.log(o);
        $.ajax
        ({
          url:"llenar_tabla.php",
          type: "POST",
          data:o,
          success: function(micro)
          {
            console.log(micro);
            llenar_tabla($('#equipo-cre').val())            
          }
        })
      });

      $('#generarsegui_eva').on('click', function()
      {
        $('#equipo-crea').prop('disabled',true);
        $('#plan-crea').prop('disabled',true);
        $('#etapas-crea').prop('disabled',true);
        $('#meso-crea').prop('disabled',true);
 
        var plan=$("#plan-crea").val();
        var idequipo = $('#equipo-crea').val();
        var meso=$('#meso-crea').val();
        var etapa=$('#etapas-crea').val();
        var o = "equipo="+ encodeURIComponent(idequipo)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+encodeURIComponent(plan)+"&opc="+encodeURIComponent('clases')+"&etapa="+encodeURIComponent(etapa);
        console.log(o);
        $.ajax
        ({
          url:"llenar_tabla.php",
          type: "POST",
          data:o,
          success: function(micro)
          {
            console.log(micro);
            llenar_tabla_seguimiento($('#equipo-crea').val());
          }
        })
      })

      $("#btnguarda_eva").on('click', function(){
        guarda_evaluacion();
      })



        $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

        $("#equipo-cre").change(function(){
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:"equipo-cre="+$("#equipo-cre").val(),
            success: function(plan){
              $("#plan-cre").html(plan);
              
            }
          })
        });


        $("#equipo-crea").change(function(){
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:"equipo-cre="+$("#equipo-crea").val(),
            success: function(plan){
              $("#plan-crea").html(plan);
              
            }
          })
        });


        //Si selecciona otro Equipo limpia todo y LLENA SELECT fechas
        $("#plan-cre").change(function(){
          var idequipo = $('#equipo-cre').val();
          var idplan= $("#plan-cre").val();
          var o = "idplan="+encodeURIComponent(idplan)+"&equipo="+ encodeURIComponent(idequipo);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(plan){
              $("#plan-cre-fecha").html(plan);
              $('#etapas-cre').val(0);
              $('#meso-cre').val(0);
              $('#micro-cre').val(0);
            }
          })
        });

        //Si selecciona otro Equipo limpia todo y LLENA SELECT fechas
        $("#plan-crea").change(function(){
          var idequipo = $('#equipo-crea').val();
          var idplan= $("#plan-crea").val();
          var o = "idplan="+encodeURIComponent(idplan)+"&equipo="+ encodeURIComponent(idequipo);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(plan){
              $("#plan-cre-fecha").html(plan);
              $('#etapas-crea').val(0);
              $('#meso-crea').val(0);
              $('#micro-crea').val(0);
            }
          })
        });

//Llenar mesociclos
     $("#etapas-cre").change(function(){
            $('#meso-cre').val(0);
            var idequipo = $('#equipo-cre').val();
            var fecha= $("#plan-cre-fecha").val();
            var idetapas=$("#etapas-cre").val();
            var plan=$("#plan-cre").val();
            console.log(idetapas);
            var o = "fecha="+encodeURIComponent(fecha)+"&equipo="+ encodeURIComponent(idequipo)+"&etapas="+ encodeURIComponent(idetapas)+"&plan="+ encodeURIComponent(plan);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(meso){
              $("#meso-cre").html(meso);             
              $('#micro-cre').val(0);
            }
          })
        });

     //Llenar mesociclos
     $("#etapas-crea").change(function(){
            $('#meso-crea').val(0);
            var idequipo = $('#equipo-crea').val();
            var fecha= $("#plan-cre-fecha").val();
            var idetapas=$("#etapas-crea").val();
            var plan=$("#plan-crea").val();
            console.log(idetapas);
            var o = "fecha="+encodeURIComponent(fecha)+"&equipo="+ encodeURIComponent(idequipo)+"&etapas="+ encodeURIComponent(idetapas)+"&plan="+ encodeURIComponent(plan);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(meso){
              $("#meso-crea").html(meso);             
              $('#micro-crea').val(0);
            }
          })
        });


//Llenar microciclos
       $("#meso-cre").change(function(){
        $('#formCreacion :checked').removeAttr('checked');
            var plan=$("#plan-cre").val();
            var idequipo = $('#equipo-cre').val();
            var meso=$('#meso-cre').val();
            var o = "equipo="+ encodeURIComponent(idequipo)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(micro){
              console.log(micro);
              $("#micro-cre").html(micro);
              document.formCreacioneva.generareva.disabled=false;
            }
          })
        });



//Llenar microciclos
       $("#meso-crea").change(function(){      
            var plan=$("#plan-crea").val();
            var idequipo = $('#equipo-crea').val();
            var meso=$('#meso-crea').val();
            var o = "equipo="+ encodeURIComponent(idequipo)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(micro){
              console.log(micro);
              document.formseguieva.generarsegui_eva.disabled=false;
            }
          })
        });


       $(".botonExcel").on('click', function(){
          $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
          $("#FormularioExportacion").submit();
       })

      })

    function llenar_tabla(equipo)
    {
      cont_evaluacion=0;
      var equipoid = equipo;
      var opcion = 'llenado';
      console.log(equipoid);
      $.ajax(
      {
        url: 'llenar_tabla.php',
        type: 'POST',
        data: {ide:equipoid, opc:opcion}
      })
      .done(function(data) 
      {
        var resp = $.parseJSON(data);
        var pts = 100;
        var nota = '<br>'+
                    '<div class="alert alert-info" role="alert">'+
                      'Nota.<br>'+
                      '<p>Los siguientes valores estan permitidos para la evaluacion.</p>'+
                      '<p><b>M =</b> 20 pts. ; <b>R =</b> 40 pts. ; <b>B =</b> 60 pts. ; <b>MB =</b> 80 pts. ; <b>E =</b> 100 pts.</p>'+
                    '</div>';
        var nombre = '<table class="table table-bordered" align="center" id="tblevaluacion">'+
                    '<thead>'+
                        '<tr>'+
                          '<th style="visibility:hidden;">.</th>'+
                          '<th colspan="5"><center>Evaluacion Analitica</center></th>'+
                          '<th colspan="3"><center>Evaluacion Global</center></th>'+
                          '<th colspan="3"><center>Evaluacion Fisica</center></th>'+
                          '<th><center>Asistencia</center></th>'+
                          '<th colspan="2"><center>Total</center></th>'+
                        '<tr>'+
                        '<form class="form-inline text-left" role="form" name="form_eva" method="post">'+
                        '<tr>'+
                            '<th id="t1">Nombre_Jugador</th>'+
                            '<th id="t2" contenteditable="true">EVAA_1 </th>'+
                            '<th id="t3" contenteditable="true">EVAA_2 </th>'+
                            '<th id="t4" contenteditable="true">EVAA_3 </th>'+
                            '<th id="t5" contenteditable="true">EVAA_4 </th>'+
                            '<th id="t6" contenteditable="false">TOTAL</th>'+
                            '<th id="t7" contenteditable="true">EVAG_1 </th>'+
                            '<th id="t8" contenteditable="true">EVAG_2 </th>'+
                            '<th id="t9" contenteditable="false">TOTAL </th>'+
                            '<th id="t10" contenteditable="true">EVAF_1 </th>'+
                            '<th id="t11" contenteditable="true">EVAF_2 </th>'+
                            '<th id="t12" contenteditable="false">TOTAL </th>'+
                            '<th id="t13" contenteditable="false">TOT_ASI</th>'+
                            '<th id="t14" contenteditable="false">TOT_No</th>'+
                            '<th id="t15" contenteditable="false">TOT_Lit</th>'+
                        '</tr>'+

                    '</thead>'+
                    '<tbody>';
                    for(i in resp)
                    { 
                      if(resp[i].res==1)
                      {
                        nombre += '<tr>'+
                                  '<td id="nomb_'+i+'">'+resp[i].nombre_ju+' '+resp[i].apellidop_ju+' '+resp[i].apellidom_ju+'</td>'+
                                  //Notas Evaluacion Analitica
                            '<td><input id="sa1'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa2'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa3'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa4'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            //Resultado Analitico
                            '<td contenteditable="false"><input onfocus="sumar_analitico('+i+')" type="text" class="form-control" maxlength="2" id="totana'+i+'" readonly=""/></td>'+
                            //inputs evaluacion global
                            '<td><input id="sg1'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            '<td><input id="sg2'+i+'" onkeypress="return soloLetras(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            //Resultado Global
                            '<td contenteditable="false"><input onfocus="sumar_global('+i+')" type="text" class="form-control" maxlength="2" id="totglob'+i+'" readonly=""/></td>'+
                            // inputs evaluacion fisica
                            '<td><input id="sf1'+i+'" type="text" onkeypress="return soloLetras(event)" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sf2'+i+'" type="text" onkeypress="return soloLetras(event)" value=0 class="form-control" maxlength="2"/></td>'+
                            //Resultado Fisica
                            '<td contenteditable="false"><input onfocus="sumar_fisica('+i+')" type="text" class="form-control" maxlength="2" id="totfis'+i+'" readonly=""/></td>'+
                            //Nota Evaluacion
                            '<td contenteditable="false"><input type="text" class="form-control" maxlength="2" id="totasi'+i+'"   readonly=""/></td>'+
                            //Nota Total numerica
                            '<td><input onfocus="sumar_total('+i+')" type="text" class="form-control" placeholder="0" value="0" id="total'+i+'" readonly></td>'+

                            '<td><input onfocus="total_literal('+i+')" type="text" class="form-control" placeholder="0" value="0" id="total_lit'+i+'" readonly></td>'+
                            '</tr>';;
                      }
                      cont_evaluacion++;
                    }

                    nombre += '</tr>'+
                              '</form>'
                              '</tbody>'+
                              '</table>';
        $('#nota').html(nota);
        $('#nombre').html(nombre);
        document.formCreacioneva.generareva.disabled=true;
        document.formboton_eva.btnguarda_eva.disabled=false;
        
        })
        .fail(function() 
        {
          console.log("error");
        })
          event.preventDefault();        
    }

    var cont_evaluacion;
    function llenar_tabla_seguimiento(equipo)
    {
      cont_evaluacion=0;
      var equipoid = equipo;
      var opcion = 'llenado';
      console.log(equipoid);
      $.ajax(
      {
        url: 'llenar_tabla.php',
        type: 'POST',
        data: {ide:equipoid, opc:opcion}
      })
      .done(function(data) 
      {
        var resp = $.parseJSON(data);
        var pts = 100;
        var nota = '<br>'+
                    '<div class="alert alert-info" role="alert">'+
                      'Nota.<br>'+
                      '<p>Los siguientes valores estan permitidos para la evaluacion.</p>'+
                      '<p><b>M =</b> 20 pts. ; <b>R =</b> 40 pts. ; <b>B =</b> 60 pts. ; <b>MB =</b> 80 pts. ; <b>E =</b> 100 pts.</p>'+
                    '</div>';
        var nombre = '<table class="table table-bordered" align="center" id="tblevaluacion">'+
                    '<thead>'+
                        '<tr>'+
                          '<th style="visibility:hidden;">.</th>'+
                          '<th colspan="5"><center>Evaluacion Analitica</center></th>'+
                          '<th colspan="3"><center>Evaluacion Global</center></th>'+
                          '<th colspan="3"><center>Evaluacion Fisica</center></th>'+
                          '<th><center>Asistencia</center></th>'+
                          '<th colspan="2"><center>Total</center></th>'+
                        '<tr>'+
                        '<form class="form-inline text-left" role="form" name="form_eva" method="post">'+
                        '<tr>'+
                            '<th>Nombre_Jugador</th>'+
                            '<th contenteditable="true">EVAA_1 </th>'+
                            '<th contenteditable="true">EVAA_2 </th>'+
                            '<th contenteditable="true">EVAA_3 </th>'+
                            '<th contenteditable="true">EVAA_4 </th>'+
                            '<th contenteditable="false">TOTAL</th>'+
                            '<th contenteditable="true">EVAG_1 </th>'+
                            '<th contenteditable="true">EVAG_2 </th>'+
                            '<th contenteditable="false">TOTAL </th>'+
                            '<th contenteditable="true">EVAF_1 </th>'+
                            '<th contenteditable="true">EVAF_2 </th>'+
                            '<th contenteditable="false">TOTAL </th>'+
                            '<th contenteditable="false">TOT_ASI</th>'+
                            '<th contenteditable="false">TOT_No</th>'+
                            '<th contenteditable="false">TOT_Lit</th>'+
                        '</tr>'+

                    '</thead>'+
                    '<tbody>';

                    for(i in resp)
                    { 
                      if(resp[i].res==1)
                      {
                      
                        nombre += '<tr>'+
                                  '<td>'+resp[i].nombre_ju+' '+resp[i].apellidop_ju+' '+resp[i].apellidom_ju+'</td>'+
                                  //Notas Evaluacion Analitica
                            '<td><input id="sa1_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa2_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa3_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sa4_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            //Resultado Analitico
                            '<td contenteditable="false"><input onfocus="sumar_analitico_segui('+i+')" type="text" class="form-control" maxlength="2" id="totana_segui'+i+'" readonly=""/></td>'+
                            //inputs evaluacion global
                            '<td><input id="sg1_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            '<td><input id="sg2_segui'+i+'" onkeypress="return soloLetras_segui(event)" type="text" value=0 class="form-control" maxlength="2" /></td>'+
                            //Resultado Global
                            '<td contenteditable="false"><input onfocus="sumar_global_segui('+i+')" type="text" class="form-control" maxlength="2" id="totglob_segui'+i+'" readonly=""/></td>'+
                            // inputs evaluacion fisica
                            '<td><input id="sf1_segui'+i+'" type="text" onkeypress="return soloLetras_segui(event)" value=0 class="form-control" maxlength="2"/></td>'+
                            '<td><input id="sf2_segui'+i+'" type="text" onkeypress="return soloLetras_segui(event)" value=0 class="form-control" maxlength="2"/></td>'+
                            //Resultado Fisica
                            '<td contenteditable="false"><input onfocus="sumar_fisica_segui('+i+')" type="text" class="form-control" maxlength="2" id="totfis_segui'+i+'" readonly=""/></td>'+
                            //Nota Evaluacion
                            '<td contenteditable="false"><input type="text" class="form-control" maxlength="2" id="totasi_segui'+i+'"   readonly=""/></td>'+
                            //Nota Total numerica
                            '<td><input onfocus="sumar_total_segui('+i+')" type="text" class="form-control" placeholder="0" value="0" id="total_segui'+i+'" readonly></td>'+

                            '<td><input onfocus="total_literal_segui('+i+')" type="text" class="form-control" placeholder="0" value="0" id="total_lit_segui'+i+'" readonly></td>'+
                            '</tr>';


                      }
                            
                    }

                    nombre += '</tr>'+
                              '</form>'
                              '</tbody>'+
                              '</table>';
        $('#nota_segui').html(nota);
        $('#nombre_segui').html(nombre);
        
        document.formseguieva.generarsegui_eva.disabled=true;
        document.formbtn_segui.btnguarda_segui.disabled=false;
        
        })
        .fail(function() 
        {
          console.log("error");
        })
          event.preventDefault();        
    }



     function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "bemr";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    function soloLetras_segui(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "bemr";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


    
    function sumar_analitico(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totala=0;
      var valor1 = 0;
      var valor2 = 0;
      var valor3 = 0;
      var valor4 = 0;
      //EVALUACION sa1
      if($('#sa1'+id).val() == 'm' ||  $('#sa1'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sa1'+id).val() == 'r' ||  $('#sa1'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sa1'+id).val() == 'b' ||  $('#sa1'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sa1'+id).val() == 'mb' ||  $('#sa1'+id).val() == 'MB' ||  $('#sa1'+id).val() == 'Mb' ||  $('#sa1'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sa1'+id).val() == 'e' ||  $('#sa1'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
                if($('#sa1'+id).val() == 0)
                {
                  valor1 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa1'+id).val()+' No es un valor permitido</div>'
                  $('#nota1').html(nota);  
                } 
              }
            }
          }
        }
      }
      // EVAKUACION sa2 
      if($('#sa2'+id).val() == 'm' ||  $('#sa2'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sa2'+id).val() == 'r' ||  $('#sa2'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sa2'+id).val() == 'b' ||  $('#sa2'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sa2'+id).val() == 'mb' ||  $('#sa2'+id).val() == 'MB' ||  $('#sa2'+id).val() == 'Mb' ||  $('#sa2'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sa2'+id).val() == 'e' ||  $('#sa2'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
                if($('#sa2'+id).val() == 0)
                {
                  valor2 = 0;
                } 
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa2'+id).val()+' No es un valor permitido</div>'
                  $('#nota2').html(nota);
                }
              }
            }
          }
        }
      }
      // EVALUACION sa3
      if($('#sa3'+id).val() == 'm' ||  $('#sa3'+id).val() == 'M')
      {
        valor3 = 20;
      }else
      {
        if($('#sa3'+id).val() == 'r' ||  $('#sa3'+id).val() == 'R')
        {
          valor3 = 40;
        }
        else
        {
          if($('#sa3'+id).val() == 'b' ||  $('#sa3'+id).val() == 'B')
          {
            valor3 = 60;
          }
          else
          {
            if($('#sa3'+id).val() == 'mb' ||  $('#sa3'+id).val() == 'MB' ||  $('#sa3'+id).val() == 'Mb' ||  $('#sa3'+id).val() == 'mB')
            {
              valor3 = 80;
            }
            else
            {
              if($('#sa3'+id).val() == 'e' ||  $('#sa3'+id).val() == 'E')
              {
                valor3 = 100;
              }
              else
              {
                if($('#sa3'+id).val() == 0)  
                {
                  valor3 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa3'+id).val()+' No es un valor permitido</div>'
                  $('#nota3').html(nota);
                }
              }
            }
          }
        }
      }
      //EVALUACION sa4
      if($('#sa4'+id).val() == 'm' ||  $('#sa4'+id).val() == 'M')
      {
        valor4 = 20;
      }else
      {
        if($('#sa4'+id).val() == 'r' ||  $('#sa4'+id).val() == 'R')
        {
          valor4 = 40;
        }
        else
        {
          if($('#sa4'+id).val() == 'b' ||  $('#sa4'+id).val() == 'B')
          {
            valor4 = 60;
          }
          else
          {
            if($('#sa4'+id).val() == 'mb' ||  $('#sa4'+id).val() == 'MB' ||  $('#sa4'+id).val() == 'Mb' ||  $('#sa4'+id).val() == 'mB')
            {
              valor4 = 80;
            }
            else
            {
              if($('#sa4'+id).val() == 'e' ||  $('#sa4'+id).val() == 'E')
              {
                valor4 = 100;
              }
              else
              { 
                if($('#sa4'+id).val() == 0)
                {
                  valor4 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa4'+id).val()+' No es un valor permitido</div>'
                  $('#nota4').html(nota); 
                }
              }
            }
          }
        }
      }
      operador='+';
      totala =eval(totala+operador+ valor1+operador+ valor2+operador+ valor3+operador+ valor4);
      var resulta=totala/4; 
      $('#totana'+id).val(resulta);
    }

    function sumar_analitico_segui(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totala=0;
      var valor1 = 0;
      var valor2 = 0;
      var valor3 = 0;
      var valor4 = 0;
      //EVALUACION sa1
      if($('#sa1_segui'+id).val() == 'm' ||  $('#sa1_segui'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sa1_segui'+id).val() == 'r' ||  $('#sa1_segui'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sa1_segui'+id).val() == 'b' ||  $('#sa1_segui'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sa1_segui'+id).val() == 'mb' ||  $('#sa1_segui'+id).val() == 'MB' ||  $('#sa1_segui'+id).val() == 'Mb' ||  $('#sa1_segui'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sa1_segui'+id).val() == 'e' ||  $('#sa1_segui'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
                if($('#sa1_segui'+id).val() == 0)
                {
                  valor1 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa1_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota1_segui').html(nota);  
                } 
              }
            }
          }
        }
      }
      // EVAKUACION sa2 
      if($('#sa2_segui'+id).val() == 'm' ||  $('#sa2_segui'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sa2_segui'+id).val() == 'r' ||  $('#sa2_segui'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sa2_segui'+id).val() == 'b' ||  $('#sa2_segui'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sa2_segui'+id).val() == 'mb' ||  $('#sa2_segui'+id).val() == 'MB' ||  $('#sa2_segui'+id).val() == 'Mb' ||  $('#sa2_segui'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sa2_segui'+id).val() == 'e' ||  $('#sa2_segui'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
                if($('#sa2_segui'+id).val() == 0)
                {
                  valor2 = 0;
                } 
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa2_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota2_segui').html(nota);
                }
              }
            }
          }
        }
      }
      // EVALUACION sa3
      if($('#sa3_segui'+id).val() == 'm' ||  $('#sa3_segui'+id).val() == 'M')
      {
        valor3 = 20;
      }else
      {
        if($('#sa3_segui'+id).val() == 'r' ||  $('#sa3_segui'+id).val() == 'R')
        {
          valor3 = 40;
        }
        else
        {
          if($('#sa3_segui'+id).val() == 'b' ||  $('#sa3_segui'+id).val() == 'B')
          {
            valor3 = 60;
          }
          else
          {
            if($('#sa3_segui'+id).val() == 'mb' ||  $('#sa3_segui'+id).val() == 'MB' ||  $('#sa3_segui'+id).val() == 'Mb' ||  $('#sa3_segui'+id).val() == 'mB')
            {
              valor3 = 80;
            }
            else
            {
              if($('#sa3_segui'+id).val() == 'e' ||  $('#sa3_segui'+id).val() == 'E')
              {
                valor3 = 100;
              }
              else
              {
                if($('#sa3_segui'+id).val() == 0)  
                {
                  valor3 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa3_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota3_segui').html(nota);
                }
              }
            }
          }
        }
      }
      //EVALUACION sa4
      if($('#sa4_segui'+id).val() == 'm' ||  $('#sa4_segui'+id).val() == 'M')
      {
        valor4 = 20;
      }else
      {
        if($('#sa4_segui'+id).val() == 'r' ||  $('#sa4_segui'+id).val() == 'R')
        {
          valor4 = 40;
        }
        else
        {
          if($('#sa4_segui'+id).val() == 'b' ||  $('#sa4_segui'+id).val() == 'B')
          {
            valor4 = 60;
          }
          else
          {
            if($('#sa4_segui'+id).val() == 'mb' ||  $('#sa4_segui'+id).val() == 'MB' ||  $('#sa4_segui'+id).val() == 'Mb' ||  $('#sa4_segui'+id).val() == 'mB')
            {
              valor4 = 80;
            }
            else
            {
              if($('#sa4_segui'+id).val() == 'e' ||  $('#sa4_segui'+id).val() == 'E')
              {
                valor4 = 100;
              }
              else
              { 
                if($('#sa4_segui'+id).val() == 0)
                {
                  valor4 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sa4_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota4_segui').html(nota); 
                }
              }
            }
          }
        }
      }
      operador='+';
      totala =eval(totala+operador+ valor1+operador+ valor2+operador+ valor3+operador+ valor4);
      var resulta=totala/4; 
      $('#totana_segui'+id).val(resulta);
    }


    function sumar_global(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totalg=0;
      var valor1 = 0;
      var valor2 = 0;
      //EVALUACION sg1
      if($('#sg1'+id).val() == 'm' ||  $('#sg1'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sg1'+id).val() == 'r' ||  $('#sg1'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sg1'+id).val() == 'b' ||  $('#sg1'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sg1'+id).val() == 'mb' ||  $('#sg1'+id).val() == 'MB' ||  $('#sg1'+id).val() == 'Mb' ||  $('#sg1'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sg1'+id).val() == 'e' ||  $('#sg1'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
                if($('#sg1'+id).val() == 0)
                {
                  valor1 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sg1'+id).val()+' No es un valor permitido</div>'
                  $('#nota5').html(nota); 
                }
              }  
            }
          }
        }
      }
      // EVAKUACION sag2 
      if($('#sg2'+id).val() == 'm' ||  $('#sg2'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sg2'+id).val() == 'r' ||  $('#sg2'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sg2'+id).val() == 'b' ||  $('#sg2'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sg2'+id).val() == 'mb' ||  $('#sg2'+id).val() == 'MB' ||  $('#sg2'+id).val() == 'Mb' ||  $('#sg2'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sg2'+id).val() == 'e' ||  $('#sg2'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
               if($('#sg2'+id).val() == 0) 
               {
                valor2 = 0;
               }
               else
               {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sg2'+id).val()+' No es un valor permitido</div>'
                  $('#nota6').html(nota);
               }
              }
            }
          }
        }
      }
      operador='+';
      totalg =eval(totalg+operador+ valor1+operador+ valor2);
      var resulta=totalg/2; 
      $('#totglob'+id).val(resulta);
    }

    function sumar_global_segui(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totalg=0;
      var valor1 = 0;
      var valor2 = 0;
      //EVALUACION sg1
      if($('#sg1_segui'+id).val() == 'm' ||  $('#sg1_segui'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sg1_segui'+id).val() == 'r' ||  $('#sg1_segui'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sg1_segui'+id).val() == 'b' ||  $('#sg1_segui'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sg1_segui'+id).val() == 'mb' ||  $('#sg1_segui'+id).val() == 'MB' ||  $('#sg1_segui'+id).val() == 'Mb' ||  $('#sg1_segui'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sg1_segui'+id).val() == 'e' ||  $('#sg1_segui'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
                if($('#sg1_segui'+id).val() == 0)
                {
                  valor1 = 0;
                }
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sg1_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota5_segui').html(nota); 
                }
              }  
            }
          }
        }
      }
      // EVAKUACION sag2 
      if($('#sg2_segui'+id).val() == 'm' ||  $('#sg2_segui'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sg2_segui'+id).val() == 'r' ||  $('#sg2_segui'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sg2_segui'+id).val() == 'b' ||  $('#sg2_segui'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sg2_segui'+id).val() == 'mb' ||  $('#sg2_segui'+id).val() == 'MB' ||  $('#sg2_segui'+id).val() == 'Mb' ||  $('#sg2_segui'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sg2_segui'+id).val() == 'e' ||  $('#sg2_segui'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
               if($('#sg2_segui'+id).val() == 0) 
               {
                valor2 = 0;
               }
               else
               {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sg2_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota6_segui').html(nota);
               }
              }
            }
          }
        }
      }
      operador='+';
      totalg =eval(totalg+operador+ valor1+operador+ valor2);
      var resulta=totalg/2; 
      $('#totglob_segui'+id).val(resulta);
    }

    function sumar_fisica(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totalf=0;
      var valor1 = 0;
      var valor2 = 0;
      //EVALUACION sf1
      if($('#sf1'+id).val() == 'm' ||  $('#sf1'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sf1'+id).val() == 'r' ||  $('#sf1'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sf1'+id).val() == 'b' ||  $('#sf1'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sf1'+id).val() == 'mb' ||  $('#sf1'+id).val() == 'MB' ||  $('#sf1'+id).val() == 'Mb' ||  $('#sf1'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sf1'+id).val() == 'e' ||  $('#sf1'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
               if($('#sf1'+id).val() == 0)
               {
                valor1 = 0;
               } 
               else
               {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sf1'+id).val()+' No es un valor permitido</div>'
                  $('#nota7').html(nota);
               }
              }
            }
          }
        }
      }
      // EVAKUACION sf2 
      if($('#sf2'+id).val() == 'm' ||  $('#sf2'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sf2'+id).val() == 'r' ||  $('#sf2'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sf2'+id).val() == 'b' ||  $('#sf2'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sf2'+id).val() == 'mb' ||  $('#sf2'+id).val() == 'MB' ||  $('#sf2'+id).val() == 'Mb' ||  $('#sf2'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sf2'+id).val() == 'e' ||  $('#sf2'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
                if($('#sf2'+id).val() == 0)
                {
                  valor2 = 0;
                } 
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sf2'+id).val()+' No es un valor permitido</div>'
                  $('#nota8').html(nota);
                }
              }
            }
          }
        }
      }
      operador='+';
      totalf =eval(totalf+operador+ valor1+operador+ valor2);
      var resulta=totalf/2; 
      $('#totfis'+id).val(resulta);
    }


function sumar_fisica_segui(id) 
    {
      setTimeout("$('.ocultar').hide();", 4000);
      var totalf=0;
      var valor1 = 0;
      var valor2 = 0;
      //EVALUACION sf1
      if($('#sf1_segui'+id).val() == 'm' ||  $('#sf1_segui'+id).val() == 'M')
      {
        valor1 = 20;
      }else
      {
        if($('#sf1_segui'+id).val() == 'r' ||  $('#sf1_segui'+id).val() == 'R')
        {
          valor1 = 40;
        }
        else
        {
          if($('#sf1_segui'+id).val() == 'b' ||  $('#sf1_segui'+id).val() == 'B')
          {
            valor1 = 60;
          }
          else
          {
            if($('#sf1_segui'+id).val() == 'mb' ||  $('#sf1_segui'+id).val() == 'MB' ||  $('#sf1_segui'+id).val() == 'Mb' ||  $('#sf1_segui'+id).val() == 'mB')
            {
              valor1 = 80;
            }
            else
            {
              if($('#sf1_segui'+id).val() == 'e' ||  $('#sf1_segui'+id).val() == 'E')
              {
                valor1 = 100;
              }
              else
              {
               if($('#sf1_segui'+id).val() == 0)
               {
                valor1 = 0;
               } 
               else
               {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sf1_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota7_segui').html(nota);
               }
              }
            }
          }
        }
      }
      // EVAKUACION sf2 
      if($('#sf2_segui'+id).val() == 'm' ||  $('#sf2_segui'+id).val() == 'M')
      {
        valor2 = 20;
      }else
      {
        if($('#sf2_segui'+id).val() == 'r' ||  $('#sf2_segui'+id).val() == 'R')
        {
          valor2 = 40;
        }
        else
        {
          if($('#sf2_segui'+id).val() == 'b' ||  $('#sf2_segui'+id).val() == 'B')
          {
            valor2 = 60;
          }
          else
          {
            if($('#sf2_segui'+id).val() == 'mb' ||  $('#sf2_segui'+id).val() == 'MB' ||  $('#sf2_segui'+id).val() == 'Mb' ||  $('#sf2_segui'+id).val() == 'mB')
            {
              valor2 = 80;
            }
            else
            {
              if($('#sf2_segui'+id).val() == 'e' ||  $('#sf2_segui'+id).val() == 'E')
              {
                valor2 = 100;
              }
              else
              {
                if($('#sf2_segui'+id).val() == 0)
                {
                  valor2 = 0;
                } 
                else
                {
                  var nota = '<div class="alert alert-danger ocultar" role="alert">'+$('#sf2_segui'+id).val()+' No es un valor permitido</div>'
                  $('#nota8_segui').html(nota);
                }
              }
            }
          }
        }
      }
      operador='+';
      totalf =eval(totalf+operador+ valor1+operador+ valor2);
      var resulta=totalf/2; 
      $('#totfis_segui'+id).val(resulta);
    }


    function sumar_total(id)
    {
      var total=0;
      var valor1 = $('#totana'+id).val()*0.30;
      var valor2 = $('#totglob'+id).val()*0.20;
      var valor3 = $('#totfis'+id).val()*0.10;
      var valor4 = $('#totasi'+id).val()*0.40;

      total =eval(total+operador+ valor1+operador+ valor2+operador+ valor3+operador+ valor4);
      $('#total'+id).val(total);
    }

    function sumar_total_segui(id)
    {
      var total=0;
      var valor1 = $('#totana_segui'+id).val()*0.30;
      var valor2 = $('#totglob_segui'+id).val()*0.20;
      var valor3 = $('#totfis_segui'+id).val()*0.10;
      var valor4 = $('#totasi_segui'+id).val()*0.40;

      total =eval(total+operador+ valor1+operador+ valor2+operador+ valor3+operador+ valor4);
      $('#total_segui'+id).val(total);
    }

    function total_literal(id)
    {
      var total_lit;
      var total_num = $('#total'+id).val();

      if(total_num >=0 && total_num<=20)
      {
        total_lit = 'M';
        $('#total_lit'+id).val(total_lit);
      }
      if(total_num >=21 && total_num<=40)
      {
        total_lit = 'R';
        $('#total_lit'+id).val(total_lit);
      }
      if(total_num >=41 && total_num<=60)
      {
        total_lit = 'B';
        $('#total_lit'+id).val(total_lit);
      }
      if(total_num >61 && total_num<=80)
      {
        total_lit = 'MB';
        $('#total_lit'+id).val(total_lit);
      }
      if(total_num >81 && total_num<=100)
      {
        total_lit = 'E';
        $('#total_lit'+id).val(total_lit);
      }      
    }

    function total_literal_segui(id)
    {
      var total_lit;
      var total_num = $('#total_segui'+id).val();

      if(total_num >=0 && total_num<=20)
      {
        total_lit = 'M';
        $('#total_lit_segui'+id).val(total_lit);
      }
      if(total_num >=21 && total_num<=40)
      {
        total_lit = 'R';
        $('#total_lit_segui'+id).val(total_lit);
      }
      if(total_num >=41 && total_num<=60)
      {
        total_lit = 'B';
        $('#total_lit_segui'+id).val(total_lit);
      }
      if(total_num >61 && total_num<=80)
      {
        total_lit = 'MB';
        $('#total_lit_segui'+id).val(total_lit);
      }
      if(total_num >81 && total_num<=100)
      {
        total_lit = 'E';
        $('#total_lit_segui'+id).val(total_lit);
      }      
    }

    function guarda_evaluacion()
    {

      /*console.log($('#nombre').find('#nomb_0').text());
      console.log($('#nombre').find('#sa10').val());*/
      var plan=$("#plan-cre").val();
      var idequipo = $('#equipo-cre').val();
      var meso=$('#meso-cre').val();
      var etapa=$('#etapas-cre').val();

      var etapa=$('#etapas-cre').val();
     console.log(cont_evaluacion);
     
var arr2= [];

      for(j=2; j<=15; j++)
      {
      
         arr2.push($('#nombre').find('#t'+j+'').text());
         
      }
      var arrFinal = [];

      for(i=0; i<cont_evaluacion;i++)
      {
      var arr1 = [];   
        arr1.push($('#nombre').find('#nomb_'+i+'').text());
        arr1.push($('#nombre').find('#sa1'+i+'').val());
        arr1.push($('#nombre').find('#sa2'+i+'').val());
        arr1.push($('#nombre').find('#sa3'+i+'').val());
        arr1.push($('#nombre').find('#sa4'+i+'').val());
        arr1.push($('#nombre').find('#totana'+i+'').val());
        arr1.push($('#nombre').find('#sg1'+i+'').val());
        arr1.push($('#nombre').find('#sg2'+i+'').val());
        arr1.push($('#nombre').find('#totglob'+i+'').val());
        arr1.push($('#nombre').find('#sf1'+i+'').val());
        arr1.push($('#nombre').find('#sf2'+i+'').val());
        arr1.push($('#nombre').find('#totfis'+i+'').val());
        arr1.push($('#nombre').find('#totasi'+i+'').val());
        arr1.push($('#nombre').find('#total'+i+'').val());
        arr1.push($('#nombre').find('#total_lit'+i+'').val());

        arrFinal.push(arr1);

      }

      var o = "plansub="+ encodeURIComponent(idequipo)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+encodeURIComponent(plan)+"&opcion="+encodeURIComponent('insertar_evaluacion')+"&etapa="+encodeURIComponent(etapa)+"&datos_tabla="+arrFinal+"&datos_cabecera="+arr2;

      console.log(o);


      $.ajax({
            url: 'jugadores.php',
            type: 'POST',
            data: o
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp.query);
            var t= resp.resp; 
            if(t==1)
            {
              console.log('insertados los nombres');
            }
          })
          .fail(function() {
            console.log("error");
          })
          event.preventDefault();

    }


    </script>
</head>
<body>
<!--  llamada a la cabecera -->
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/cabecera1.php";
    ?>
    <?php 
    require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/barramenureg.php";
  ?>

      <!--  llamada a menu de opciones futbol vertical -->
      <?php 
      require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listabotones1.php";
    ?>
 
  <!--  llamada a menu de opciones futbol horizontal -->
    <?php
      require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/listahorizontal.php";
    ?>


<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      Evaluaci&oacute;n
    </div> 
    <div class="panel-body" >
      <div>
      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Evaluacion</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Seguimiento</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/Jugadores/creaeva.php";
            ?>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/Jugadores/sigueeva.php";
            ?>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="ficheroExcel.php" method="post" id="FormularioExportacion" class="form-inline">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel" align="center">Nombre del Fichero</h3>
            </div>
            <div class="modal-body" align="center">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre del Fichero" value="" required><br>
                <strong>Imprimir en: </strong><br>
                <select class="form-control" name="imp">
                    <option value="excel">Hoja de Excel</option>
                    <option value="pdf">Archivo PDF</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong></button>
                <button type="submit" class="btn btn-success botonExcel"><i class="icon-print"></i> <strong>Imprimir Reporte</strong></button>
                <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            </div>
            </form>
    </div>
  </div>
</div>