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
					if ($_POST[Mensaje])	{
						$sql = "select max(id) as M from aggradecimiento";
						$res = mysql_query($sql);
						$row = mysql_fetch_array($res);
									
						if ($row['M'] >0)	$max = $row['M'] +1;
						else 	$max=1;
									
						$fecha =date("y-m-d H:i:s");
							
						$sql = "insert into aggradecimiento(id, date_time, Nombre, Destinatario, Mensaje, Estado) values('".$max."','".$fecha."', '".$_POST[Nombre]."', '".$menu."', '".$_POST[Mensaje]."',1)";
						$resagre = mysql_query($sql);
			//envio el mail
			mail("santiacevedo@gmail.com, analia.barboza@previsoradelparana.com","Nuevo agradecimiento","Se ha agregado el comentario número: ".$max.".\r\nA nombre de: ".$_POST[Nombre].". \r\nEl texto del agradecimiento es: ".$_POST[Mensaje].".\r\n \r\nEl mismo esta pendiente de aprobación en la sección libro del panel de administración de Previsora del Parana, para ingresar haga click en el siguiente enlace http://www.cocheriadelparana.com.ar/home/index.php/agradecimientos-cocheria","From: Panel de administración Previsora del Parana<santiacevedo@gmail.com>");
						header('Location: agradecimientos.php');
						
						}else{
						$error = 'Se ha producido un error';
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
    <title>Agradecimientos</title>
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
  <script src="bootstrapjs/bootstrap.min.js"></script>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>

<div class="container-fluid" align="center" style="background-color:#F4F2E5">
<!--<table align="center" width="705" cellpadding="0" cellspacing="0" bgcolor="#F4F2E5"> -->
	<!--<tr>
		<td valign="top"> -->
        <div class="row col-sm-12">
				<form method="post" action="" enctype="multipart/form-data">
			<?php	
				
				echo '<div class="container-fluid" align="center">';
					echo '<div class="row col-sm-12">';
						  echo '<div id="titmen" colspan=4>
									<center><b>Aqu&iacute; puede escribir su agradecimiento</b></center>
								</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="container-fluid" align="left">';
					echo '<div class="row col-sm-12">';
						echo '<div class="col-sm-2" id="titmen"><b>De:</b></div>';
						echo '<div class="col-sm-9" id="texmen"><input type="text" name="Nombre" ></div>';
					echo '</div>';
					echo '<div class="col-sm-2" id="titmen"><b>Para:</b></div>';
					$query="SELECT * FROM localidad WHERE id = 2 OR id = 3 OR id =4 OR id = 5 OR id = 6 OR id = 7 OR id = 8 OR id = 10 OR id = 11 OR id = 24 OR id = 23 ORDER BY Nombre"; 
					$r = mysql_query($query);
					$menu="<select name='menu'><option selected>Sucursal:</option>"; 
					while($registro=mysql_fetch_array($r)) 
					{ 
						$menu.="\n<option value='".$registro[0]."'>Sucursal ".$registro[2]."</option>"; 
					} 
					$menu.="\n</select>"; 
					echo '<div class="col-sm-9">'.$menu.'</div>';
					//echo '<td id="texmen"><input type="text" name="Destinatario" size="62"></td>';
				//echo '</div>';
				echo '<div class="row col-sm-12" >';
					echo '<div class="col-sm-2" id="titmen" valign="top"><b>Mensaje:</b></div>';
					echo '<div class="col-sm-9" id="texmen"><textarea name="Mensaje" rows="6" cols="40"></textarea></div>';
				echo '</div>';
					//echo '<input type=hidden name="idsep" value="'.$_GET[idsep].'">';
				echo '<div class="row col-sm-12">';
					echo '<div id="titmen" colspan="4"><center><input type="submit" name="enviar" value="Agregar agradecimiento"></center></div>';
				echo '</div>';
			echo '</div>';
				echo '<table class="table" cellspacing="0" cellpadding="8" border="0" style="background-color: #EBE5D5">';
					echo '<tr>';
						echo '<td><div align="justify"><b id="aclamen">Aclaraci&oacute;n:</b><br>Su agradecimiento ser&aacute; aprobado por un moderador a la brevedad. Muchas Gracias</div></td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td id="alert"><br><div align="center"><b>'.$error.'</b><br></div></td>';
					echo '</tr>';
				echo '</div>';
				echo '</form>';

			?>
	</div>		
<!--		</td>
	</tr> -->
	
<!--</table> -->
</div>
</body>
</html>