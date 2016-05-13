<?php
if($_POST['imp']=='excel')
{
	header("Content-type: application/vnd.ms-excel; name='excel'");
	header("Content-Disposition: filename=".$_POST['nombre'].".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	echo $_POST['datos_a_enviar'];
}
elseif($_POST['imp']=='pdf')
{
	
	include("dompdf_config.inc.php"); 
	
	
	$documento=$_POST['nombre'].'.pdf';
	//se crea una nueva instancia al DOMPDF
	$dompdf = new Dompdf();
	//se carga el codigo html
	$dompdf->load_html($_POST['datos_a_enviar']);
	//aumentamos memoria del servidor si es necesario
	ini_set("memory_limit","32M"); 
	//lanzamos a render
	$dompdf->render();
	//guardamos a PDF
	$dompdf->stream($documento);
}

?>