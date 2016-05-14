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
        
        //Desabilita posibles cambios y genera la tabla de la semana
        $("#btnCargar").click(function(){
            var n1 = $('#micro-cre').val();
            var idequipo = $('#equipo-cre').val();
            var idplan= $("#plan-cre").val();
            var fecha= $("#plan-cre-fecha").val();
            formCreacion.mandar.disabled=true;
            formPdf.mostrar_pdf.disabled=true;
            //combo box dias
          var diases=dias_escogidos();
          var l=diases[1];
          var m=diases[2];
          var mi=diases[3];
          var j=diases[4];
          var v=diases[5];
          var sa=diases[6];
          var d=diases[7];
          console.log(diases);
          console.log(l);
          console.log(m);
          console.log(mi);
          console.log(j);
          console.log(v);
          console.log(sa);
          console.log(d);
           var a = "lu="+ encodeURIComponent(l)+"&ma="+encodeURIComponent(m)+"&mi="+encodeURIComponent(mi)+"&ju="+encodeURIComponent(j)+"&vi="+encodeURIComponent(v)+"&sa="+encodeURIComponent(sa)+"&do="+encodeURIComponent(d);
           console.log(a);
          $.ajax({
                    url:"llenado_selects.php",
                    type: "POST",
                    data:a,
                }).done(function(data2) {
                        var resp = data2;
                        console.log(data2);
                        console.log(resp);
                 $("#dosi-dia").html(resp);

            });
            ///////////Boton Guardar
            $("#mandar").click(function(){
            formCreacion.mandar.disabled=true;
                      document.formCreacion.btnCargar.disabled=true;
                    
                    var o = "idplan="+encodeURIComponent(idplan)+"&idequipo="+ encodeURIComponent(idequipo)+"&fecha="+encodeURIComponent(fecha);
                    console.log(o);      
                  $.ajax({
                    url:"llenado_selects.php",
                    type: "POST",
                    data:o,
                }).done(function(data2) {
                        var resp = data2;
                        console.log(data2);
                        console.log(resp);
                       guardarDia(n1,resp,diases);
            
                              })

                
                }); 
            /////////////////////
            console.log(n1);
            
            s();
                      generarTabla();                      
            $("#mostrar-tabla").show();
            buscar_teclado();
            $('#equipo-cre').prop('disabled',true);
            $('#plan-cre').prop('disabled',true);
            $('#plan-cre-fecha').prop('disabled',true);
            $('#etapas-cre').prop('disabled',true);
            $('#meso-cre').prop('disabled',true);
            $('#micro-cre').prop('disabled',true);
            $('#formCreacion :checked').prop('disabled',true);
            formCreacion.btnCargar.disabled=true;
        // $("#botonLunes").click(function(){

             
        //     }); 
         });
         //
        
         $("#dosi-dia").change(function(){
         
            formCreacion.mandar.disabled=false;
            
        });
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
              $('#micro-cre').val(0);
              $('#formCreacion :checked').removeAttr('checked');
              document.formCreacion.btnCargar.disabled=true;
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
             document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
