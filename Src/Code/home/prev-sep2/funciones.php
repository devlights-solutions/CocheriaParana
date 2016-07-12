<?php
/*session_start();
if ($_SESSION[usuario_logueado]==false)
{
	header("Location:../usuarios/usuarios.php");
}*/
function comprobar_nombre_usuario_expresiones_regulares($nombre_usuario){ 
   if (ereg("^[a-zA-Z0-9\-_]{5,20}$", $nombre_usuario)) { 
      echo "El nombre de usuario $nombre_usuario es correcto<br>"; 
      return true; 
   } else { 
       echo "El nombre de usuario $nombre_usuario no es válido<br>"; 
      return false; 
   } 
} 


function nombre($entrada)
{// de 3 a 100 cararcteres
   if (ereg("^[a-zA-Z0-9\-_]{3,100}$", $entrada)) 
   {
      //$entrada: es correcto
      return true;
   } 
   else 
   {
       // $entrada no es válido";
       return false;
   }
}

function descripcion($entrada)
{
   if(ereg("^[a-zA-Z0-9]{3,300}$", $entrada)) 
   {
      //$entrada: es correcto
      return true;
   } 
   else 
   {
       // $entrada no es válido";
       return false;
   }
}

function nick($entrada)
{
   if(ereg("^[a-zA-Z0-9\-_]{5,20}$", $entrada)) 
   {
      //$entrada: es correcto
      return true;
   } 
   else 
   {
       // $entrada no es válido";
       return false;
   }
}

function clave($entrada)
{
   if(ereg("^[a-zA-Z0-9]{5,20}$", $entrada)) 
   {
      //$entrada: es correcto
      return true;
   } 
   else 
   {
       // $entrada no es válido";
       return false;
   }
}

function solo_entero($cad)
{
	// bool ctype_digit ( string texto )
	// Verifica si todos los caracteres en la cadena entregada, texto, son numéricos. 
	$cadena=trim($cad);
	if ((eregi("^([0-9])*$", $cadena)) and (ctype_digit($cadena)) and ($cadena > 0))
	{ 
		return true;
		//"Correcto: ES nro(5)"; 
	}else{ 
		return false;
		//"Incorrecto: NO ES nro(5)"; 
	}
}

function solo_alfanumerico($cad)
{
	// bool ctype_alnum ( string texto )
	// Chequea si todos los caracteres en la cadena entregada, texto, son alfanuméricos.
	// VER: http://www.php-es.com/function.ctype-alnum.html
	$entrada=trim($cad);
	if (ctype_alnum($entrada))
	{ 
		return true;
		// "Correcto: ES alfanumerico(6)"; 
	}else{ 
		return false;
		// "Incorrecto: NO ES alfanumerico(6)"; 
	}
}

function solo_alfabeto($cad)
{
	// bool ctype_alpha ( string texto )
	// Verifica si todos los caracteres en la cadena entregada,texto, son alfabéticos.
	// VER: http://www.php-es.com/function.ctype-alpha.html
	$entrada=trim($cad);
	if (ctype_alpha($entrada))
	{ 
		return true;
		// "Correcto: ES alfabeto(7)"; 
	}else{ 
		return false;
		// "Incorrecto: NO ES alfabeto(7)"; 
	}
}
?>