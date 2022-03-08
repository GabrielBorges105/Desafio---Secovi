<?php
function formatString($string){
	$arrayDaString = str_split($string);
	$maiuscula = true;
	$stringFormatada = '';
	for($i=0; $i<count($arrayDaString); $i++){
		if($maiuscula){
			$stringFormatada .= strtoupper($arrayDaString[$i]);
			$maiuscula = false;
		}else{
			$stringFormatada .= strtolower($arrayDaString[$i]);
			$maiuscula = true;
		}
	}
	echo $stringFormatada."<br/><br/>";
}

formatString("cARAVELAS");

formatString("Caravelas Portuguesas");

formatString("caravelas");

?>