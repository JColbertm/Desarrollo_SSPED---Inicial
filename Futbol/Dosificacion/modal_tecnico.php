<!--  MODAL EJERCICIO TECNICO -->
<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
    <link rel="stylesheet" href="/Desarrollo_SSPED/bootstrap-3.3.6-dist/css/bootstrap.css">
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/jquery.js"></script>
    <script src="/Desarrollo_SSPED/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        //////////////////MODALS////////////////
    //PRIMER MODAL TECNICO//
    //GENERA LA TABLA DE BUSQUEDA
        $("#tec-ele-tecnico").change(function(){
          buscar_modal_tecnico($('#tec-ele-tecnico').val(),1);
        });

        $("#modal-tecnico-selec-ejer").click(function(){
            if($('#modal-tecnico-nom1').val()==""){
        $('#modal-tecnico-nom1').val(nom_mod);
            $('#modal-tecnico-desc1').val(desc_mod);
        }else{if($('#modal-tecnico-nom2').val()==""){
            $('#modal-tecnico-nom2').val(nom_mod);
            $('#modal-tecnico-desc2').val(desc_mod);
        }else{ alert("Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-tecnico-limpiar1").click(function(){

            $('#modal-tecnico-nom1').val("");
            $('#modal-tecnico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-tecnico-limpiar2").click(function(){
            $('#modal-tecnico-nom2').val("");
            $('#modal-tecnico-desc2').val("");
          });
      /////////////////////////////////////
    //TERCER MODAL TECNICO-FISICO//
            $("#tec-ele-fisico").change(function(){
          buscar_modal_tecnico($('#tec-ele-fisico').val(),3);
          });
             $("#modal-fisico-selec-ejer").click(function(){
            if($('#modal-fisico-nom1').val()==""){
        $('#modal-fisico-nom1').val(nom_mod);
            $('#modal-fisico-desc1').val(desc_mod);
        }else{if($('#modal-fisico-nom2').val()==""){
            $('#modal-fisico-nom2').val(nom_mod);
            $('#modal-fisico-desc2').val(desc_mod);
        }else{ alert("Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-fisico-limpiar1").click(function(){

            $('#modal-fisico-nom1').val("");
            $('#modal-fisico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-fisico-limpiar2").click(function(){
            $('#modal-fisico-nom2').val("");
            $('#modal-fisico-desc2').val("");
          });
      /////////////////////////////////////
       //SEGUNDO MODAL TECNICO-TACTICO //
            $("#tec-ele-tactico").change(function(){
          buscar_modal_tecnico($('#tec-ele-tactico').val(),2);
          });
             $("#modal-tactico-selec-ejer").click(function(){
            if($('#modal-tactico-nom1').val()==""){
        $('#modal-tactico-nom1').val(nom_mod);
            $('#modal-tactico-desc1').val(desc_mod);
        }else{if($('#modal-tactico-nom2').val()==""){
            $('#modal-tactico-nom2').val(nom_mod);
            $('#modal-tactico-desc2').val(desc_mod);
        }else{ alert("Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-tactico-limpiar1").click(function(){

            $('#modal-tactico-nom1').val("");
            $('#modal-tactico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-tactico-limpiar2").click(function(){
            $('#modal-tactico-nom2').val("");
            $('#modal-tactico-desc2').val("");
          });
      /////////////////////////////////////
      //CUARTO MODAL ACCIONES PSI //
            $("#tec-ele-psi").change(function(){
          buscar_modal_tecnico($('#tec-ele-psi').val(),4);
          });
             $("#modal-psi-selec-ejer").click(function(){
            if($('#modal-psi-nom1').val()==""){
        $('#modal-psi-nom1').val(nom_mod);
            $('#modal-psi-desc1').val(desc_mod);
        }else{if($('#modal-psi-nom2').val()==""){
            $('#modal-psi-nom2').val(nom_mod);
            $('#modal-psi-desc2').val(desc_mod);
        }else{ alert("Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-psi-limpiar1").click(function(){

            $('#modal-psi-nom1').val("");
            $('#modal-psi-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-psi-limpiar2").click(function(){
            $('#modal-psi-nom2').val("");
            $('#modal-psi-desc2').val("");
          });
      /////////////////////////////////////
       //CUARTO MODAL COMPETENCIA//
            $("#tec-ele-comp").change(function(){
          buscar_modal_tecnico($('#tec-ele-comp').val(),5);
          });
             $("#modal-comp-selec-ejer").click(function(){
            if($('#modal-comp-nom1').val()==""){
        $('#modal-comp-nom1').val(nom_mod);
            $('#modal-comp-desc1').val(desc_mod);
        }else{if($('#modal-comp-nom2').val()==""){
            $('#modal-comp-nom2').val(nom_mod);
            $('#modal-comp-desc2').val(desc_mod);
        }else{ alert("Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-comp-limpiar1").click(function(){

            $('#modal-comp-nom1').val("");
            $('#modal-comp-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-comp-limpiar2").click(function(){
            $('#modal-comp-nom2').val("");
            $('#modal-comp-desc2').val("");
          });
      /////////////////////////////////////

    })


        function buscar_modal_tecnico(a,b){
            var n = a;
            var n1 = b;
            console.log(n);
            console.log(n1);
            var o = "tec-ele="+encodeURIComponent(n)+"&idprepa="+ encodeURIComponent(n1)+"&opcion="+ encodeURIComponent('buscar');//{a: n, opcion:'buscar'};
            console.log(o);
            
              $.ajax({
                url: 'dosificacion.php',
                type: 'POST',
                data: o
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);
if(b==1){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_tecnico(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                    $('#resultado-modal-1').html(html);
                
                
}
if(b==2){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_tactico(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                $('#resultado-modal-2').html(html);
                
}
if(b==3){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_fisico(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                $('#resultado-modal-3').html(html);
                
}
if(b==4){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_psi(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                $('#resultado-modal-4').html(html);
                
}
if(b==5){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_comp(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                $('#resultado-modal-5').html(html);
                
}
              })
              .fail(function() {
                console.log("error");
              })
             
          }
          
           function mostrar_datos_tecnico(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod = $(f).find('td:eq(11)').text();

              $('#modal-tecnico-nom').val(nom_mod);
              $('#modal-tecnico-cate').val(cate_mod);
              $('#modal-tecnico-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-tecnico-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
          
          function mostrar_datos_fisico(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod = $(f).find('td:eq(11)').text();

              $('#modal-fisico-nom').val(nom_mod);
              $('#modal-fisico-cate').val(cate_mod);
              $('#modal-fisico-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-fisico-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
          function mostrar_datos_tactico(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod = $(f).find('td:eq(11)').text();

              $('#modal-tactico-nom').val(nom_mod);
              $('#modal-tactico-cate').val(cate_mod);
              $('#modal-tactico-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-tactico-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
          function mostrar_datos_psi(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod = $(f).find('td:eq(11)').text();

              $('#modal-psi-nom').val(nom_mod);
              $('#modal-psi-cate').val(cate_mod);
              $('#modal-psi-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-psi-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
          function mostrar_datos_comp(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod = $(f).find('td:eq(11)').text();

              $('#modal-comp-nom').val(nom_mod);
              $('#modal-comp-cate').val(cate_mod);
              $('#modal-comp-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-comp-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
    </script>
    </head>
<body>
<?php 
      include("llenado_selects.php");

?>
                        <form class="form-horizontal" id="formCreacion" name="formCreacion" method="POST" enctype="multipart/form-data">
<div class="col-sm-2">
                              <select class="form-control" id="equipo-cre" name="creacion-equi" required>
                                 <?php echo $equipo; 
                                 ?>                  
                            </select>
                          </div>
    <div class="col-sm-4">
                <br><br><br>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tecnico">
                          <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/tecnico.png" alt=""></span>
                        <span class="hidden-xs">
                            Ejercicios Tecnicos
                        </span>
                        </button>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tec_fis">
                          <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/Prefisica.png" alt=""></span>
                        <span class="hidden-xs">
                            Ejercicios Tec Fisicos
                        </span>
                        </button>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tec_tac">
                          <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/tactico.png" alt=""></span>
                        <span class="hidden-xs">
                            Ejer. Tec Tacticos
                        </span>
                        </button>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_psi">
                          <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pensar.png" alt=""></span>
                        <span class="hidden-xs">
                            Acciones Psicologicas
                        </span>
                        </button>
                    </div>
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_comp">
                          <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/competencia.png" alt=""></span>
                        <span class="hidden-xs">
                            Competencias
                        </span>
                        </button>
                    </div>                                 
                </div>
                </form>
</body>
</html>
<div class="modal fade" id="Ejercicio_tecnico" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Galeria de Ejercicios</h4>
              </div>
                  <div class="modal-body">
                    <!-- Galeria de Ejercicios -->

                            <form class="form-horizontal">

                            <div class="row">
                                                
                                                <label class="col-sm-2 control-label">Preparacion:</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" id="idPreparacion" value="1"></input>
                                                    <input type="text" class="form-control" id="tecnico"  readonly placeholder="Ejercicio Tecnico">
                                                </div>
                                                

                                                
                                                  <label class="col-sm-2 control-label">Elemento Tec.:</label>
                                                  <div class="col-sm-3">
                                                        <select class="form-control" id="tec-ele-tecnico" required>
                                                                    <?php echo $elemento_tecnico; ?>                  
                                                        </select>              
                                                  </div>
                                                
                                            </div>    
                                            <br>

                                            <div class="row">
                                                
                                                <label class="col-sm-2 control-label">Dia:</label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" id="tec-dia" required>
                                                                    <?php echo $dia; ?>                  
                                                        </select>            
                                                </div>
                                                

                                                
                                                  <label class="col-sm-2 control-label">Cantidad:</label>
                                                  <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="" placeholder="2" readonly="">
                                                  </div>
                                                
                                            </div>
                            
                                            <br>
                                            <div class="row">
                                            <div class="col-sm-6">
                                            <br>        
                                                <div class="row">
                                                    <div class="col-sm-offset-1 col-sm-10">
                                                        <div  id="modal-tecnico-ima" name="mostrar-ima-mod">
                                                     </div> 
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row">            
                                                        <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-nom" readonly >
                                                    </div>
                                                    </div>
                                                    <br>
                                                <div class="row">
                                                    <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-cate" readonly="">
                                                    </div>
                                                </div>
                                                    <br>
                                                <div class="row">
                                                    <label class=" col-sm-offset-1 col-sm-3 control-label">Descripci&oacuten:</label>
                                                    <div class="col-sm-8">
                                                        <textarea class="form-control" rows="4" type="text" class="form-control" id="modal-tecnico-desc" placeholder="Descripcion del Ejercicio" readonly=""></textarea>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div align="center">
                                                        <button type="button" id="modal-tecnico-selec-ejer"class="btn btn-primary">Seleccionar</button>
                                                    </div>
                                                </div>
                                            </div> 
                                            <br>
                                            <div class="col-sm-6">
                                            <div class="row">
                                                <div class=" col-sm-11">                
                                                    <!--tabla resultante-->
                                                  <div class="form-group" id="resultado-modal-1">
                                                    
                                                  </div>
                                                </div>
                                                
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-6 control-label">Ejercicios seleccionados:</label>
                                                </div>
                                                <br>
                                                <div class="list-group">
                                                <div class="list-group-item list-group-item-info">
                                                <div class="row ">
                                                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-nom1" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-desc1" readonly="">
                                                    </div>
                                                </div>
                                                <br>
                                                <div align="right">
                                                <button type="button" class="btn btn-normal" id="modal-tecnico-limpiar1" >Limpiar</button>
                                                </div>
                                                </div>
                                                </div>
                                                
                                                <div class="list-group">
                                                <div class="list-group-item list-group-item-info">
                                                <div class="row">
                                                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-nom2" readonly="">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="modal-tecnico-desc2" readonly="">
                                                    </div>
                                                </div>
                                                <br>   
                                                <div align="right">
                                                <button type="button" class="btn btn-normal" id="modal-tecnico-limpiar2" >Limpiar</button>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                       </div>
                          </div>
                          <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Finalizar</button>
              </div>
                    </form>
                </div>
              
    </div>
  </div>
</div>
<!--  MODAL EJERCICIO TECNICO FISICO -->



<div class="modal fade" id="Ejercicio_tec_fis" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Galeria de Ejercicios</h4>
                      </div>
      <div class="modal-body">
        <!-- Galeria de Ejercicios -->

        <form class="form-horizontal">

        <div class="row">
            
            <label class="col-sm-2 control-label">Preparacion:</label>
            <div class="col-sm-3">
            <input type="hidden" id="idPreparacion-fi" value="3"></input>
                <input type="text" class="form-control" id="" readonly="" value="Ejercicio Tecnico Tactico">
            </div>
            

            
              <label class="col-sm-2 control-label">Elemento Tec.:</label>
              <div class="col-sm-3">
                    <select class="form-control" id="tec-ele-fisico" required>
                                <?php echo $elemento_tecnico_fis; ?>                  
                    </select>              
              </div>
            
        </div>    
        <br>

                            <div class="row">
                                
                                <label class="col-sm-2 control-label">Dia:</label>
                                <div class="col-sm-3">
                                    <select class="form-control" id="tec-dia-fisico" required>
                                                    <?php echo $dia; ?>                  
                                        </select>            
                                </div>
                                
                            </div>
                            
                            <br>
                            <div class="row">
                            <div class="col-sm-6">        
                                <div class="row">
                                    <div class="col-sm-offset-1 col-sm-10">
                                        <div  id="modal-fisico-ima" >
                                     </div> 
                                    </div>
                                </div>
                                <div class="row">            
                                        <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-nom" readonly="">
                                    </div>
                                    </div>
                                    <br>
                                <div class="row">
                                    <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-cate" readonly="">
                                    </div>
                                </div>
                                    <br>
                                <div class="row">
                                    <label class=" col-sm-offset-1 col-sm-3 control-label">Descripci&oacuten:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="4" type="text" class="form-control" id="modal-fisico-desc" placeholder="Descripcion del Ejercicio" onkeypress="return justNumbers(event);" readonly=""></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div align="center">
                                        <button type="button" class="btn btn-primary" id="modal-fisico-selec-ejer">Seleccionar</button>
                                    </div>
                                </div>
                            </div> 
                            <br>
                            <div class="col-sm-6">
                            <div class="row">
                                <div class=" col-sm-11">                
                                   <div class="form-group" id="resultado-modal-3">
                                </div>
                                
                                </div>
                                <div class="row">
                                    <label class="col-sm-6 control-label">Ejercicios seleccionados:</label>
                                </div>
                                <br>
                                <div class="list-group">
                                <div class="list-group-item list-group-item-info">
                                <div class="row ">
                                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-nom1" readonly="">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-desc1" readonly="">
                                    </div>
                                </div>
                                <br>
                                <div align="right">
                                <button type="button" class="btn btn-normal" id="modal-fisico-limpiar1">Limpiar</button>
                                </div>
                                </div>
                                </div>
                                
                                <div class="list-group">
                                <div class="list-group-item list-group-item-info">
                                <div class="row">
                                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-nom2" readonly="">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="modal-fisico-desc2" readonly="">
                                    </div>
                                </div>
                                <br>   
                                <div align="right">
                                <button type="button" class="btn btn-normal" id="modal-fisico-limpiar2">Limpiar</button>
                                                  </div>
                                                </div>
                                                </div>
                                            </div>
                                       </div>
                          </div>
                           <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Finalizar</button>
              </div>
                    </form>
                </div>
    </div>
  </div>
</div>
<!--  MODAL EJERCICIO TECNICO TACTICO -->



<div class="modal fade" id="Ejercicio_tec_tac" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Galeria de Ejercicios</h4>
      </div>
      <div class="modal-body">
        <!-- Galeria de Ejercicios -->

        <form class="form-horizontal">

        <div class="row">
            
            <label class="col-sm-2 control-label">Preparacion:</label>
            <div class="col-sm-3">
            <input type="hidden" id="idPreparacion-fi" value="3"></input>
                <input type="text" class="form-control" id="" readonly="" value="Ejercicio Tecnico Tactico">
            </div>
            

            
              <label class="col-sm-2 control-label">Elemento Tec.:</label>
              <div class="col-sm-3">
                    <select class="form-control" id="tec-ele-tactico" required>
                                <?php echo $elemento_tecnico_tac; ?>                  
                    </select>              
              </div>
            
        </div>    
        <br>

        <div class="row">
            
            <label class="col-sm-2 control-label">Dia:</label>
            <div class="col-sm-3">
                <select class="form-control" id="tec-dia-tactico" required>
                                <?php echo $dia; ?>                  
                    </select>            
            </div>
            
        </div>
        
        <br>
        <div class="row">
        <div class="col-sm-6">        
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <div  id="modal-tactico-ima" >
                 </div> 
                </div>
            </div>
            <div class="row">            
                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-nom" readonly="">
                </div>
                </div>
                <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-cate" readonly="">
                </div>
            </div>
                <br>
            <div class="row">
                <label class=" col-sm-offset-1 col-sm-3 control-label">Descripci&oacuten:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="4" type="text" class="form-control" id="modal-tactico-desc" placeholder="Descripcion del Ejercicio" onkeypress="return justNumbers(event);" readonly=""></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div align="center">
                    <button type="button" class="btn btn-primary" id="modal-tactico-selec-ejer">Seleccionar</button>
                </div>
            </div>
        </div> 
        <br>
        <div class="col-sm-6">
        <div class="row">
            <div class=" col-sm-11">                
               <div class="form-group" id="resultado-modal-2">
            </div>
            
            </div>
            <div class="row">
                <label class="col-sm-6 control-label">Ejercicios seleccionados:</label>
            </div>
            <br>
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-nom1" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-desc1" readonly="">
                </div>
            </div>
            <br>
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-tactico-limpiar1">Limpiar</button>
            </div>
            </div>
            </div>
            
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-nom2" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-tactico-desc2" readonly="">
                </div>
            </div>
            <br>   
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-tactico-limpiar2">Limpiar</button>
                              </div>
                                                </div>
                                                </div>
                                            </div>
                                       </div>
                          </div>
                    </form>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Finalizar</button>
              </div>
    </div>
  </div>
</div>
<!--  MODAL EJERCICIO ACCIONES-PSICOLOGICAS -->



<div class="modal fade" id="Ejercicio_psi" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Galeria de Ejercicios</h4>
      </div>
      <div class="modal-body">
        <!-- Galeria de Ejercicios -->

        <form class="form-horizontal">

        <div class="row">
            
            <label class="col-sm-2 control-label">Preparacion:</label>
            <div class="col-sm-3">
            <input type="hidden" id="idPreparacion-psi" value="4"></input>
                <input type="text" class="form-control" id="" readonly="" value="Ejercicio Acciones Psicologicas">
            </div>
            

            
              <label class="col-sm-2 control-label">Elemento Tec.:</label>
              <div class="col-sm-3">
                    <select class="form-control" id="tec-ele-psi" required>
                                <?php echo $elemento_accpsi; ?>                  
                    </select>              
              </div>
            
        </div>    
        <br>

        <div class="row">
            
            <label class="col-sm-2 control-label">Dia:</label>
            <div class="col-sm-3">
                <select class="form-control" id="tec-dia-psi" required>
                                <?php echo $dia; ?>                  
                    </select>            
            </div>
            
        </div>
        
        <br>
        <div class="row">
        <div class="col-sm-6">        
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <div  id="modal-psi-ima" >
                 </div> 
                </div>
            </div>
            <div class="row">            
                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-nom" readonly="">
                </div>
                </div>
                <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-cate" readonly="">
                </div>
            </div>
                <br>
            <div class="row">
                <label class=" col-sm-offset-1 col-sm-3 control-label">Descripci&oacuten:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="4" type="text" class="form-control" id="modal-psi-desc" placeholder="Descripcion del Ejercicio" onkeypress="return justNumbers(event);" readonly=""></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div align="center">
                    <button type="button" class="btn btn-primary" id="modal-psi-selec-ejer">Seleccionar</button>
                </div>
            </div>
        </div> 
        <br>
        <div class="col-sm-6">
        <div class="row">
            <div class=" col-sm-11">                
               <div class="form-group" id="resultado-modal-4">
            </div>
            
            </div>
            <div class="row">
                <label class="col-sm-6 control-label">Ejercicios seleccionados:</label>
            </div>
            <br>
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-nom1" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-desc1" readonly="">
                </div>
            </div>
            <br>
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-psi-limpiar1">Limpiar</button>
            </div>
            </div>
            </div>
            
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-nom2" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-psi-desc2" readonly="">
                </div>
            </div>
            <br>   
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-psi-limpiar2">Limpiar</button>
                              </div>
                                                </div>
                                                </div>
                                            </div>
                                       </div>
                          </div>
                    </form>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Finalizar</button>
              </div>
    </div>
  </div>
</div>
<!--  MODAL EJERCICIO COMP-->



<div class="modal fade" id="Ejercicio_comp" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Galeria de Ejercicios</h4>
      </div>
      <div class="modal-body">
        <!-- Galeria de Ejercicios -->

        <form class="form-horizontal">

        <div class="row">
            
            <label class="col-sm-2 control-label">Preparacion:</label>
            <div class="col-sm-3">
            <input type="hidden" id="idPreparacion-comp" value="5"></input>
                <input type="text" class="form-control" id="" readonly="" value="Ejercicio Acciones Psicologicas">
            </div>
            

            
              <label class="col-sm-2 control-label">Elemento Tec.:</label>
              <div class="col-sm-3">
                    <select class="form-control" id="tec-ele-comp" required>
                                <?php echo $elemento_comp; ?>                  
                    </select>              
              </div>
            
        </div>    
        <br>

        <div class="row">
            
            <label class="col-sm-2 control-label">Dia:</label>
            <div class="col-sm-3">
                <select class="form-control" id="tec-dia-comp" required>
                                <?php echo $dia; ?>                  
                    </select>            
            </div>
            
        </div>
        
        <br>
        <div class="row">
        <div class="col-sm-6">        
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <div  id="modal-comp-ima" >
                 </div> 
                </div>
            </div>
            <div class="row">            
                    <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-nom" readonly="">
                </div>
                </div>
                <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Categoria:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-cate" readonly="">
                </div>
            </div>
                <br>
            <div class="row">
                <label class=" col-sm-offset-1 col-sm-3 control-label">Descripci&oacuten:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="4" type="text" class="form-control" id="modal-comp-desc" placeholder="Descripcion del Ejercicio" onkeypress="return justNumbers(event);" readonly=""></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div align="center">
                    <button type="button" class="btn btn-primary" id="modal-comp-selec-ejer">Seleccionar</button>
                </div>
            </div>
        </div> 
        <br>
        <div class="col-sm-6">
        <div class="row">
            <div class=" col-sm-11">                
               <div class="form-group" id="resultado-modal-5">
            </div>
            
            </div>
            <div class="row">
                <label class="col-sm-6 control-label">Ejercicios seleccionados:</label>
            </div>
            <br>
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-nom1" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-desc1" readonly="">
                </div>
            </div>
            <br>
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-comp-limpiar1">Limpiar</button>
            </div>
            </div>
            </div>
            
            <div class="list-group">
            <div class="list-group-item list-group-item-info">
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Nombre:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-nom2" readonly="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col-sm-offset-1 col-sm-3 control-label">Descripcion:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="modal-comp-desc2" readonly="">
                </div>
            </div>
            <br>   
            <div align="right">
            <button type="button" class="btn btn-normal" id="modal-comp-limpiar2">Limpiar</button>
                              </div>
                                                </div>
                                                </div>
                                            </div>
                                       </div>
                          </div>
                    </form>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Finalizar</button>
              </div>
    </div>
  </div>
</div>