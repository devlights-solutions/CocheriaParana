<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>AGRADECIMIENTOS</title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">
body {
	background-image: url(http://www.cocheriadelparana.com.ar/home/images/fondo_agr3.jpg);
	background-repeat:repeat-x;
}
</style>
</head>
<BODY>

<?php include('conexion.php'); ?>
<table width="90%" align="center">
  <tr>
    <td>
	 <h1>Sus palabras nos fortalecen...</h1><br>
    </td>
   </tr>
   <tr><br /></tr>
      <tr><br /></tr>
</table>
<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" background="transparent">

<?php
$sql= "SELECT * FROM aggradecimiento where Estado=2 order by date_time desc";
$res=mysql_query($sql);

while($sep = mysql_fetch_array($res))
{
		$fecha = $sep['date_time'];
		preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$fecha,$partes);
		$sucursales= mysql_query("SELECT id, Nombre as Sucursal FROM localidad WHERE id='".$sep['Destinatario']."'");
		$sucursal = mysql_fetch_array($sucursales);
		echo "
		<br>
		<table width='90%'>
			<tr><td height='30' width='80' bgcolor='E8E3C3' style='font-weight:bold'>&nbsp&nbsp&nbspDE </td><td>&nbsp&nbsp&nbsp".$sep['Nombre']."</td></tr>
			<tr><td height='3'></td><td></td></tr>
			<tr><td height='30' bgcolor='E8E3C3' style='font-weight:bold'>&nbsp&nbsp&nbspPARA </td><td>&nbsp&nbsp&nbspSucursal ".$sucursal['Sucursal']."</td></tr>
			<tr><td height='5'></td><td></td></tr>
			<tr><td height='30' bgcolor='E8E3C3' style='font-weight:bold'>&nbsp&nbsp&nbspMENSAJE </td><td>&nbsp&nbsp&nbsp".$sep['Mensaje']."</td></tr>
			<tr><td height='30' align='center'></td><td><h1>................................................................................................</h1></td></tr>
						";
			echo"</table>
			
	";
}//CIERRO: while($sep = mysql_fetch_array($sql))
?>
</table>
<?php mysql_close();?>
</BODY>
</HTML>