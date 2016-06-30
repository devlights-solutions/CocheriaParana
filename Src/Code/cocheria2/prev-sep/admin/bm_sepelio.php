<?php
include('../conexion.php'); 
global $mensaje;
$mensaje = ""; 
//echo "error1:".$_GET['error_borrar'];
if($_SESSION['error_borrar']==1)
{
	$mensaje= "NO se pudo eliminar el Sepelio, intente m&aacute;s tarde.";
}
if($_SESSION['error_borrar']==2)
{
		//echo "errorIF:".$_GET['error_borrar'];
		$mensaje= "El Sepelio se ELIMIN&Oacute; con exit&oacute;.";
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
    <title>Agregar Sepelio</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Modificar/Eliminar Sepelio<h2><br>
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
      <td width="280"><div align="center"><strong>Nombre</strong></div></td>
      <td width="120"><div align="center"><strong>Fecha Sepelio</strong></div></td>
      <td width="100"><div align="center"><strong>Modificar</strong></div></td>
      <td width="100"><div align="center"><strong>Eliminar</strong></div></td>
    </tr>
    <?php
	$sql= "SELECT cod_sep, fecha_sep, nom_sep FROM sepelio ORDER BY fecha_sep DESC";
	$res=mysql_query($sql);
	while($sep = mysql_fetch_array($res))
	{
		$fecha = $sep['fecha_sep']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);	

		echo "<tr bgcolor='#FFFFFF'>
				<td>".ucwords(strtolower($sep['nom_sep']))."</td>
				<td align='center'>".$partes[3]."/".$partes[2]."/".$partes[1]."</td>
				<td align='center'>
					<a href='modificar_sepelio.php?idsep=".$sep['cod_sep']."&act=1'>
						<img src='img/iconoeditar.png' alt='Editar Aviso' border='0'>
					<a>	
				</td>
				<td align='center'>
					<a href='borrar_sepelio.php?idsep=".$sep['cod_sep']."&act=2'>
						<img src='img/iconoborrar.png' alt='Borrar Aviso' border='0'>
					</a>
				</td>
			</tr>";
			
	}
?>
  </table>		
</body>
</html>