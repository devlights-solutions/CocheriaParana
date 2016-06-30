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
		 case 8:
         $salloc = "Puerto Rico"; break;
	default:
         $salloc = "Corrientes"; break;
	break;
	}
	?>  
    <title>SEPELIOS DEL DÍA - CORRIENTES</title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<?php include('conexion.php'); ?>
<table width="705" align="center">
  <tr>
    <td>
	 <h1><?php echo $salloc; ?> / Velatorios on line - <?php include('fecha.php') ?>&nbsp;</h1><br>
   </td>
   </tr>
</table>
<table width="710"  height="263" align="center" border="0" cellpadding="1" cellspacing="1" background="images/velatoriosonline.jpg">
<tr>
<td width="350">&nbsp;</td>
<td align="right">
<form action="" method="post" enctype="multipart/form-data">
		<table>
        <tr><td align="center"><span id="mensaj">Ingrese la Contraseña:</span></td></tr>
        <tr><td align="center"><input type="password" name="pass_vel" id="pass_vel" size="30"></td></tr>
        <tr><td align="center"><input name="acceder_vel" type="submit" id="acceder_vel" value="Acceder al Velatorio" class="btn1" /></td></tr>
        </table>
</form>
<td>
</tr>
</table>
</BODY>
</HTML>