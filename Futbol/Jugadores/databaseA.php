<?php

	if(!function_exists('modificarTxt')){
		function modificarTxt($filename){
			$fp = fopen($filename,"wb");
			fputs($fp,'1');
			fclose($fp);
		}
	}
	function llamada2(){
	return $entrada = array("localhost","bd_ssped","root","");
	 
	}
	
	function insertA($tabla,$campos,$tipo,$valores){
		$vect = llamada2();
		$sql='INSERT INTO '.$tabla.'(';
		$sw=TRUE;
		foreach ($campos as $campo) {
				
			if(!$sw)
				$sql.=',';
			else 
				$sw=FALSE;
			
			$sql.='`'.$campo.'`';
		}
		$sql.=')VALUES(';
		$sw=TRUE;
		for($i=0;$i<count($campos);$i++){
				
			if(!$sw)
				$sql.=',';
			else 
				$sw=FALSE;
			
			if ($tipo[$i]==2)
				$sql.="'".$valores[$i]."'";
			else
				$sql.="''";
		}
		$sql.=');';
		
		
		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		$cnn->executeSQL($sql);
		return $sql;
		//return mysql_insert_id();//Funcion que se devuelve cuando alguien se registra
	}
	function updateA($tabla,$campos,$tipo,$valores,$donde,$id){
		$vect = llamada2();
		$sql='UPDATE '.$tabla.' SET ';
		
		for($i=0;$i<count($campos);$i++) {
			if($i>0) $sql.=',';
			$sql.='`'.$campos[$i].'`=';
			switch($tipo[$i]){
				case 1:
					$sql.=$valores[$i];
					break;
				case 2:
					$sql.="'".$valores[$i]."'";
					break;
				case 3:
					$sql.='UNHEX('.$valores[$i].')';
					break;		
			}
		}
		
		$sql.=' WHERE '.$donde.' ='.$id.';';
		
		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		$cnn->executeSQL($sql);
		return true;
	}
	
	
	
	function deleteA($tabla,$campos,$id){
		$vect = llamada2();
		$sql='DELETE FROM '.$tabla.' WHERE '.$campos[0].'='.$id.';';
		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		return $cnn->executeSQL($sql);
		}
	
	function selectA($tabla, $campos=0, $id=0, $amplitud=0, $orden=0, $tipo=0){
		$vect = llamada2();
		$sql='SELECT * FROM '.$tabla; //tabla define la tabla que se elegira
		
		if($id!="0"){
			$sql.=' WHERE '.$campos[0].'=\''.$id[0]."'"; //id describe los valores de comparacion para seleccionar comparandolas con campos.
			for($i=1;$i<count($campos);$i++){
				$sql.=' AND '.$campos[$i].'=\''.$id[$i]."'";
				}
		}
		
		if($orden!="0"){ //define el campo que se quiere ordenar
		$sql.=' ORDER BY '.$orden[0].' '.$tipo[0];
			for($i=1;$i<count($orden);$i++){
				$sql.=' , '.$orden[$i].' '.$tipo[$i];
				}
		
		}
		
		if($amplitud!=0){ //define la cantidad de registros que se seleecionará
		$sql.=' LIMIT '.$amplitud[0].' , '.$amplitud[1];
		}

		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		return $cnn->executeSQL($sql);
	}
	
	function selectOrA($tabla, $campos=0, $id=0, $amplitud=0, $orden=0, $tipo=0){
		$vect = llamada2();
		$sql='SELECT * FROM '.$tabla; //tabla define la tabla que se elegira
		
		if($id!="0"){
			$sql.=' WHERE '.$campos[0].'=\''.$id[0]."'"; //id describe los valores de comparacion para seleccionar comparandolas con campos.
			for($i=1;$i<count($campos);$i++){
				$sql.=' OR '.$campos[$i].'=\''.$id[$i]."'";
				}
		}
		
		if($orden!="0"){ //define el campo que se quiere ordenar
		$sql.=' ORDER BY '.$orden[0].' '.$tipo[0];
			for($i=1;$i<count($orden);$i++){
				$sql.=' , '.$orden[$i].' '.$tipo[$i];
				}
		
		}
		
		if($amplitud!=0){ //define la cantidad de registros que se seleecionará
		$sql.=' LIMIT '.$amplitud[0].' , '.$amplitud[1];
		}
		
		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		return $cnn->executeSQL($sql);
		
	}
	
	function execSqlA($sql){
		$vect = llamada2();
		$cnn=new clsConexion2($vect[0],$vect[1],$vect[2],$vect[3]);
		return $cnn->executeSQL($sql);
	}
	
        function RecuperarIdItemA($Tabla_BD, $TipoId, $ValorId){
		$TablaId = selectA($Tabla_BD, $TipoId, $ValorId);
		$Item = mysqli_fetch_array($TablaId);
		if($Item)
		{return $Item;
		}else{
		return false;
		}
	}
	
	class clsConexion2{
		private $db;
		private $server; 
		private $usr;
		private $psw;
		
		private $cxn='';
		
		function __construct($serveri,$dbi,$usri,$pswi) {
		$this->server = $serveri;
		$this->usr = $usri;
		$this->psw = $pswi;
		$this->db= $dbi;
		}
			
		
		private function conectar(){
			$this->cxn=mysqli_connect($this->server,$this->usr,$this->psw);
			if($this->cxn){
				return true;
			}else{
				echo 'Huascar, se ha producido el siguiente error al intentar acceder a la base de datos: '.mysql_connect_error();
				return false;
			}
		}
		
		public function executeSQL($query){
			$tabla_consulta=NULL;
			if($this->conectar()){
				mysqli_select_db($this->cxn,$this->db);
				$tabla_consulta=mysqli_query($this->cxn,$query);
			}
			return $tabla_consulta;
		}	
	}

?>