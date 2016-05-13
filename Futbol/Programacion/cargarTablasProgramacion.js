$(document).on('ready',funcPrincipal);

//CANTIDAD DE CICLOS
var cantidadPG=5;
var cantidadPE=3;
var cantidadPC=2;
var cantidadC=6;

var cuerpoTablaPG=$("#cuerpoTablaPG");
var cuerpoTablaPE=$("#cuerpoTablaPE");
var cuerpoTablaPC=$("#cuerpoTablaPC");
var cuerpoTablaC=$("#cuerpoTablaC"); 

//VALORES TOTALES DE LA SUMA EN LAS TABLAS
var totalPG=0;
var totalPE=0;
var totalPC=0;
var totalC=0;

//VALOR ESPERADO POR CICLO
var esperadoPG;
var esperadoPE=10;
var esperadoPC=10;
var esperadoC=10;

var btnContinuar=$("#btnCotinnuar");



function funcPrincipal(){
	btnContinuar.on( "click", function(){
		// OBTENER LOS CALORES DE LOS INPUTS DE TEXTO
		esperadoPG=$("#tiempo3").text();
		cantidadPG=$("#meso1").val();

		esperadoPE=$("#tiempo4").text();
		cantidadPE=$("#meso2").val();

		esperadoPC=$("#tiempo5").text();
		cantidadPC=$("#meso3").val();

		esperadoC=$("#tiempo6").text();
		cantidadC=$("#meso4").val();

		//VERIFICAR QUE LOS DATOS SEAN CORRECTOS: QUE EL TIEMPO DE MESES NO SEA MENOR A LA CANTIDAD DE MESOCICLOS, 
		//Y QUE LA CANTIDAD DE TIEMPO NO SEA MAYOR A LA CANTIDAD DE MESOCICLOS POR 6, QUE ES POR AHORA LA MAXIMA
		//CANTIDAD DE TIEMPO ESTABLECIDO POR MESOCICLO.

		/*	if (esperadoPG<cantidadPG){
			alert("Verifique que la cantidad de mesocilios sea por lo minimo igual al tiempo estimado en meses.");
		}else if (esperadoPG>cantidadPG*6){
				alert("Verifique que la cantidad de tiempo pueda abarcarse en la cantidad de mesociclos. ")
			}else{*/
				CargarTablasPG();
				CargarTablasPE();
				CargarTablasPC();
				CargarTablasC();

			//}
		//LLAMAR A LA CREACION DE NUEVO DE LAS TABLAS.
	});
}

//------------ PARA LA PRIMERA TABLA
function CargarTablasPG(){
	cuerpoTablaPG.find('tr').remove();
	cuerpoTablaPG.find('td').remove();
	console.log(esperadoPG);
	for (i=1;i<=cantidadPG;i++){
        cuerpoTablaPG.append('<tr>'+
        	'<td>' + i + '</td>'+
            '<td> <select class="form-control" id="semanaGen_'+i+'" onchange="calculototalPG()">'+
				'<option>2</option>'+
				'<option>3</option>'+
				'<option>4</option>'+
				'<option>5</option>'+
				'<option>6</option>'+
			'</select> </td>'+
            '</tr>');
	}

	cuerpoTablaPG.append('<tr>'+
		'<td> Total </td>'+
		'<td> <label for="lbltotalPG">'+totalPG+'</label></td>'+
		'</tr>'+
            '<tr><td colspan="2" style="padding:0px;"><div id="alert1" style="margin-top:15px;"></div></td></tr>');

	calculototalPG();
}
function calculototalPG(){
	totalPG=0;
	$('#cuerpoTablaPG tr').each(function(){
		$(this).find('td select').each(function(){
			totalPG=totalPG + parseInt($(this).find('option:selected').text());
    	})
	})
	$("label[for='lbltotalPG']").text(totalPG);
	console.log(esperadoPG);
	if (totalPG==esperadoPG){
		$("label[for='lbltotalPG']").css('color', 'green');	
		$('#alert1').html('');
	}else{
		$("label[for='lbltotalPG']").css('color', 'red');	
		$('#alert1').html('<div  style="padding:0px;" class="alert alert-danger" role="alert"><h5> Modificar semanas</h5></div>');	
	}
	
	
}

