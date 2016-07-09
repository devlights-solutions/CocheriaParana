<?php
include('conexion.php');
	if ($_POST[enviar]){//AGREGA UN NUEVO MENSAJE
			//CONTROL DE IP
			if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip=$_SERVER['HTTP_CLIENT_IP'];
			} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip=$_SERVER['REMOTE_ADDR'];
			}
			//$sql = mysql_query("SELECT * FROM libro WHERE ip_l='".$ip."'");
			//if(mysql_num_rows($sql)==0) {
					if ($_POST[contenido] or $_POST[condol_predeterminada])	{
						$sql = "select max(id) as M from libro";
						$res = mysql_query($sql);
						$row = mysql_fetch_array($res);
									
						if ($row['M'] >0)	$max = $row['M'] +1;
						else 	$max=1;
									
						$fecha =date("y-m-d H:i:s");
						if ($_POST[condol_predeterminada] <> "")
							{
							$contenido = $_POST[condol_predeterminada];
							}
						else
						{
							$contenido = $_POST[contenido];
						}
							
						$sql = "insert into libro(id, sep_l, nombre_l, ip_l, text_l, fecha_l,aprobacion) values('".$max."', '".$_POST[idsep]."', '".$_POST[autor]."', '".$ip."','$contenido' ,'".$fecha."',1)";
						$resagre = mysql_query($sql);
			//envio el mail
			mail("santiacevedo@gmail.com, rocio.soto@previsoradelparana.com","Nueva condolencia","Se ha agregado la condolencia número: ".$max.".\r\nA nombre de: ".$_POST[autor].". \r\nEl texto de la condolencia es: ".$_POST[contenido].".\r\n \r\nLa misma esta pendiente de aprobación en la sección libro del panel de administración de Previsora del Parana","From: Panel de administración Previsora del Parana<rocio.soto@previsoradelparana.com>");
						header('Location: detalle_sep.php?idsep='.$_POST[idsep].'');
					}else{
						$error = 'Por favor complete el formulario del Libro de Visitas';
					}			
				//} else {
				//$error = "Ya ha enviado una condolencia, intente de nuevo más tarde";
			//}
			// FIN CONTROL DE IP
			

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
					echo '<td id="titmen" colspan=4><center><b>Aqu&iacute; puede escribir su condolencia</b></center></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td id="titmen"><b>Nombre</b></td>';
					echo '<td id="texmen"><input type="text" name="autor" size="62"></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td id="titmen" valign="top"><b>Condolencia</b></td>';
					echo '<td id="texmen"><textarea name="contenido" rows="6" cols="46"></textarea></td>';
					echo '</tr>';
										echo '</br>';					echo '</br>';
					echo '</br>';
					//aca van las condolencias
					echo '<tr>';
					echo '<td id="titmen" valign="top"><b>Condolencia</b></td>';
					echo '<td id="texmen">';
					$sql= "SELECT * FROM condolencias";
					$res=mysql_query($sql);
					while($sep = mysql_fetch_array($res)){
					echo '<input type="radio" name="condol_predeterminada" value="'.$sep['Titulo'].'">'.$sep['Titulo'].'<BR><BR>';
					}
					echo '</td>';
					echo '</tr>';
					//fin condolencias
					
					echo '<input type=hidden name="idsep" value="'.$_GET[idsep].'">';
					echo '<tr>';
					echo '<td id="titmen" colspan="4"><center><input type="submit" name="enviar" value="Agregar condolencia"></center></td>';
					echo '</tr>';
				echo '</table>';
				echo '<table cellspacing="0" cellpadding="8" border="0" width="705" bgcolor="#EBE5D5">';
					echo '<tr>';
						echo '<td><div align="justify"><b id="aclamen">Aclaraci&oacute;n:</b><br>Su condolencia ser&aacute; aprobada por un moderador a la brevedad. Muchas Gracias</div></td>';
					echo '</tr>';
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