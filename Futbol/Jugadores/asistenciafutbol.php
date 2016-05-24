
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
      $('#generarasi').on('click', function()
      {
        $('#equipo-cre').prop('disabled',true);
        $('#plan-cre').prop('disabled',true);
        $('#etapas-cre').prop('disabled',true);
        $('#meso-cre').prop('disabled',true);

        var plan=$("#plan-cre").val();
        var plansub = $('#equipo-cre').val();
        var meso=$('#meso-cre').val();
        var etapa=$('#etapas-cre').val();
        var o = "plansub="+ encodeURIComponent(plansub)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+encodeURIComponent(plan)+"&opc="+encodeURIComponent('clases')+"&etapa="+encodeURIComponent(etapa);
        console.log(o);
        $.ajax
        ({
          url:"llenar_tabla.php",
          type: "POST",
          data:o,
          success: function(data)
          {
            console.log(data);
            llenar_tabla($('#equipo-cre').val(), data)            
          }
        })

      })

      $('check').on('change', function()
      {
        Suma(this.checked,this.value)
      })
      
      $('[data-toggle="tooltip"]').tooltip()

      //Si selecciona otro Equipo limpia todo y LLENA SELECT DE PLANES
        $("#equipo-cre").change(function(){
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:"equipo-cre="+$("#equipo-cre").val(),
            success: function(plan){
              $("#plan-cre").html(plan);
              $('#etapas-cre').val(0);
              $('#meso-cre').val(0);
              $('#formCreacion :checked').removeAttr('checked');
              document.formCreacion.generarasi.disabled=true;
            }
          })
        });
        //llena los elemento dependiendo del combobox sub elemento
        $("#tec-subele-tecnico").change(function(){
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:"sub="+$("#tec-subele-tecnico").val(),
            success: function(elemento){
              $("#tec-ele-tecnico").html(elemento);
            }
          })
        });
        
      //Llenar mesociclos
     $("#etapas-cre").change(function(){
            $('#meso-cre').val(0);
            var idetapas=$("#etapas-cre").val();
            var plan=$("#plan-cre").val();
            console.log(idetapas);
            var o = "etapas="+ encodeURIComponent(idetapas)+"&plan="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(meso){
              console.log(meso);
              $("#meso-cre").html(meso);
             $('#formCreacion :checked').removeAttr('checked');
              $('#micro-cre').val(0);
             document.formCreacion.generarasi.disabled=true;
            }
          })
        });
