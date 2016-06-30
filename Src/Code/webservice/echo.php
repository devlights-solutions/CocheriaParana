<?php

$str = 'ñandu  -   degsgsd';

echo $str;
echo '</br>';


	$explode = explode(" ",$str);
	
	
	
	//$array =str_word_count(($str), 1,'Ã±');
	
	
	$normalice='';
	echo count($explode);
	for ($i = 0; $i <= (count($explode) -1); $i++) {
		
		if (trim($explode[$i]) != '')
			$normalice=$normalice.$explode[$i].' ';
	}
	
	echo ($normalice);
	
	
	
	

 
   
//$palabras = str_word_count(utf8_decode($str),1); // obtener array con las palabras. 
  // $total_palabras = count($palabras)-1; // contar total array elementos y restar 1 elementos 
   //$palabras = array_splice($palabras,0,$total_palabras); // le quitamos la ultima palabra. 
   //$frase_salida = implode(' ',$palabras); //  y concatenamos con el espacio hacia una cadena. 
   //$frase_salida .= "..."; // se añaden los puntos suspensivos a la cadena obtenida.. 
 
  // return utf8_encode($frase_salida); 

?>