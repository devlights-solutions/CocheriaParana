<?php
include('../conexion.php'); 
global $mensaje;
$mensaje = ""; 
//echo "error1:".$_GET['error_borrar'];
if($_SESSION['error_borrar']==1)
{
	$mensaje= "NO se pudo eliminar el Fondo, intente m&aacute;s tarde.";
}
if($_SESSION['error_borrar']==2)
{
		//echo "errorIF:".$_GET['error_borrar'];
		$mensaje= "El Fondo se ELIMIN&Oacute; con exit&oacute;.";
}
if($_SESSION['error_borrar']==1)
{
	$mensaje= "Datos incorrectos(error uno).";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Eliminar Fondo</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Eliminar Fondo<h2><br>
   </td>
   </tr>
</table>
<table width="705" align="center">
  <tr>
    <td>
	 <span id="mens-alert"><?php echo $mensaje; $mensaje="";?></span>
   </td>
   </tr>
</table>
<table width="705" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <table width="705">
    <tr id="encabezado">
      <td width="120"><div align="center"><strong>Título</strong></div></td>
      <td width="400"><div align="center"><strong>Fondo</strong></div></td>
      <td width="100"><div align="center"><strong>Eliminar</strong></div></td>
    </tr>
    <?php
	$sql= "SELECT * FROM fondos ORDER BY tit_fon DESC";
	$res=mysql_query($sql);
	while($fon = mysql_fetch_array($res))
	{

		echo "<tr bgcolor='#FFFFFF'>
				<td align='center'>".ucwords(strtolower($fon['tit_fon']))."</td>
				<td align='center'><img src='../fondos/".$fon['url_fon']."' alt='".$fon['tit_fon']."' width='400' height='190' border='0'></td>
				<td align='center'>
					<a href='borrar_fondo.php?idfon=".$fon['cod_fon']."&act=2'>
						<img src='img/iconoborrar.png' alt='Borrar Fondo' border='0'>
					</a>
				</td>
			</tr>";
			
	}
?>
  </table>		
</body>
</html>