//------------ PARA LA SEGUNDA TABLA
function CargarTablasPE(){
	cuerpoTablaPE.find('tr').remove();
	cuerpoTablaPE.find('td').remove();
	for (i=1;i<=cantidadPE;i++){
        cuerpoTablaPE.append('<tr>'+
        	'<td>' + i + '</td>'+
            '<td> <select class="form-control" id="semanaEsp_'+i+'" onchange="calculoTotalPE()">'+
				'<option>2</option>'+
				'<option>3</option>'+
				'<option>4</option>'+
				'<option>5</option>'+
				'<option>6</option>'+
			'</select> </td>'+
            '</tr>');
	}

	cuerpoTablaPE.append('<tr>'+
		'<td> Total </td>'+
		'<td> <label for="lblTotalPE">'+totalPE+'</label></td>'+
		'</tr>' +
            '<tr><td colspan="2" style="padding:0px;"><div id="alert2" style="margin-top:15px;"></div></td></tr>');

	calculoTotalPE();
}

function calculoTotalPE(){
	totalPE=0;
	$('#cuerpoTablaPE tr').each(function(){
		$(this).find('td select').each(function(){
			totalPE=totalPE + parseInt($(this).find('option:selected').text());
    	})
	})
	$("label[for='lblTotalPE']").text(totalPE);

	if (totalPE==esperadoPE){
		$("label[for='lblTotalPE']").css('color', 'green');	
		$('#alert2').html('');
	}else{
		$("label[for='lblTotalPE']").css('color', 'red');
		$('#alert2').html('<div  style="padding:0px;" class="alert alert-danger" role="alert"><h5> Modificar semanas</h5></div>');	
	}

}


//------------ PARA LA TERCERA TABLA
function CargarTablasPC(){
	cuerpoTablaPC.find('tr').remove();
	cuerpoTablaPC.find('td').remove();
	for (i=1;i<=cantidadPC;i++){
        cuerpoTablaPC.append('<tr>'+
        	'<td>' + i + '</td>'+
            '<td> <select class="form-control" id="semanaPComp_'+i+'" onchange="calculoTotalPC()">'+
				'<option>2</option>'+
				'<option>3</option>'+
				'<option>4</option>'+
				'<option>5</option>'+
				'<option>6</option>'+
			'</select> </td>'+
            '</tr>');
	}

	cuerpoTablaPC.append('<tr>'+
		'<td> Total </td>'+
		'<td> <label for="lblTotalPC">'+totalPC+'</label></td>'+
		'</tr>'+
            '<tr><td colspan="2" style="padding:0px;"><div id="alert3" style="margin-top:15px;"></div></td></tr>');

	calculoTotalPC();
}

function calculoTotalPC(){
	totalPC=0;
	$('#cuerpoTablaPC tr').each(function(){
		$(this).find('td select').each(function(){
			totalPC=totalPC + parseInt($(this).find('option:selected').text());
    	})
	})
	$("label[for='lblTotalPC']").text(totalPC);

	if (totalPC==esperadoPC){
		$("label[for='lblTotalPC']").css('color', 'green');	
		$('#alert3').html('');
	}else{
		$("label[for='lblTotalPC']").css('color', 'red');	
		$('#alert3').html('<div  style="padding:0px;" class="alert alert-danger" role="alert"><h5> Modificar semanas</h5></div>');
	}
	
}


//------------ PARA LA CUARTA TABLA
function CargarTablasC(){
	cuerpoTablaC.find('tr').remove();
	cuerpoTablaC.find('td').remove();
	for (i=1;i<=cantidadC;i++){
        cuerpoTablaC.append('<tr>'+
        	'<td>' + i + '</td>'+
            '<td> <select class="form-control" id="semanaComp_'+i+'" onchange="calculoTotalC()">'+	            
				'<option>2</option>'+
				'<option>3</option>'+
				'<option>4</option>'+
				'<option>5</option>'+
				'<option>6</option>'+				
			'</select> </td>'+
            '</tr>');
	}

	cuerpoTablaC.append('<tr>'+
		'<td> Total </td>'+
		'<td> <label for="lblTotalC">'+totalC+'</label></td>'+
		'</tr>'+
            '<tr><td colspan="2" style="padding:0px;"><div id="alert4" style="margin-top:15px;"></div></td></tr>');

	calculoTotalC();
}

function calculoTotalC(){
	totalC=0;
	$('#cuerpoTablaC tr').each(function(){
		$(this).find('td select').each(function(){
			totalC=totalC + parseInt($(this).find('option:selected').text());
    	})
	})
	$("label[for='lblTotalC']").text(totalC);

	if (totalC==esperadoC){
		$("label[for='lblTotalC']").css('color', 'green');	
		$('#alert4').html('');
	}else{
		$("label[for='lblTotalC']").css('color', 'red');
		$('#alert4').html('<div  style="padding:0px;" class="alert alert-danger" role="alert"><h5> Modificar semanas</h5></div>');

	}
	
}

