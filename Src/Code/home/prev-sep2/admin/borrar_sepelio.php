<?php 
include('../conexion.php');
ob_start();
session_start();
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
	 <h2>Eliminar Sepelio<h2><br>
   </td>
   </tr>
</table>
<?php
if($_GET['act']==2){
	if($_GET['idsep']){
		$sql = mysql_query("select * from sepelio WHERE cod_sep ='".$_GET['idsep']."'");
		$registro_sep = mysql_fetch_array($sql);
?>
<table width="705" align="center">
  <tr>
    <td align="center"><span class="mens-alert">&iquest;Est&aacute; seguro que desea eliminar el Sepelio de <span class="mens-alert-nom"><?php echo $registro_sep['nom_sep'] ?></span>?</span><br><br></td>
   </tr>
</table>
<table width="705" align="center">
  <tr>
    <td align="center"><span class="btn1"><a href="borrar_sepelio.php?idsep=<?php echo $registro_sep['cod_sep'] ?>&act=2&eli=678">Sí, Eliminar</a></span></td>
    <td align="center"><span class="btn1"><a href="bm_sepelio.php">No, Regresar</span></a></td>
   </tr>
</table>
<?php
	}
	if($_GET['eli']==678){
		$cod_sep = $_GET['idsep'];
		$eliminar = "DELETE FROM sepelio WHERE cod_sep='".$cod_sep."'";
		mysql_query($eliminar);// or die("NO se eliminó el registro");
		$error_sql=mysql_error();
		header('Location: 2.php');
		if($error_sql!="")
		{ 
			$_SESSION['error_borrar']=1;
			header("Location:bm_sepelio.php"); //NO se eliminó el registro
		}
		else
		{
			$_SESSION['error_borrar']=2;
			header("Location:bm_sepelio.php");//SE eliminó el registro
		}
		mysql_close();	
	}	
}
ob_end_flush();
?>
