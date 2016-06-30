<table width="705" align="center" id="mensaj">
	<tr>
		<td valign="top">
		<table width="100%">
		  <tr>
			<td valign="top">
			<table cellpadding="2" cellspacing="0">
			<?php
							
				if ($_GET[pg]==""){
				$_GET[pg] = 0; // $pg es la pagina actual
				}
				$cantidad=2; // cantidad de resultados por página
				$inicial = $_GET[pg] * $cantidad;
				
				$pegar = "SELECT * FROM libro WHERE sep_l='".$_GET[idsep]."' ORDER BY fecha_l desc LIMIT $inicial,$cantidad";
				$cad = mysql_query($pegar) or die (mysql_error());
				
				$contar = "SELECT * FROM libro WHERE sep_l='".$_GET[idsep]."' ORDER BY fecha_l desc"; 
				$contarok= mysql_query($contar);
				$total_records = mysql_num_rows($contarok);
				$pages = intval($total_records / $cantidad);
			
				echo '<tr>';
				echo '	<form action="" method="GET">';
				echo '	<td width="100%" bgcolor="#719AB8"><div align="center" >';
				if ($error){
					echo '<font id="titmen">'.$error.'</font>';
				}elseif($resagre){
					echo '<font id="titmen">Su mensaje se ha agregado al libro</font>';
				}

				echo '</div></td>';
				echo '	</form>';
				echo '</tr>';
				//navegador
					echo '<table cellspacing="0" cellpadding="2" border="0" aling="center" width="100%" bgcolor="#ffffff">';
					echo '<tr>';
					echo ' 		<td bgcolor="#C8CDAD"><center>';
					if ($_GET[pg] <> 0)
					{
					$url = $_GET[pg] - 1;
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$url."' style='text-decoration:none; color:white'>« Anterior</a> ";
					}
					else {
					echo " ";
					}
					
					for ($i = 0; $i<($pages + 1); $i++) {
					if ($i == $_GET[pg]) {
					echo "<font face=Arial size=3 color=ff0000><b> $i </b></font>";
					}
					else {
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$i."' style='text-decoration:none; color:white'>".$i."</a> ";
					}
					}
					
					if ($_GET[pg]< $pages) {
					$url = $_GET[pg] + 1;
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$url."' style='text-decoration:none; color:white'>Siguiente »</a>";
					}
					else {
					echo " ";
					}
					echo '</center></td>';
					echo '</table>';
				
				//mostrar mensajes 
					$ames[1]= 'Enero';
					$ames[]= 'Febrero';
					$ames[]= 'Marzo';
					$ames[]= 'Abril';
					$ames[]= 'Mayo';
					$ames[]= 'Junio';
					$ames[]= 'Julio';
					$ames[]= 'Agosto';
					$ames[]= 'Septiembre';
					$ames[]= 'Octubre';
					$ames[]= 'Noviembre';
					$ames[]= 'Diciembre';
					while ($row = mysql_fetch_array($cad)) {//mensajes mostrados
						
						$fechai = explode(" ",$row[fecha_l]);
						$fecha = explode("-",$fechai[0]);
						$dia = $fecha[2];
						$mes = $ames [abs($fecha[1])];
						$año = $fecha[0];
						$fecha = "$dia de $mes de $año";
						echo '<table cellspacing="0" cellpadding="0" aling="center" width="100%">';
						echo '<tr>';
						echo ' 		<td id="nombre-men"> &nbsp; Mensaje de '.$row['nombre_l'].':</td>';
						echo '</tr>';
						
						echo '<tr>';
						echo ' 		<td bgcolor="#E5DCB6" id="text-men">&nbsp;'.nl2br($row[text_l]).'<br><div align="right"><font id="fechapri">'.$fecha.'</font></div></td>';
						echo '</tr>';
						
						echo '</table>';
					}
					echo '<table cellspacing="0" cellpadding="2" border="0" aling="center" width="100%" bgcolor="#ffffff">';
					echo '<tr>';
					echo ' 		<td bgcolor="#C8CDAD"><center>';
					if ($_GET[pg] <> 0)
					{
					$url = $_GET[pg] - 1;
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$url."' style='text-decoration:none; color:white'>« Anterior</a> ";
					}
					else {
					echo " ";
					}
					
					for ($i = 0; $i<($pages + 1); $i++) {
					if ($i == $_GET[pg]) {
					echo "<font face=Arial size=3 color=ff0000><b> $i </b></font>";
					}
					else {
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$i."' style='text-decoration:none; color:white'>".$i."</a> ";
					}
					}
					
					if ($_GET[pg] < $pages) {
					$url = $_GET[pg] + 1;
					echo "<a href='detalle_sep.php?idsep=".$_GET['idsep']."&pg=".$url."' style='text-decoration:none; color:white'>Siguiente »</a>";
					}
					else {
					echo " ";
					}
					echo '</center></td>';
					echo '</table>';
		
			?>
		</table>
		</td>
		</tr>
</table>