//Llenar microciclos
       $("#meso-cre").change(function(){
        $('#formCreacion :checked').removeAttr('checked');
            var plan=$("#plan-cre").val();
            var meso=$('#meso-cre').val();
            var o = "meso="+ encodeURIComponent(meso)+"&plan="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(micro){
              console.log(micro);
              $("#micro-cre").html(micro);
              document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
//Borrar check
        $("#micro-cre").change(function(){
        $('#formCreacion :checked').removeAttr('checked');
        $('#formCreacion :checkbox').prop('disabled',false)
        document.formCreacion.btnCargar.disabled=true;

        });
//Limitacion checkbox
    $("#plan-cre").change(function(){
              $('#etapas-cre').val(0);
              $('#meso-cre').val(0);
              $('#micro-cre').val(0);
              $('#formCreacion :checked').removeAttr('checked');
              document.formCreacion.btnCargar.disabled=true;
            var idplan= $("#plan-cre").val();
            var o = "idplan="+encodeURIComponent(idplan);
            console.log(o);      
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
        }).done(function(data2) {
                var resp = data2;
                console.log(data2);
                console.log(resp);      
    checkboxlimit(document.forms.formCreacion.optradio, resp[2]);

                      })
        });
         //Si selecciona otro Equipo limpia todo y LLENA SELECT DE PLANES ver
        $("#equipo-ver").change(function(){
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:"equipo-cre="+$("#equipo-ver").val(),
            success: function(plan){
              $("#plan-ver").html(plan);
              $('#etapas-ver').val(0);
              $('#meso-ver').val(0);
              $('#micro-ver').val(0);
              //document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
        //Llenar mesociclos ver
     $("#etapas-ver").change(function(){
            $('#meso-cre').val(0);
            var idetapas=$("#etapas-ver").val();
            var plan=$("#plan-ver").val();
            console.log(idetapas);
            var o = "etapas="+ encodeURIComponent(idetapas)+"&plan="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(meso){
              console.log(meso);
              $("#meso-ver").html(meso);
              $('#micro-ver').val(0);
            //document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
//Llenar microciclos ver
       $("#meso-ver").change(function(){
            var plan=$("#plan-ver").val();
            var meso=$('#meso-ver').val();
            var o = "mesover="+ encodeURIComponent(meso)+"&planver="+ encodeURIComponent(plan);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(micro){
              console.log(micro);
              $("#micro-ver").html(micro);
              //document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
       //Llenar dias ver
       $("#micro-ver").change(function(){
            var micro=$("#micro-ver").val();
            var o = "microver="+ encodeURIComponent(micro);
            console.log(o);
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
            success: function(dia){
              console.log(dia);
              $("#dias-ver").html(dia);
              //document.formCreacion.btnCargar.disabled=true;
            }
          })
        });
       //Llenar d ver
       $("#dias-ver").change(function(){
            var idpro=$("#dias-ver").val();
            document.getElementById('idpro').value=idpro ; 
              console.log(idpro);
              //document.formCreacion.btnCargar.disabled=true;
        });
    //////////////////MODALS////////////////
    //PRIMER MODAL TECNICO//
    //GENERA LA TABLA DE BUSQUEDA
        $("#tec-ele-tecnico").change(function(){
          buscar_modal_tecnico($('#tec-ele-tecnico').val(),1);
        });

        $("#modal-tecnico-selec-ejer").click(function(){
            if($('#modal-tecnico-nom1').val()==""){
            $('#modal-tecnico-id1').val(idej_mod1);
            $('#modal-tecnico-nom1').val(nom_mod);
            $('#modal-tecnico-desc1').val(desc_mod);
        }else{if($('#modal-tecnico-nom2').val()==""){
            $('#modal-tecnico-id2').val(idej_mod1);
            $('#modal-tecnico-nom2').val(nom_mod);
            $('#modal-tecnico-desc2').val(desc_mod);
        }else{ alert("Solo tiene 2 ejercicio por dia.Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-tecnico-limpiar1").click(function(){

            $('#modal-tecnico-nom1').val("");
            $('#modal-tecnico-id1').val("");
            $('#modal-tecnico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-tecnico-limpiar2").click(function(){
            $('#modal-tecnico-id2').val("");
            $('#modal-tecnico-nom2').val("");
            $('#modal-tecnico-desc2').val("");
          });
      /////////////////////////////////////
    //SEGUNDO MODAL TECNICO-FISICO//
//TERCER MODAL TECNICO-FISICO//
            $("#tec-ele-fisico").change(function(){
          buscar_modal_tecnico($('#tec-ele-fisico').val(),2);
          });
             $("#modal-fisico-selec-ejer").click(function(){
            if($('#modal-fisico-nom1').val()==""){
              $('#modal-fisico-id1').val(idej_mod2);
            $('#modal-fisico-nom1').val(nom_mod);
            $('#modal-fisico-desc1').val(desc_mod);
        }else{if($('#modal-fisico-nom2').val()==""){
          $('#modal-fisico-id2').val(idej_mod2);
            $('#modal-fisico-nom2').val(nom_mod);
            $('#modal-fisico-desc2').val(desc_mod);
        }else{ alert("Solo tiene 2 ejercicio por dia.Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-fisico-limpiar1").click(function(){
            $('#modal-fisico-id1').val("");
            $('#modal-fisico-nom1').val("");
            $('#modal-fisico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-fisico-limpiar2").click(function(){
            $('#modal-fisico-id2').val("");
            $('#modal-fisico-nom2').val("");
            $('#modal-fisico-desc2').val("");
          });
      /////////////////////////////////////
       //SEGUNDO MODAL TECNICO-TACTICO //
            $("#tec-ele-tactico").change(function(){
          buscar_modal_tecnico($('#tec-ele-tactico').val(),3);
          });
             $("#modal-tactico-selec-ejer").click(function(){
            if($('#modal-tactico-nom1').val()==""){
            $('#modal-tactico-id1').val(idej_mod3);
            $('#modal-tactico-nom1').val(nom_mod);
            $('#modal-tactico-desc1').val(desc_mod);
        }else{if($('#modal-tactico-nom2').val()==""){
            $('#modal-tactico-id2').val(idej_mod3);
            $('#modal-tactico-nom2').val(nom_mod);
            $('#modal-tactico-desc2').val(desc_mod);
        }else{ alert("Solo tiene 2 ejercicio por dia.Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-tactico-limpiar1").click(function(){

            $('#modal-tactico-id1').val("");
            $('#modal-tactico-nom1').val("");
            $('#modal-tactico-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-tactico-limpiar2").click(function(){
            $('#modal-tactico-id2').val("");
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
            $('#modal-psi-id1').val(idej_mod4);
            $('#modal-psi-nom1').val(nom_mod);
            $('#modal-psi-desc1').val(desc_mod);
        }else{if($('#modal-psi-nom2').val()==""){
          $('#modal-psi-id2').val(idej_mod4);
            $('#modal-psi-nom2').val(nom_mod);
            $('#modal-psi-desc2').val(desc_mod);
        }else{ alert("Solo tiene 2 ejercicio por dia.Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-psi-limpiar1").click(function(){

            $('#modal-psi-id1').val("");
            $('#modal-psi-nom1').val("");
            $('#modal-psi-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-psi-limpiar2").click(function(){
            $('#modal-psi-id2').val("");
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
        $('#modal-comp-id1').val(idej_mod5);
        $('#modal-comp-nom1').val(nom_mod);
            $('#modal-comp-desc1').val(desc_mod);
        }else{if($('#modal-comp-nom2').val()==""){
          $('#modal-comp-id2').val(idej_mod5);
            $('#modal-comp-nom2').val(nom_mod);
            $('#modal-comp-desc2').val(desc_mod);
        }else{ alert("Solo tiene 2 ejercicio por dia.Para selecionar otro ejercicio limpie un ejercicio seleccionado")
}
        }
    
          });
        //BOTON LIMPIAR EJERCICI0 SELECCIONADO 1
          $("#modal-comp-limpiar1").click(function(){

            $('#modal-comp-id1').val("");
            $('#modal-comp-nom1').val("");
            $('#modal-comp-desc1').val("");
          });
        //BOTON LIMPIAR EJERCICI SELECCIONADO 2
          $("#modal-comp-limpiar2").click(function(){
            $('#modal-comp-id2').val("");
            $('#modal-comp-nom2').val("");
            $('#modal-comp-desc2').val("");
          });
      /////////////////////////////////////

      })
function diasemana(id){
  if(id==1){var dias="LUNES";}
  if(id==2){var dias="MARTES";}
  if(id==3){var dias="MIERCOLES";}
  if(id==4){var dias="JUEVES";}
  if(id==5){var dias="VIERNES";}
  if(id==6){var dias="SABADO";}
  if(id==7){var dias="DOMINGO";}
   $("#mostrar-ejercicios").show();
              var diasemana='<h2>'+dias+'</h2>';
              $("#nombreDia").html(diasemana);
              $("#modal-ET").html('Galeria de Ejercicios '+'"'+dias+'"');
              $("#modal-EF").html('Galeria de Ejercicios '+dias);
              $("#modal-TA").html('Galeria de Ejercicios '+dias);
              $("#modal-PS").html('Galeria de Ejercicios '+dias);
              $("#modal-CM").html('Galeria de Ejercicios '+dias);
              $("#dosi-dia").val(id);
              console.log(id);
              console.log($("#dosi-dia").val());

}
function sss(){
        var ser=$('#dias-ver').val();
        console.log(ser);
}
function s(){
    var d=0;

  if ($("#checkLu").is(':checked')){
    d+=$("#checkLu").val();
  }
  if ($("#checkMa").is(':checked')){
 d+=$("#checkMa").val(); 
  }
  if ($("#checkMi").is(':checked')){
     d+=$("#checkMi").val();
  }
  if ($("#checkJu").is(':checked')){
     d+=$("#checkJu").val();
  }
  if ($("#checkVi").is(':checked')){
     d+=$("#checkVi").val();
  }
  if ($("#checkSa").is(':checked')){
     d+=$("#checkSa").val();
  }
  if ($("#checkDo").is(':checked')){
     d+=$("#checkDo").val();
  }
console.log(d.length);
}
function limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp){
  var tec=tec;
  var fis=fis;
  var tac=tac;
  var psi=psi;
  var comp=comp;
  var t1=t1;
  var t2=t2;
  var t3=t3;
  var t4=t4;
  var t5=t5;
$('#tec').val(tec-t1);
$('#fis').val(fis-t2);
$('#tac').val(tac-t3);
$('#psi').val(psi-t4);
$('#comp').val(comp-t5);
        if(t1<tec)
          {            
          document.getElementById('tec').style.backgroundColor="#FDF4E3";formCreacion.mandar.disabled=true;
          }else{
            if(t1>tec){document.getElementById('tec').style.backgroundColor="#B44C43";formCreacion.mandar.disabled=true;             

          }else{
            document.getElementById('tec').style.backgroundColor="#BDECB6";formCreacion.mandar.disabled=false;
          }}
        
        if(t2<fis)
          {
          document.getElementById('fis').style.backgroundColor="#FDF4E3";formCreacion.mandar.disabled=true;
          }else{if(t2>fis){document.getElementById('fis').style.backgroundColor="#B44C43";formCreacion.mandar.disabled=true;}else{
            document.getElementById('fis').style.backgroundColor="#BDECB6";formCreacion.mandar.disabled=false;
          }}
        if(t3<tac)
          {
          document.getElementById('tac').style.backgroundColor="#FDF4E3";formCreacion.mandar.disabled=true;
          }else{if(t3>tac){document.getElementById('tac').style.backgroundColor="#B44C43";formCreacion.mandar.disabled=true;}else{
            document.getElementById('tac').style.backgroundColor="#BDECB6";formCreacion.mandar.disabled=false;
          }}        
        if(t4<psi)
          {
          document.getElementById('psi').style.backgroundColor="#FDF4E3";formCreacion.mandar.disabled=true;
          }else{if(t4>psi){document.getElementById('psi').style.backgroundColor="#B44C43";formCreacion.mandar.disabled=true;}else{
            document.getElementById('psi').style.backgroundColor="#BDECB6";formCreacion.mandar.disabled=false;
          }}
        if(t5<comp)
          {
          document.getElementById('comp').style.backgroundColor="#FDF4E3";formCreacion.mandar.disabled=true;
          }else{if(t5>comp){document.getElementById('comp').style.backgroundColor="#B44C43";formCreacion.mandar.disabled=true;}else{
            document.getElementById('comp').style.backgroundColor="#BDECB6";formCreacion.mandar.disabled=false;
          }}
        
}
function limite_min(min,col,tiempo1){
  var tiempo1=tiempo1;
  var col=col;
  var result=min;

  if(result<tiempo1)
          {
                document.getElementById(col).style.backgroundColor="#FDF4E3";

          }
          else{if(result>tiempo1){
                    document.getElementById(col).value = result-tiempo1;
                    document.getElementById(col).style.backgroundColor="#B44C43";}
                    else{document.getElementById(col).style.backgroundColor="#BDECB6"}

}}


function calcula(operacion,diasPosibles,tiempo,tec,fis,tac,psi,comp){ 
  var tec=tec;
  var fis=fis;
  var tac=tac;
  var psi=psi;
  var comp=comp;
  console.log(tec);
  console.log(fis);
  console.log(tac);
  console.log(psi);
  console.log(comp);

  var tiempo=tiempo;
  console.log(tiempo);
  var sumar;
 if(tiempo==60){sumar=15;tiempo1=60;}
 if(tiempo==90){sumar=20;tiempo1=90;}
 if(tiempo==12){sumar=20;tiempo1=120;}
 
  if(diasPosibles==2){

    var operando1 = document.formCreacion.operando1.value; 
    var operando3 = document.formCreacion.operando3.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var result = eval(operando1 + operacion + operando3 + operacion + operando5+ operacion + operando7+ operacion + operando9+operacion+sumar);
    document.formCreacion.colum1.value = result;
    var operando2 = document.formCreacion.operando2.value; 
    var operando4 = document.formCreacion.operando4.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var result2 = eval(operando2 + operacion + operando4 + operacion + operando6+ operacion + operando8+ operacion + operando10+operacion+sumar); 
    document.formCreacion.colum2.value = result2; 

    var t1=eval(operando1+operacion+operando2);
    var t2=eval(operando3+operacion+operando4);
    var t3=eval(operando5+operacion+operando6);
    var t4=eval(operando7+operacion+operando8);
    var t5=eval(operando9+operacion+operando10);

    if((result+result2)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}

    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);
    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
  }
  if(diasPosibles==3){

    var operando1 = document.formCreacion.operando1.value; 
    var operando4 = document.formCreacion.operando4.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var operando13 = document.formCreacion.operando13.value; 
    var result = eval(operando1 + operacion + operando4 + operacion + operando7+ operacion + operando10+ operacion + operando13+operacion+sumar); 
    document.formCreacion.colum1.value = result;

    var operando2 = document.formCreacion.operando2.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando11 = document.formCreacion.operando11.value; 
    var operando14 = document.formCreacion.operando14.value; 
    var result2 = eval(operando2 + operacion + operando5 + operacion + operando8+ operacion + operando11+ operacion + operando14+operacion+sumar); 
    document.formCreacion.colum2.value = result2;

    var operando3 = document.formCreacion.operando3.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var operando12 = document.formCreacion.operando12.value; 
    var operando15 = document.formCreacion.operando15.value; 
    var result3 = eval(operando3 + operacion + operando6 + operacion + operando9+ operacion + operando12+ operacion + operando15+ operacion+ sumar); 
    document.formCreacion.colum3.value = result3 ;

    var t1=eval(operando1+operacion+operando2+operacion+operando3);
    var t2=eval(operando4+operacion+operando5+operacion+operando6);
    var t3=eval(operando7+operacion+operando8+operacion+operando9);
    var t4=eval(operando10+operacion+operando11+operacion+operando12);
    var t5=eval(operando13+operacion+operando14+operacion+operando15);
    console.log(t1);
    console.log(t2);
    console.log(t3);
    console.log(t4);
    console.log(t5);
    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);

    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
    var res3='res_col3';
    limite_min(result3,res3,tiempo1);
    if((result+result2+result3)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}
   
  }
  if(diasPosibles==4){

    var operando1 = document.formCreacion.operando1.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var operando13 = document.formCreacion.operando13.value; 
    var operando17 = document.formCreacion.operando17.value; 
    var result = eval(operando1 + operacion + operando5 + operacion + operando9+ operacion + operando13+ operacion + operando17+operacion+sumar); 
    document.formCreacion.colum1.value = result ;

    var operando2 = document.formCreacion.operando2.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var operando14 = document.formCreacion.operando14.value; 
    var operando18 = document.formCreacion.operando18.value; 
    var result2 = eval(operando2 + operacion + operando6 + operacion + operando10+ operacion + operando14+ operacion + operando18+operacion+sumar); 
    document.formCreacion.colum2.value = result2 ;

    var operando3 = document.formCreacion.operando3.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando11 = document.formCreacion.operando11.value; 
    var operando15 = document.formCreacion.operando15.value; 
    var operando19 = document.formCreacion.operando19.value; 
    var result3 = eval(operando3 + operacion + operando7 + operacion + operando11+ operacion + operando15+ operacion + operando19+operacion+sumar); 
    document.formCreacion.colum3.value = result3 ; 

    var operando4 = document.formCreacion.operando4.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando12 = document.formCreacion.operando12.value; 
    var operando16 = document.formCreacion.operando16.value; 
    var operando20 = document.formCreacion.operando20.value; 
    var result4 = eval(operando4 + operacion + operando8 + operacion + operando12+ operacion + operando16+ operacion + operando20+operacion+sumar); 
    document.formCreacion.colum4.value = result4; 

    var t1=eval(operando1+operacion+operando2+operacion+operando3+operacion+operando4);
    console.log(t1);
    var t2=eval(operando5+operacion+operando6+operacion+operando7+operacion+operando8);
    console.log(t2);
    var t3=eval(operando9+operacion+operando10+operacion+operando11+operacion+operando12);
    console.log(t3);
    var t4=eval(operando13+operacion+operando14+operacion+operando15+operacion+operando16);
    console.log(t4);
    var t5=eval(operando17+operacion+operando18+operacion+operando19+operacion+operando20);
    console.log(t5);
    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);

    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
    var res3='res_col3';
    limite_min(result3,res3,tiempo1);
    var res4='res_col4';
    limite_min(result4,res4,tiempo1);

    if((result+result2+result3+result4)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}
  }
  
  if(diasPosibles==5){

    var operando1 = document.formCreacion.operando1.value; 
    var operando2 = document.formCreacion.operando2.value; 
    var operando3 = document.formCreacion.operando3.value; 
    var operando4 = document.formCreacion.operando4.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var operando11 = document.formCreacion.operando11.value; 
    var operando12 = document.formCreacion.operando12.value; 
    var operando13 = document.formCreacion.operando13.value; 
    var operando14 = document.formCreacion.operando14.value; 
    var operando15 = document.formCreacion.operando15.value; 
    var operando16 = document.formCreacion.operando16.value; 
    var operando17 = document.formCreacion.operando17.value; 
    var operando18 = document.formCreacion.operando18.value; 
    var operando19 = document.formCreacion.operando19.value; 
    var operando20 = document.formCreacion.operando20.value;
    var operando21 = document.formCreacion.operando21.value;
    var operando22 = document.formCreacion.operando22.value;
    var operando23 = document.formCreacion.operando23.value;
    var operando24 = document.formCreacion.operando24.value;
    var operando25 = document.formCreacion.operando25.value;
    var result = eval(operando1 + operacion + operando6 + operacion + operando11+ operacion + operando16+ operacion + operando21+operacion+sumar); 
    document.formCreacion.colum1.value = result;
    
    var result2 = eval(operando2 + operacion + operando7 + operacion + operando12+ operacion + operando17+ operacion + operando22+operacion+sumar); 
    document.formCreacion.colum2.value = result2 ;
    
    var result3 = eval(operando3 + operacion + operando8 + operacion + operando13+ operacion + operando18+ operacion + operando23+operacion+sumar); 
    document.formCreacion.colum3.value = result3 ;
    
    var result4 = eval(operando4 + operacion + operando9 + operacion + operando14+ operacion + operando19+ operacion + operando24+operacion+sumar); 
    document.formCreacion.colum4.value = result4 ;
    
    var result5 = eval(operando5 + operacion + operando10 + operacion + operando15+ operacion + operando20+ operacion + operando25+operacion+sumar); 
    document.formCreacion.colum5.value = result5; 

    var t1=eval(operando1+operacion+operando2+operacion+operando3+operacion+operando4+operacion+operando5);
    var t2=eval(operando6+operacion+operando7+operacion+operando8+operacion+operando9+operacion+operando10);
    var t3=eval(operando11+operacion+operando12+operacion+operando13+operacion+operando14+operacion+operando15);
    var t4=eval(operando16+operacion+operando17+operacion+operando18+operacion+operando19+operacion+operando20);
    var t5=eval(operando21+operacion+operando22+operacion+operando23+operacion+operando24+operacion+operando25);
    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);

    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
    var res3='res_col3';
    limite_min(result3,res3,tiempo1);
    var res4='res_col4';
    limite_min(result4,res4,tiempo1);
    var res5='res_col5';
    limite_min(result5,res5,tiempo1);
    if((result+result2+result3+result4+result5)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}
  }

  if(diasPosibles==6){

    var operando1 = document.formCreacion.operando1.value; 
    var operando2 = document.formCreacion.operando2.value; 
    var operando3 = document.formCreacion.operando3.value; 
    var operando4 = document.formCreacion.operando4.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var operando11 = document.formCreacion.operando11.value; 
    var operando12 = document.formCreacion.operando12.value; 
    var operando13 = document.formCreacion.operando13.value; 
    var operando14 = document.formCreacion.operando14.value; 
    var operando15 = document.formCreacion.operando15.value; 
    var operando16 = document.formCreacion.operando16.value; 
    var operando17 = document.formCreacion.operando17.value; 
    var operando18 = document.formCreacion.operando18.value; 
    var operando19 = document.formCreacion.operando19.value; 
    var operando20 = document.formCreacion.operando20.value;
    var operando21 = document.formCreacion.operando21.value;
    var operando22 = document.formCreacion.operando22.value;
    var operando23 = document.formCreacion.operando23.value;
    var operando24 = document.formCreacion.operando24.value;
    var operando25 = document.formCreacion.operando25.value;
    var operando26 = document.formCreacion.operando26.value;
    var operando27 = document.formCreacion.operando27.value;
    var operando28 = document.formCreacion.operando28.value;
    var operando29 = document.formCreacion.operando29.value;
    var operando30 = document.formCreacion.operando30.value;
    var result = eval(operando1 + operacion + operando7 + operacion + operando13+ operacion + operando19+ operacion + operando25+operacion+sumar); 
    document.formCreacion.colum1.value = result;
    
    var result2 = eval(operando2 + operacion + operando8 + operacion + operando14+ operacion + operando20+ operacion + operando26+operacion+sumar); 
    document.formCreacion.colum2.value = result2 ;
    
    var result3 = eval(operando3 + operacion + operando9 + operacion + operando15+ operacion + operando21+ operacion + operando27+operacion+sumar); 
    document.formCreacion.colum3.value = result3 ;
    
    var result4 = eval(operando4 + operacion + operando10 + operacion + operando16+ operacion + operando22+ operacion + operando28+operacion+sumar); 
    document.formCreacion.colum4.value = result4 ;
    
    var result5 = eval(operando5 + operacion + operando11 + operacion + operando17+ operacion + operando23+ operacion + operando29+operacion+sumar); 
    document.formCreacion.colum5.value = result5 ;
    var result6 = eval(operando6 + operacion + operando12 + operacion + operando18+ operacion + operando24+ operacion + operando30+operacion+sumar); 
    document.formCreacion.colum6.value = result6 ; 

     var t1=eval(operando1+operacion+operando2+operacion+operando3+operacion+operando4+operacion+operando5+operacion+operando6);
    var t2=eval(operando7+operacion+operando8+operacion+operando9+operacion+operando10+operacion+operando11+operacion+operando12);
    var t3=eval(operando13+operacion+operando14+operacion+operando15+operacion+operando16+operacion+operando17+operacion+operando18);
    var t4=eval(operando19+operacion+operando20+operacion+operando21+operacion+operando22+operacion+operando23+operacion+operando24);
    var t5=eval(operando25+operacion+operando26+operacion+operando27+operacion+operando28+operacion+operando29+operacion+operando30);
    
    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);

    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
    var res3='res_col3';
    limite_min(result3,res3,tiempo1);
    var res4='res_col4';
    limite_min(result4,res4,tiempo1);
    var res5='res_col5';
    limite_min(result5,res5,tiempo1);
    var res6='res_col6';
    limite_min(result6,res6,tiempo1);
    if((result+result2+result3+result4+result5+result6)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}
  }
  if(diasPosibles==7){

    var operando1 = document.formCreacion.operando1.value; 
    var operando2 = document.formCreacion.operando2.value; 
    var operando3 = document.formCreacion.operando3.value; 
    var operando4 = document.formCreacion.operando4.value; 
    var operando5 = document.formCreacion.operando5.value; 
    var operando6 = document.formCreacion.operando6.value; 
    var operando7 = document.formCreacion.operando7.value; 
    var operando8 = document.formCreacion.operando8.value; 
    var operando9 = document.formCreacion.operando9.value; 
    var operando10 = document.formCreacion.operando10.value; 
    var operando11 = document.formCreacion.operando11.value; 
    var operando12 = document.formCreacion.operando12.value; 
    var operando13 = document.formCreacion.operando13.value; 
    var operando14 = document.formCreacion.operando14.value; 
    var operando15 = document.formCreacion.operando15.value; 
    var operando16 = document.formCreacion.operando16.value; 
    var operando17 = document.formCreacion.operando17.value; 
    var operando18 = document.formCreacion.operando18.value; 
    var operando19 = document.formCreacion.operando19.value; 
    var operando20 = document.formCreacion.operando20.value;
    var operando21 = document.formCreacion.operando21.value;
    var operando22 = document.formCreacion.operando22.value;
    var operando23 = document.formCreacion.operando23.value;
    var operando24 = document.formCreacion.operando24.value;
    var operando25 = document.formCreacion.operando25.value;
    var operando26 = document.formCreacion.operando26.value;
    var operando27 = document.formCreacion.operando27.value;
    var operando28 = document.formCreacion.operando28.value;
    var operando29 = document.formCreacion.operando29.value;
    var operando30 = document.formCreacion.operando30.value;
    var operando31 = document.formCreacion.operando31.value;
    var operando32 = document.formCreacion.operando32.value;
    var operando33 = document.formCreacion.operando33.value;
    var operando34 = document.formCreacion.operando34.value;
    var operando35 = document.formCreacion.operando35.value;
    var result = eval(operando1 + operacion + operando8 + operacion + operando15+ operacion + operando22+ operacion + operando29+operacion+sumar); 
    document.formCreacion.colum1.value = result;
    
    var result2 = eval(operando2 + operacion + operando9 + operacion + operando16+ operacion + operando23+ operacion + operando30+operacion+sumar); 
    document.formCreacion.colum2.value = result2 ;
    
    var result3 = eval(operando3 + operacion + operando10 + operacion + operando17+ operacion + operando24+ operacion + operando31+operacion+sumar); 
    document.formCreacion.colum3.value = result3 ;
    
    var result4 = eval(operando4 + operacion + operando11 + operacion + operando18+ operacion + operando25+ operacion + operando32+operacion+sumar); 
    document.formCreacion.colum4.value = result4 ;
    
    var result5 = eval(operando5 + operacion + operando12 + operacion + operando19+ operacion + operando26+ operacion + operando33+operacion+sumar); 
    document.formCreacion.colum5.value = result5 ;
    
    var result6 = eval(operando6 + operacion + operando13 + operacion + operando20+ operacion + operando27+ operacion + operando34+operacion+sumar); 
    document.formCreacion.colum6.value = result6 ;
    
    var result7 = eval(operando7 + operacion + operando14 + operacion + operando21+ operacion + operando28+ operacion + operando35+operacion+sumar); 
    document.formCreacion.colum7.value = result7 ;
    var t1=eval(operando1+operacion+operando2+operacion+operando3+operacion+operando4+operacion+operando5+operacion+operando6+operacion+operando7);
    var t2=eval(operando8+operacion+operando9+operacion+operando10+operacion+operando11+operacion+operando12+operacion+operando13+operacion+operando14);
    var t3=eval(operando15+operacion+operando16+operacion+operando17+operacion+operando18+operacion+operando19+operacion+operando20+operacion+operando21);
    var t4=eval(operando22+operacion+operando23+operacion+operando24+operacion+operando25+operacion+operando26+operacion+operando27+operacion+operando28);
    var t5=eval(operando29+operacion+operando30+operacion+operando31+operacion+operando32+operacion+operando33+operacion+operando34+operacion+operando35);
    limite_tt(t1,t2,t3,t4,t5,tec,fis,tac,psi,comp);
    var res='res_col1';
    limite_min(result,res,tiempo1);
    var res2='res_col2';
    limite_min(result2,res2,tiempo1);
    var res3='res_col3';
    limite_min(result3,res3,tiempo1);
    var res4='res_col4';
    limite_min(result4,res4,tiempo1);
    var res5='res_col5';
    limite_min(result5,res5,tiempo1);
    var res6='res_col6';
    limite_min(result6,res6,tiempo1);
    var res6='res_col7';
    limite_min(result7,res7,tiempo1); 

    if((result+result2+result3+result4+result5+result6+result7)==(tiempo1*diasPosibles)){
      formCreacion.mandar.disabled=false;
}else{formCreacion.mandar.disabled=true;}
  }
}  
function guardarDia(direccion,cant_dias,dias_val){
  console.log(direccion);
  console.log(cant_dias);
  console.log(dias_val);
        var d=cant_dias[2];
        if(d==2)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          console.log(dias_val[2]);
          if(dias_val[1]==dia)
          {
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando3").val();
                  var tac = $("#operando5").val(); 
                  var acc = $("#operando7").val(); 
                  var comp = $("#operando9").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando4").val();
                  var tac = $("#operando6").val(); 
                  var acc = $("#operando8").val(); 
                  var comp = $("#operando10").val();
                  var total=$("#res_col2").val();
          }
        }
        if(d==3)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          console.log(dias_val[2]);
          if(dias_val[1]==dia)
          { 
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando4").val();
                  var tac = $("#operando7").val(); 
                  var acc = $("#operando10").val(); 
                  var comp = $("#operando13").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando5").val();
                  var tac = $("#operando8").val(); 
                  var acc = $("#operando11").val(); 
                  var comp = $("#operando14").val();
                  var total=$("#res_col2").val();
          }
          if(dias_val[3]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando3").val();
                  var fis = $("#operando6").val();
                  var tac = $("#operando9").val(); 
                  var acc = $("#operando12").val(); 
                  var comp = $("#operando15").val();
                  var total=$("#res_col3").val();
          }
        }
        if(d==4)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          console.log(dias_val[2]);
          if(dias_val[1]==dia)
          { 
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando5").val();
                  var tac = $("#operando9").val(); 
                  var acc = $("#operando13").val(); 
                  var comp = $("#operando17").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando6").val();
                  var tac = $("#operando10").val(); 
                  var acc = $("#operando14").val(); 
                  var comp = $("#operando18").val();
                  var total=$("#res_col2").val();
          }
          if(dias_val[3]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando3").val();
                  var fis = $("#operando7").val();
                  var tac = $("#operando11").val(); 
                  var acc = $("#operando15").val(); 
                  var comp = $("#operando19").val();
                  var total=$("#res_col3").val();
          }
          if(dias_val[4]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando4").val();
                  var fis = $("#operando8").val();
                  var tac = $("#operando12").val(); 
                  var acc = $("#operando16").val(); 
                  var comp = $("#operando20").val();
                  var total=$("#res_col4").val();
          }
        }
        if(d==5)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          if(dias_val[1]==dia)
          { 
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando6").val();
                  var tac = $("#operando11").val(); 
                  var acc = $("#operando16").val(); 
                  var comp = $("#operando21").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando7").val();
                  var tac = $("#operando12").val(); 
                  var acc = $("#operando17").val(); 
                  var comp = $("#operando22").val();
                  var total=$("#res_col2").val();
          }
          if(dias_val[3]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando3").val();
                  var fis = $("#operando8").val();
                  var tac = $("#operando13").val(); 
                  var acc = $("#operando18").val(); 
                  var comp = $("#operando23").val();
                  var total=$("#res_col3").val();
          }
          if(dias_val[4]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando4").val();
                  var fis = $("#operando9").val();
                  var tac = $("#operando14").val(); 
                  var acc = $("#operando19").val(); 
                  var comp = $("#operando24").val();
                  var total=$("#res_col4").val();
          }
          if(dias_val[5]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando5").val();
                  var fis = $("#operando10").val();
                  var tac = $("#operando15").val(); 
                  var acc = $("#operando20").val(); 
                  var comp = $("#operando25").val();
                  var total=$("#res_col5").val();
          }
        }
        if(d==6)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          if(dias_val[1]==dia)
          { 
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando7").val();
                  var tac = $("#operando13").val(); 
                  var acc = $("#operando19").val(); 
                  var comp = $("#operando25").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando8").val();
                  var tac = $("#operando14").val(); 
                  var acc = $("#operando20").val(); 
                  var comp = $("#operando26").val();
                  var total=$("#res_col2").val();
          }
          if(dias_val[3]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando3").val();
                  var fis = $("#operando9").val();
                  var tac = $("#operando15").val(); 
                  var acc = $("#operando21").val(); 
                  var comp = $("#operando27").val();
                  var total=$("#res_col3").val();
          }
          if(dias_val[4]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando4").val();
                  var fis = $("#operando10").val();
                  var tac = $("#operando16").val(); 
                  var acc = $("#operando22").val(); 
                  var comp = $("#operando28").val();
                  var total=$("#res_col4").val();
          }
          if(dias_val[5]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando5").val();
                  var fis = $("#operando11").val();
                  var tac = $("#operando17").val(); 
                  var acc = $("#operando23").val(); 
                  var comp = $("#operando29").val();
                  var total=$("#res_col5").val();
          }
          if(dias_val[6]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando6").val();
                  var fis = $("#operando12").val();
                  var tac = $("#operando18").val(); 
                  var acc = $("#operando24").val(); 
                  var comp = $("#operando30").val();
                  var total=$("#res_col6").val();
          }
        }
        if(d==7)
        {
          var dia=$("#dosi-dia").val();
          console.log(dia);
          if(dias_val[1]==dia)
          { 
             $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled"); 
              $("#dosi-dia").val(0);
                  var tec = $("#operando1").val();
                  var fis = $("#operando8").val();
                  var tac = $("#operando15").val(); 
                  var acc = $("#operando22").val(); 
                  var comp = $("#operando29").val();
                  var total=$("#res_col1").val();
          }
          if(dias_val[2]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando2").val();
                  var fis = $("#operando9").val();
                  var tac = $("#operando16").val(); 
                  var acc = $("#operando23").val(); 
                  var comp = $("#operando30").val();
                  var total=$("#res_col2").val();
          }
          if(dias_val[3]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando3").val();
                  var fis = $("#operando10").val();
                  var tac = $("#operando17").val(); 
                  var acc = $("#operando24").val(); 
                  var comp = $("#operando31").val();
                  var total=$("#res_col3").val();
          }
          if(dias_val[4]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando4").val();
                  var fis = $("#operando11").val();
                  var tac = $("#operando18").val(); 
                  var acc = $("#operando25").val(); 
                  var comp = $("#operando32").val();
                  var total=$("#res_col4").val();
          }
          if(dias_val[5]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando5").val();
                  var fis = $("#operando12").val();
                  var tac = $("#operando19").val(); 
                  var acc = $("#operando26").val(); 
                  var comp = $("#operando33").val();
                  var total=$("#res_col5").val();
          }
          if(dias_val[6]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando6").val();
                  var fis = $("#operando13").val();
                  var tac = $("#operando20").val(); 
                  var acc = $("#operando27").val(); 
                  var comp = $("#operando34").val();
                  var total=$("#res_col6").val();
          }
          if(dias_val[7]==dia)
          {
              $("#dosi-dia  option[value="+dia+"]").attr("disabled","disabled");
                            $("#dosi-dia").val(0);  
                  var tec = $("#operando7").val();
                  var fis = $("#operando14").val();
                  var tac = $("#operando21").val(); 
                  var acc = $("#operando28").val(); 
                  var comp = $("#operando35").val();
                  var total=$("#res_col7").val();
          }
        }
        if(dia==1){var fecha=$("#fechalunes").val();}
        if(dia==2){var fecha=$("#fechamartes").val();}
        if(dia==3){var fecha=$("#fechamiercoles").val();}
        if(dia==4){var fecha=$("#fechajueves").val();}
        if(dia==5){var fecha=$("#fechaviernes").val();}
        if(dia==6){var fecha=$("#fechasabado").val();}
        if(dia==7){var fecha=$("#fechadomingo").val();}
        console.log(fecha);
        var n = direccion;
        var ejer1=$("#modal-tecnico-id1").val();
        var ejer11=$("#modal-tecnico-id2").val();
        var ejer2=$("#modal-fisico-id1").val();
        var ejer22=$("#modal-fisico-id2").val();
        var ejer3=$("#modal-tactico-id1").val();
        var ejer33=$("#modal-tactico-id2").val();
        var ejer4=$("#modal-psi-id1").val();
        var ejer44=$("#modal-psi-id2").val();
        var ejer5=$("#modal-comp-id1").val();
        var ejer55=$("#modal-comp-id2").val();
        console.log(n);
        console.log(d);

    var o = "direccion="+encodeURIComponent(n)+
    "&fecha="+ encodeURIComponent(fecha)+
    "&tec="+ encodeURIComponent(tec)+
    "&fis="+ encodeURIComponent(fis)+
    "&tac="+ encodeURIComponent(tac)+
    "&psi="+ encodeURIComponent(acc)+
    "&comp="+ encodeURIComponent(comp)+
    "&tiempo="+ encodeURIComponent(total)+
    "&dia="+ encodeURIComponent(dia)+
    "&ejer1="+ encodeURIComponent(ejer1)+
    "&ejer11="+ encodeURIComponent(ejer11)+
    "&ejer2="+ encodeURIComponent(ejer2)+
    "&ejer22="+ encodeURIComponent(ejer22)+
    "&ejer3="+ encodeURIComponent(ejer3)+
    "&ejer33="+ encodeURIComponent(ejer33)+
    "&ejer4="+ encodeURIComponent(ejer4)+
    "&ejer44="+ encodeURIComponent(ejer44)+
    "&ejer5="+ encodeURIComponent(ejer5)+
    "&ejer55="+ encodeURIComponent(ejer55)+
    "&opcion="+ encodeURIComponent('insertar');//{a: n, opcion:'buscar'};
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
                $("#dosifi").val(resp);
        $("#modal-tecnico-nom1").val("");
        $("#modal-tecnico-desc1").val("");
        $("#modal-tecnico-nom2").val("");
        $("#modal-tecnico-desc2").val("");
        $("#modal-fisico-nom1").val("");
        $("#modal-fisico-desc1").val("");
        $("#modal-fisico-nom2").val("");
        $("#modal-fisico-desc2").val("");
        $("#modal-tactico-nom1").val("");
        $("#modal-tactico-desc1").val("");
        $("#modal-tactico-nom2").val("");
        $("#modal-tactico-desc2").val("");
        $("#modal-psi-nom1").val("");
        $("#modal-psi-desc1").val("");
        $("#modal-psi-nom2").val("");
        $("#modal-psi-desc2").val("");
        $("#modal-comp-nom1").val("");
        $("#modal-comp-desc1").val("");
        $("#modal-comp-nom2").val("");
        $("#modal-comp-desc2").val("");
        formPdf.mostrar_pdf.disabled=false;
              });




}
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
if(b==3){
                var html = '<div class="table-responsive col-sm-12" style="height: 200px; overflow-y:scroll;" class="table table-hover"><table class="table table-hover"><thead><tr><th>Nombre</th><th style="display:none"></th><th>Categoria</th><th>Elemento Tecnico</th></tr></thead><tbody>';
                  for(i in resp){ 
                    html+='<tr onclick="mostrar_datos_tactico(this)"><td>'+resp[i].nombre+'</td><td style="display:none">'+resp[i].idCategoria+'</td><td>'+resp[i].categoria_sub+'</td><td style="display:none">'+resp[i].idTipo_ejercicio+'</td><td style="display:none">'+resp[i].ejercicio+'</td><td style="display:none">'+resp[i].idEjer_tecnico+'</td><td>'+resp[i].elemento_tecnico+'</td><td style="display:none">'+resp[i].metodo+'</td><td style="display:none">'+resp[i].tarea+'</td><td style="display:none">'+resp[i].descripcion+'</td><td style="display:none">'+resp[i].imagen_ejercicio+'</td><td style="display:none">'+resp[i].idEjercicio+'</td></tr>';
                  }
              
        
                  html+= '</tbody></table></div>';
                $('#resultado-modal-2').html(html);
                
}
if(b==2){
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
          var idej_mod;
          var nom_mod;
          var desc_mod;
  function mostrar_datos_tecnico(f)
          {
              nom_mod= $(f).find('td:eq(0)').text();
              cate_mod = $(f).find('td:eq(2)').text();
              desc_mod = $(f).find('td:eq(9)').text();
              foto_mod = $(f).find('td:eq(10)').text();
              idej_mod1 = $(f).find('td:eq(11)').text();
              

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
              idej_mod2 = $(f).find('td:eq(11)').text();

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
              idej_mod3 = $(f).find('td:eq(11)').text();

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
              idej_mod4 = $(f).find('td:eq(11)').text();

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
              idej_mod5 = $(f).find('td:eq(11)').text();

              $('#modal-comp-nom').val(nom_mod);
              $('#modal-comp-cate').val(cate_mod);
              $('#modal-comp-desc').val(desc_mod);
              var html4='<center><img src="/Desarrollo_SSPED/Futbol/Galeria/acciones_abm_ejer/'+foto_mod+'"  alt="..." class="img-rounded" width="200" heigth="200"></center>'
              $('#modal-comp-ima').html(html4);
              console.log(nom_mod+' '+cate_mod);
              
          }
    function checkboxlimit(checkgroup, limit){
    var checkgroup=checkgroup
    var limit=limit
    for (var i=0; i<checkgroup.length; i++){
        checkgroup[i].onclick=function(){
        var checkedcount=0
        for (var i=0; i<checkgroup.length; i++)
            checkedcount+=(checkgroup[i].checked)? 1 : 0
                        console.log(checkedcount);      

        if (checkedcount>limit){
            alert("Solo puede eligir "+limit+" dias");
            checkedcount=checkedcount-1;
            this.checked=false;
            }
            if(checkedcount==limit && $('#equipo-cre').val()!=0 && $('#plan-cre').val()!=0 && $('#etapas-cre').val()!=0 && $('#meso-cre').val()!=0 && $('#micro-cre').val()!=0  ){
            //var total = checkedcount.length;
        document.formCreacion.btnCargar.disabled=false;
        }else{document.formCreacion.btnCargar.disabled=true;}
        }
        
    }
    limites=limit;
    console.log(limites);
}

function buscar_teclado(){
     /*   var n = $('#micro-cre').val();
            console.log(n);
            var o = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscara');//{a: n, opcion:'buscar'};
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

                var html = '<div class="col-sm-3 table-responsive"><br><table class="table table-hover"><thead><tr><th>Nombre</th><th>T.T</th>' 
                        
                  for(i in resp){ 
                    html+='<tr style="display:none"><td>'+resp[i].idDireccion+'</td></tr><tr><td><br>Tecnico</td><td><br>'+resp[i].sistema_juego+'</td></tr><tr><td><br>Preparation Fisica</td><td><br>'+resp[i].preparation_fisica+'</td></tr><tr><td><br>Sistema de Juego</td><td><br>'+resp[i].tecnico_tactico+'</td></tr><tr><td><br>Accion Psi</td><td><br>'+resp[i].competencia+'</td></tr><tr><td><br>Competencia</td><td><br>'+resp[i].accion_psi+'</td></tr><tr><td><br>Sub Total</td><td><br>'+resp[i].total+'</td></tr>';
                  }
                  html+= '</tbody></table></div>';

                  $('#resultado2').html(html);

              })
              .fail(function() {
                console.log("error");
              })*/
     }
     
    </script>
</head>
<body>
<?php 
      include("llenado_selects.php");

?>
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
<!-- PAGINA DE DOSIFICACION.  -->
<div class="col-xs-12 col-sm-8">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Programacion de microciclos</h3>
    </div>
    <div class="panel-body">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#creacion" role="tab" data-toggle="tab">Creacion</a></li>
        <li><a href="#ver" role="tab" data-toggle="tab" >Ver</a></li>
      </ul>
     <!-- Contenido pestana Programacion de microciclos -->
     <div class="tab-content">
        <!-- Contenido Pestaña creacion -->
        <div class="tab-pane fade in active" id="creacion">
          <div align="center"><h3>Creacion Semana</h3></div> 
            <form class="form-horizontal" id="formCreacion" name="formCreacion" method="POST" enctype="multipart/form-data">
              <div class="row">
                <label class="col-sm-1 control-label">Equipo:</label>
                <div class="col-sm-2">
                  <select class="form-control" id="equipo-cre" name="creacion-equi" required>
                    <?php echo $equipo;?>                  
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
                <label class=" col-sm-1 control-label">Etapas:</label>
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
              <label class="col-sm-2 control-label">Microciclos:</label>
              <div class="col-sm-2">
                <select class="form-control" id="micro-cre" required>

                </select>
              </div>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-sm-offset-1 col-sm-2">
                <label>Dias: </label>
              </div>                    
            </div>
            <div class="row">
              <div class="col-sm-offset-1 col-sm-10">
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkLu" value="1">Lunes</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkMa" value="2">Martes</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkMi" value="3">Miercoles</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkJu" value="4">Jueves</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkVi" value="5">Viernes</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkSa" value="6">Sabado</label>
                <label class="checkbox-inline"><input type="checkbox" name="optradio" id="checkDo" value="7">Domingo</label> 
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-offset-9 col-sm-2">
                <button type="button" class="btn btn-primary" id="btnCargar" disabled>Cargar Tabla</button>
              </div>
            </div>
            <div id="resultado2"></div>
              <div id="mostrar-tabla" style="display: none;">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover">
                    <thead id="cabeceraTablaDias">
        
                    </thead>
                    <tbody id="cuerpoTablaDias">
    
                    </tbody>
                  </table>
                </form>
              </div>
              <div id="mostrar-ejercicios" style="display:none;">
                <div class="col-xs-12" align="center" id="nombreDia"></div>
                  <input type="hidden" value="" id="dosi-dia" name="dosifi">
                  <div class="col-xs-12">
                    <div class="col-sm-4 col-xs-6">
                      <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tecnico">
                        <span aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/tecnico.png" alt=""></span>
                        <span class="hidden-xs">
                          Ejercicios Tecnicos
                        </span>
                      </button>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                      <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tec_fis">
                        <span aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/Prefisica.png" alt=""></span>
                        <span class="hidden-xs">
                          Preparacion Fisica
                        </span>
                      </button>
                    </div>
                    <div class="col-sm-4 col-xs-6 ">
                      <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_tec_tac">
                        <span aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/tactico.png" alt=""></span>
                        <span class="hidden-xs">
                          Sistema de Juego
                        </span>
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-12">
                  <br>
                    <div class="col-sm-offset-2 col-sm-4 col-xs-6">
                      <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_psi">
                        <span aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/pensar.png" alt=""></span>
                        <span class="hidden-xs">
                          Acciones Psicologicas
                        </span>
                      </button>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                      <button type="button" class="btn btn-default col-sm-12" data-toggle="modal" data-target="#Ejercicio_comp">
                        <span  aria-hidden="true"><img src="/Desarrollo_SSPED/Imagenes/ImaFutbol/competencia.png" alt=""></span>
                        <span class="hidden-xs">
                          Competencia
                        </span>
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-offset-8 col-sm-2 col-xs-6">
                  <br>              
                    <button type="button" id="mandar" class="btn btn-primary" >Guardar</button>
                  </div>
                </form>
                <form method="POST" action="/Desarrollo_SSPED/Futbol/Dosificacion/tcpdf/too/pdf_example.php" target="_blank" id="formPdf">
                  <div class=" col-sm-2 col-xs-6">
                  <br>
                    <input type="hidden" value="" id="dosifi" name="dosifi">
                    <button type="submit" class="btn btn-success" id="mostrar_pdf">Exportar</button>
                  </div>
                </form>
              </div>
            </div>
          </div><!-- fin mostrar-tabla -->
          <!-- Contenido Pestaña VER -->
          <div class="tab-pane fade" id="ver">
          <br>
            <div class="row">
              <label class="col-sm-2 col-xs-12 control-label">Equipo:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="equipo-ver" name="creacion-equi" required>
                  <?php echo $equipo;?>                  
                </select>
              </div>
              <label class=" col-sm-2 col-xs-12 control-label">Nombre Planificacion:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="plan-ver" name="creacion-tipo" required>
              
                </select>
              </div>
              <label class=" col-sm-2 col-xs-12 control-label">Etapas:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="etapas-ver" name="creacion-meso" required>
                  <?php echo $etapas; ?>                  
                </select>
              </div>
            </div>
            <br> 
            <div class="row">
              <label class=" col-sm-2 col-xs-12 control-label">Mesociclos:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="meso-ver" required>
  
                </select>
              </div>
              <label class="col-sm-2 col-xs-12 control-label">Microciclos:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="micro-ver" required>

                </select>
              </div>
              <label class=" col-sm-2 col-xs-12 control-label">Dias:</label>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="dias-ver" name="creacion-meso" required>

                </select>
              </div>
            </div>
            <form method="POST" action="/Desarrollo_SSPED/Futbol/Dosificacion/tcpdf/too/pdf_example.php" target="_blank" >
              <div class=" col-sm-2 col-xs-12">
              <br>
                <input type="hidden" value="" id="idpro" name="idpro">
                <button type="submit" class="btn btn-success" id="mostrar_pdf">
                  <span class="glyphicon glyphicon-export"></span>
                  <span class="hidden-xs">
                    Exportar
                  </span> 
                </button>
              </div>
            </form>
          </div>
          <!-- Contenido Pestaña ver -->
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
<!--  MODAL EJERCICIO TECNICO -->
<div class="modal fade" id="Ejercicio_tecnico" tabindex="-1" role="dialog" aria-labelledby="galeriaejercicios">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-title" id="myModalLabel" align="center"><h4><div id="modal-ET"></div></h4></div>
  
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
              <label class="col-sm-2 control-label">Sub Ejercicio:</label>
              <div class="col-sm-3">
                <select class="form-control" id="tec-subele-tecnico" required>
                  <?php echo $subelemento; ?>                   
                </select>              
              </div>
            </div>    
            <br>
            <div class="row">
              <label class="col-sm-2 control-label">Elemento Tecnico:</label>
              <div class="col-sm-3">
                <select class="form-control" id="tec-ele-tecnico" name="ele-reg" required>
                  <option></option>
                </select>                                                 
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
                      <input type="text" class="form-control" id="modal-tecnico-id1" value="0" style="visibility: hidden;">
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
                      <input type="text" class="form-control" id="modal-tecnico-id2" value="0" style="visibility: hidden;" >
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
        <div class="modal-title" id="myModalLabel" align="center"><h4><div id="modal-EF"></div></h4></div>

        </div>
        <div class="modal-body">
          <!-- Galeria de Ejercicios -->
          <form class="form-horizontal">
            <div class="row">
              <label class="col-sm-2 control-label">Preparacion:</label>
                <div class="col-sm-3">
                  <input type="hidden" id="idPreparacion-fi" value="3"></input>
                  <input type="text" class="form-control" id="" readonly="" value="Preparacion Fisica">
                </div>
                <label class="col-sm-2 control-label">Elemento Tec.:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="tec-ele-fisico" required>
                    <?php echo $elemento_tecnico_fis; ?>                  
                  </select>              
                </div>
              </div>    
              <br>
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
                          <input type="text" class="form-control" id="modal-fisico-id1" value="0" style="visibility:hidden">
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
                          <input type="text" class="form-control" id="modal-fisico-id2" value="0" style="visibility:hidden">
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
            <div class="modal-title" id="myModalLabel" align="center"><h4><div id="modal-TA"></div></h4>

            </div>
          </div>
          <div class="modal-body">
            <!-- Galeria de Ejercicios -->
            <form class="form-horizontal">
              <div class="row">
                <label class="col-sm-2 control-label">Preparacion:</label>
                <div class="col-sm-3">
                  <input type="hidden" id="idPreparacion-fi" value="3"></input>
                  <input type="text" class="form-control" id="" readonly="" value="Sistema de Juego">
                </div>                        
                <label class="col-sm-2 control-label">Elemento Tec.:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="tec-ele-tactico" required>
                    <?php echo $elemento_tecnico_tac; ?>                  
                  </select>              
                </div>            
              </div>    
              <br>                
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
                          <input type="text" class="form-control" id="modal-tactico-id1" value="0" style="visibility:hidden">
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
                      <input type="text" class="form-control" id="modal-tactico-id2" value="0" style="visibility:hidden">
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
            <div class="modal-title" id="myModalLabel" align="center"><h4><div id="modal-PS"></div></h4></div>
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
                          <input type="text" class="form-control" id="modal-psi-id1" value="0" style="visibility:hidden">
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
                          <input type="text" class="form-control" id="modal-psi-id2" value="0" style="visibility:hidden">
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
            <div class="modal-title" id="myModalLabel" align="center"><h4><div id="modal-CM"></div></h4>

            </div>
          </div>
          <div class="modal-body">
            <!-- Galeria de Ejercicios -->            
            <form class="form-horizontal">              
              <div class="row">            
                <label class="col-sm-2 control-label">Preparacion:</label>
                <div class="col-sm-3">
                  <input type="hidden" id="idPreparacion-comp" value="5"></input>
                  <input type="text" class="form-control" id="" readonly="" value="Competencia">
                </div>                            
                <label class="col-sm-2 control-label">Elemento Tec.:</label>
                <div class="col-sm-3">
                  <select class="form-control" id="tec-ele-comp" required>
                    <?php echo $elemento_comp; ?>                  
                  </select>              
                </div>            
              </div>    
              <br>        
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
                          <input type="text" class="form-control" id="modal-comp-id1" value="0" style="visibility:hidden">                
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
                          <input type="text" class="form-control" id="modal-comp-id2" value="0" style="visibility:hidden">                    
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
  <script type="text/javascript" src="/Desarrollo_SSPED/Futbol/Dosificacion/dosificacionFutbolCrearTablaPequena.js"></script>