<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>AGRADECIMIENTOS SUCURSAL RESISTENCIA</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
  <script src="bootstrapjs/bootstrap.min.js"></script>
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
<!--<table width="90%" align="center">
  <tr>
    <td> -->
    <div class="container-fluid"  align="center">
	 <h1>Sus palabras nos fortalecen...</h1><br>
     </div>
   <!-- </td>
   </tr>
   <tr> --><br /><!--</tr> -->
      <!--<tr> --><br /><!--</tr>
</table> -->

<div class="container-fluid">
<!--<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" background="transparent"> -->

<?php
$sql= "SELECT * FROM aggradecimiento where Estado=2 AND Destinatario=7 order by date_time desc";
$res=mysql_query($sql);

while($sep = mysql_fetch_array($res))
{
		$fecha = $sep['date_time'];
		preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$fecha,$partes);
		$sucursales= mysql_query("SELECT id, Nombre as Sucursal FROM localidad WHERE id='".$sep['Destinatario']."'");
		$sucursal = mysql_fetch_array($sucursales);
		echo "
		<br>

		<div class='container-fluid'>
			<div class='row col-sm-12'>
				<div class='col-sm-3' style='font-weight:bold;background-color: #E8E3C3;'>
					DE 
				</div>
				
				<div class='col-sm-9'>
					".$sep['Nombre']."
				</div>
			</div>
		
			
			<div class='row col-sm-12'>
				<div class='col-sm-3' style='font-weight:bold;background-color: #E8E3C3;'>
					PARA 
				</div>
				<div class='col-sm-9'>
					Sucursal ".$sucursal['Sucursal']."
				</div>
			</div>
			
			
			<div class='row col-sm-12'>
				<div class='col-sm-3' style='font-weight:bold;background-color: #E8E3C3;'>
					MENSAJE 
				</div>
				<div class='col-sm-9'>
					".$sep['Mensaje']."
				</div>
			</div>
			
			<div class='row col-sm-12'>
				
					<h1>................................................................................................</h1>
			</div>
						";
			echo"</div>
			
	";
}//CIERRO: while($sep = mysql_fetch_array($sql))
?>
</div>
<!--</table> -->
<?php mysql_close();?>
</BODY>
</HTML>