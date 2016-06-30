<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
	switch ($_GET['salsep']) {
     case 1:
         $salloc = "Corrientes"; break;
     case 2:
         $salloc = "Goya"; break;
    case 3:
         $salloc = "Bella Vista"; break;
    case 4:
         $salloc = "Ituzaingó"; break;
    case 5:
         $salloc = "Posadas"; break;
    case 6:
         $salloc = "Resistencia"; break;
    case 7:
         $salloc = "Formosa"; break;
	default:
         $salloc = "Corrientes"; break;
	break;
	}
	?>  
    <title><?php echo strtoupper($salloc);  ?> / MISAS</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<?php include('../conexion.php'); ?>
<table width="705" align="center">
  <tr>
    <td>
	 <h1><?php echo strtoupper($salloc);  ?> / MISAS</h1><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="10" background="../images/flores_misas.png" height="413">
<tr>
<td width="235" valign="top">
<table id="tabla" cellpadding="0" cellspacing="5" width="100%">
<tr><td id="titulo_misas_det">Cochería del Paraná lo invita a la Santa Misa para rogar por el eterno descanso de: <br /><br /></td></tr>
<?php
$sql= "SELECT cod_mis, nombre_mis, lugar_mis, fecha_mis, dia_mis FROM misas WHERE fecha_mis='".$_GET['femis']."' ORDER BY nombre_mis ASC";
$res = mysql_query($sql) or die ("Error en Conexion con Base de Datos");
while($mis = mysql_fetch_array($res))
{
		$fecha = $mis['fecha_mis']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);		
		
	
		echo "
			<tr><td id='desc_misas'>".ucwords(strtoupper($mis['nombre_mis']))." - ".$partes[3]."/".$partes[2]."/".$partes[1]." en la ".ucwords($mis['lugar_mis'])."</td></tr>
		";
}//CIERRO: while($sep = mysql_fetch_array($sql))
		echo "</tr>";

?>
</table>
</td>
</tr>
</table>
<?php mysql_close();?>
</BODY>
</HTML>