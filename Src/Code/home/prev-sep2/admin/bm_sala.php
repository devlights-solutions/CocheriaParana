<?php
include('../conexion.php'); 
global $mensaje;
$mensaje = ""; 
//echo "error1:".$_GET['error_borrar'];
if($_SESSION['error_borrar']==1)
{
	$mensaje= "NO se pudo eliminar la Sala, intente m&aacute;s tarde.";
}
if($_SESSION['error_borrar']==2)
{
		//echo "errorIF:".$_GET['error_borrar'];
		$mensaje= "La Sala se ELIMIN&Oacute; con exit&oacute;.";
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
    <title>Eliminar Sala</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Eliminar Sala<h2><br>
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
      <td width="120"><div align="center"><strong>Provincia</strong></div></td>
      <td width="100"><div align="center"><strong>Localidad</strong></div></td>
      <td width="180"><div align="center"><strong>Dirección</strong></div></td>
      <td width="100"><div align="center"><strong>Sala</strong></div></td>
      <td width="100"><div align="center"><strong>Eliminar</strong></div></td>
    </tr>
    <?php
	$sql= "SELECT cod_sal, localidad_sal, prov_sal, direc_sal, sala FROM salas ORDER BY prov_sal, localidad_sal, sala DESC";
	$res=mysql_query($sql);
	while($sal = mysql_fetch_array($res))
	{

		echo "<tr bgcolor='#FFFFFF'>
				<td align='center'>".ucwords(strtolower($sal['prov_sal']))."</td>
				<td align='center'>".ucwords(strtolower($sal['localidad_sal']))."</td>
				<td align='center'>".ucwords(strtolower($sal['direc_sal']))."</td>
				<td align='center'>".ucwords(strtolower($sal['sala']))."</td>
				<td align='center'>
					<a href='borrar_sala.php?idsal=".$sal['cod_sal']."&act=2'>
						<img src='img/iconoborrar.png' alt='Borrar Aviso' border='0'>
					</a>
				</td>
			</tr>";
			
	}
?>
  </table>		
</body>
</html>