//Llenar microciclos
       $("#meso-cre").change(function(){
          document.formCreacion.generarasi.disabled=false;
        });


    $(".botonExcel").on('click', function(){
          $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
          $("#FormularioExportacion").submit();
       })



    $("#btnguardaasis").on('click', function(){
      insertar_datos();
    });

    });

    function llenar_tabla(equipo, tiempo)
    {
      var equipoid = equipo;
      var opcion = 'llenado';
      
      $.ajax(
      {
        url: 'llenar_tabla.php',
        type: 'POST',
        data: {ide:equipoid, opc:opcion}
      })
      .done(function(data) 
      {        
        var resp = $.parseJSON(data);
        console.log(resp);
        var pts = 100/tiempo;
        console.log(pts);
        var nombre = '<table class="table table-bordered" align="center">'+
                     '<thead>'+
                        '<tr>'+
                          '<th>Nombre</th>';

                          for (var j = 1; j <= tiempo; j++) 
                          {
                            if(j<10)
                            {
                              nombre +='<th>C_'+j+'</th>';
                            } 
                            else
                            {
                              nombre +='<th>C'+j+'</th>';
                            }                        
                          }

            nombre +=   '<th>Total_Clases</th>'+
                        '<th>Total_Porcentual</th>'+
                        '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '<form class="form-inline text-left" role="form" name="formulario" method="post">';


                        for(i in resp)
                        { 
                          if(resp[i].res==1)
                          {
                            nombre += '<tr>'+
                                  '<td value="'+resp[i].idJugador+'">'+resp[i].nombre_ju+' '+resp[i].apellidop_ju+' '+resp[i].apellidom_ju+'</td>';
                          }
                        }
              var r=0;
              var f=0;
                    for(n in resp)
                    { 
                      if(resp[n].res==1)
                      {
                       f=f+1;
                        
                        for (var k = 1; k <= tiempo; k++) 
                        {
                          nombre += '<td><input type="checkbox" name="checkbox'+(r+1)+'" id="'+(r+1)+'" class=" check form-control" value="'+pts+'" onClick="if (this.checked){ sumar(this.value,'+f+');} else{restar(this.value,'+f+')}" ></td>'; 
                            r=r+1;
                        }                  
                          nombre +=  '<td>'+
                                  '<input type="text" class="form-control" name="total" value="0" id="total'+f+'" placeholder="0" readonly></td>'+   
                                  '<td><input type="text" class="form-control" placeholder="0" id="porcentaje'+f+'" value="0" readonly></td>'+
                                  '</tr>';                         
                      }

                    }
        
                    nombre +=  '</form>'+
                              '</tbody>'+
                              '</table>';

        $('#nombre').html(nombre);
      
        document.formCreacion.generarasi.disabled=true;
        })
        .fail(function() 
        {
          console.log("error");
        })
          event.preventDefault();        
      }
      ///////////////
      
      function sumar(valor, id) {
        var ide = id;
        var canti = valor;
        var clase = 1;
        //creamos una variable para cada total_porcentual
        eval("var porc" + ide + " = " + $('#porcentaje'+ide).val());
        console.log(eval("porc"+ide));
        operador='+'; 
        eval("var porc" + ide + " = "+ eval("porc"+ide) +operador+valor);
        console.log(eval("porc"+ide));
        
        //creamos una variable para cada total
        eval("var total" + ide + " = " + $('#total'+ide).val());
        console.log(eval("total"+ide));
        operador='+'; 
        eval("var total" + ide + " = "+ eval("total"+ide) +operador+clase);
        console.log(eval("total"+ide));


        if(eval("porc"+ide)>100)
         {
          $('#porcentaje'+id).val(100);
         } 
         else
         {
          $('#porcentaje'+id).val(eval("porc"+ide));
         }
        $('#total'+id).val(eval("total"+ide));
      }

      function restar(valor, id ) {
        var ide = id;
        var canti = valor;
        var clase = 1;
        eval("var porc" + ide + " = " + $('#porcentaje'+ide).val());
        console.log(eval("porc"+ide));
        operador='-'; 
        eval("var porc" + ide + " = "+ eval("porc"+ide) +operador+valor);
        console.log(eval("porc"+ide));
        
        //creamos una variable para cada total
        eval("var total" + ide + " = " + $('#total'+ide).val());
        console.log(eval("total"+ide));
        operador='-'; 
        eval("var total" + ide + " = "+ eval("total"+ide) +operador+clase);
        console.log(eval("total"+ide));

        if(eval("porc"+ide)<0)
         {
          $('#porcentaje'+id).val(0);
         } 
         else
         {
          $('#porcentaje'+id).val(eval("porc"+ide));
         }
        $('#total'+id).val(eval("total"+ide));
      }

      function insertar_datos(){
        var plan=$("#plan-cre").val();
        var plansub = $('#equipo-cre').val();
        var meso=$('#meso-cre').val();
        var etapa=$('#etapas-cre').val();
        var o = "plansub="+ encodeURIComponent(plansub)+"&meso-cre="+ encodeURIComponent(meso)+"&plan="+encodeURIComponent(plan)+"&opcion="+encodeURIComponent('insertar')+"&etapa="+encodeURIComponent(etapa);
          console.log(o);
          $.ajax({
            url: 'jugadores.php',
            type: 'POST',
            data: o
          })
          .done(function(data) {
            console.log(data);
            var resp = $.parseJSON(data);
            console.log(resp);
            var t= resp.resp; 
            if(t==1)
            {
              console.log("insertado");
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

  <!--  llamada a las funciones del llenado de selects -->

<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      Asistencia
    </div> 
    <div class="panel-body" >
      <div>

      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Asistencia</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Seguimiento</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/Jugadores/asistencia.php";
            ?>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
            <?php 
              require_once $_SERVER["DOCUMENT_ROOT"]."/Desarrollo_SSPED/Futbol/Jugadores/seguimiento.php";
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
      
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
          <div class="col-xs-6 col-sm-9">
            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cerrar</button>  
          </div>
          <div class="col-xs-6 col-sm-3">
            <button type="submit" class="btn btn-success botonExcel"><i class="icon-print"></i>Imprimir</button>  
          </div>
          
          
          <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
        </div>
      </form>
    </div>
  </div>
</div>