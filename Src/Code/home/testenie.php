<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
		
//echo ucwords(strtolower('ÑANDU NÑandu'));

function limpiarString($string) //función para limpiar strings
   {
      $string = strip_tags($string);
      $string = htmlentities($string);
      return stripslashes($string);  
// si llevaremos esto a mySQL deberímos agregar al final mysql_real_escape_string($string);
   }
echo   ucwords(strtolower(limpiarString('NUÑEZ NIÑO RICO')));
?>

</head>

</HTML>