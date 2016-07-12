<?php
include('conexion.php');
	if ($_POST[enviar]){//AGREGA UN NUEVO MENSAJE
						
												
						$sql = "insert into ofrendas(IdSepelio,IdFlor,date_time,Nombre) values('".$_POST[idsep]."','".$_POST[condol]."',now(),'".$_POST[autor]."')";
// ".$_POST[condol]."'
						$resagre = mysql_query($sql);
			
						header('Location: detalle_sep.php?idsep='.$_POST[idsep].'');
				
			

	}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>SEPELIOS DE CORRIENTES</title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<table align="center" width="705" cellpadding="0" cellspacing="0" bgcolor="#F4F2E5">
	<tr>
		<td valign="top">
				<form method="post" action="" enctype="multipart/form-data">
			<?php	
				echo '<table cellspacing="3" cellpadding="0" border="0" width="705" align="center">';
					echo '<tr>';
					echo '<td id="titmen" colspan=4><center><b>Aqu&iacute; puede elegir su condolencia</b></center></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td id="titmen"><b>Nombre</b></td>';
					echo '<td id="texmen"><input type="text" name="autor" size="62"></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td id="titmen" valign="top"><b>Condolencia</b></td>';
					echo '<td id="texmen">';
					$sql= "SELECT * FROM flores";
					$res=mysql_query($sql);
					while($sep = mysql_fetch_array($res)){
					echo '<input type="radio" name="condol" checked="checked" value="'.$sep['Id'].'"><img src="images/flores'.$sep['Id'].'.png" width="95" height="95"><BR><BR>';
					}
					echo '</td>';
					echo '</tr>';
					echo '<input type=hidden name="idsep" value="'.$_GET[idsep].'">';
					echo '<tr>';
					echo '<td id="titmen" colspan="4"><center><input type="submit" name="enviar" value="Agregar ofrenda"></center></td>';
					echo '</tr>';
				echo '</table>';
				echo '<table cellspacing="0" cellpadding="8" border="0" width="705" bgcolor="#EBE5D5">';
					echo '<tr>';
						echo '<td id="alert"><br><div align="center"><b>'.$error.'</b><br></div></td>';
					echo '</tr>';
				echo '</table>';
				echo '</form>';
				

			?>
			
		</td>
	</tr>
</table>
</body>
</html>