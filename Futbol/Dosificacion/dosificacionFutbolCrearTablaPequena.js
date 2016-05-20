
//LO PRIMERO QUE DEBE HACER ES CARGAR EL SELECT CON JSON... 

// DE LA FUNCION CHANGE DE CADA MICROCICLO SE DEBE CAMBIAR ESTE VALOR PARA QUE SOLO SE PUEDAN SELECCIONAR ESA CANTIDAD DE DIAS.
// NO DEBE DEJAR SELECCIOANRSE MAS DE ESTA CANTIDA DE DIAS. 

// BOTON PARA CARGAR LA TABLA
function dias_escogidos(){
	var dias=0;

	if ($("#checkLu").is(':checked')){
		dias+='1';
	}
	if ($("#checkMa").is(':checked')){
	dias+='2';
	}
	if ($("#checkMi").is(':checked')){
	dias+='3';
	}
	if ($("#checkJu").is(':checked')){
	dias+='4';
	}
	if ($("#checkVi").is(':checked')){
	dias+='5';
	}
	if ($("#checkSa").is(':checked')){
	dias+='6';
	}
	if ($("#checkDo").is(':checked')){
	dias+='7';
	}
	return dias;
}
// SELECT SELECCIONADOR DEL MICROCICLO
function generarTabla(){
	// PARA LA CABECERA DE LA TABLA
	var dias=0;
	cabeceraTablaDias='<tr>';
cabeceraTablaDias+='<th>Nombre</th><th>T.T</th>';
	if ($("#checkLu").is(':checked')){
		cabeceraTablaDias+='<th> <button type="button" class="btn btn-primary" onclick="diasemana(1,1);"  style="width: 130px;">Lunes</button><br><input style="width: 130px;" required type="date" id="fechalunes" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
		dias+='1';
	}
	if ($("#checkMa").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(2,2);" style="width: 130px;"> Martes </button><br><input style="width: 130px;" required type="date" id="fechamartes" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='2';
	}
	if ($("#checkMi").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(3,3);" style="width: 130px;"> Miercoles </button></><br><input style="width: 130px;" required type="date" id="fechamiercoles" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='3';
	}
	if ($("#checkJu").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(4,4);" style="width: 130px;"> Jueves </button><br><input style="width: 130px;" required type="date" id="fechajueves" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='4';
	}
	if ($("#checkVi").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(5,5);" style="width: 130px;"> Viernes </button><br><input style="width: 130px;" required type="date" id="fechaviernes" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='5';
	}
	if ($("#checkSa").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(6,6);" style="width: 130px;"> Sabado </button><br><input style="width: 130px;" required type="date" id="fechasabado" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='6';
	}
	if ($("#checkDo").is(':checked')){
		cabeceraTablaDias+='<th><button type="button" class="btn btn-primary" onclick="diasemana(7,7);" style="width: 130px;"> Domingo </button><br><input style="width: 130px;" required type="date" id="fechadomingo" step="1" min="2015-01-01" max="2020-12-31" value="'+"<"+'?php echo date('+"'Y-m-d'"+');?'+">"+'"></th>';
	dias+='7';
	}

	console.log(dias);
	cabeceraTablaDias+='</tr>'; 
$("#cabeceraTablaDias").html(cabeceraTablaDias);

            var idequipo = $('#equipo-cre').val();
            var idplan= $("#plan-cre").val();
            var fecha= $("#plan-cre-fecha").val();
            var n = $('#micro-cre').val();

            var o = "idplan="+encodeURIComponent(idplan)+"&idequipo="+ encodeURIComponent(idequipo)+"&fecha="+encodeURIComponent(fecha);
            console.log(o);      
          $.ajax({
            url:"llenado_selects.php",
            type: "POST",
            data:o,
        }).done(function(data2) {
        	console.log(data2);
               var diasPosibles=data2[2];
               var tiempo_clase=data2[6]+data2[7];
               console.log(tiempo_clase);


					console.log(diasPosibles);

// PARA LA CABECERA DE LA TABLA
            console.log(n);
            var oo = "a="+encodeURIComponent(n)+"&opcion="+ encodeURIComponent('buscara');//{a: n, opcion:'buscar'};
            console.log(oo);
            
              $.ajax({
                url: 'dosificacion.php',
                type: 'POST',
                data: oo
              })
              .done(function(data2) {
                var resp = $.parseJSON(data2);//json a objeto
                console.log(data2);
                console.log(resp);

                //var html = '<div class="col-sm-3 table-responsive"><br><table class="table table-hover"><thead><tr><th>Nombre</th><th>T.T</th>' 
                        
                  for(i in resp){ 
                  	var tec=resp[i].sistema_juego;
                  	var fis=resp[i].preparation_fisica;
                  	var tac=resp[i].tecnico_tactico;
                  	var psi=resp[i].accion_psi;
                  	var comp=resp[i].competencia;
                  	console.log(tec);
                  	console.log(comp);
                  //  html+='<tr style="display:none"><td >'+resp[i].idDireccion+'</td></tr><tr><td><br>Tecnico</td><td id="tec"><br>'+resp[i].sistema_juego+'</td></tr><tr><td><br>Preparation Fisica</td><td id="fis"><br>'+resp[i].preparation_fisica+'</td></tr><tr><td><br>Sistema de Juego</td><td id="tac"><br>'+resp[i].tecnico_tactico+'</td></tr><tr><td><br>Accion Psi</td><td id="psi"><br>'+resp[i].accion_psi+'</td></tr><tr><td><br>Competencia</td><td id="comp"><br>'+resp[i].competencia+'</td></tr><tr><td><br>Sub Total</td><td><br>'+resp[i].total+'</td></tr>';
                  }
                  //html+= '</tbody></table></div>';

                  //$('#resultado2').html(html);
                  var a=["Tecnico", "Fisico", "Tactico", "Accion Psi", "Comp"];
                  var b=[tec, fis, tac, psi, comp];
                  var c=["tec", "fis", "tac", "psi", "comp"];
								var r=0;

				//cuerpoTablaDias='<tr style="display:none"><td >'+resp[i].idDireccion+'</td></tr><tr><td><br>Tecnico</td><td id="tec"><br>'+resp[i].sistema_juego+'</td></tr><tr><td><br>Preparation Fisica</td><td id="fis"><br>'+resp[i].preparation_fisica+'</td></tr><tr><td><br>Sistema de Juego</td><td id="tac"><br>'+resp[i].tecnico_tactico+'</td></tr><tr><td><br>Accion Psi</td><td id="psi"><br>'+resp[i].accion_psi+'</td></tr><tr><td><br>Competencia</td><td id="comp"><br>'+resp[i].competencia+'</td></tr><tr><td><br>Sub Total</td><td><br>'+resp[i].total+'</td></tr>';
						for(i=0;i<5;i++){
											cuerpoTablaDias+='<tr>';
								cuerpoTablaDias+='<td>'+a[i]+'</td><td><input style="width: 70px;" type="text" class="form-control" maxlength="5" readonly="" id="'+c[i]+'" value="'+b[i]+'"/></td>';

							for (j=1;j<=diasPosibles;j++){
								cuerpoTablaDias+='<td><input style="width: 130px;" type="text" value="0" placeholder="0" class="form-control" name="operando'+(r+1)+'" id="operando'+(r+1)+'" onkeyup="calcula('+"'+'"+','+diasPosibles+','+tiempo_clase+','+tec+','+fis+','+tac+','+psi+','+comp+');" maxlength="5" size="1"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > </td>';
						    	r=r+1;
						    }
						    			cuerpoTablaDias+='</tr>';

						    
						         }  
						         for(i=0;i<1;i++){
							
							cuerpoTablaDias+='<tr><td><br>Sub Total</td><td><br>'+resp[i].total+'</td>';
							for (j=1;j<=diasPosibles;j++){
								cuerpoTablaDias+='<td> <input style="width: 130px;"  type="text" value="0" class="form-control" id="res_col'+j+'" name="colum'+j+'" placeholder="0" maxlength="3" size="1" readonly="" /> </td>';

						    }
						        cuerpoTablaDias+='</tr>';

						    
						         }     
						         $("#cuerpoTablaDias").html(cuerpoTablaDias);    
                   


					})
	  })

	
}




