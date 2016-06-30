<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
	switch ($_GET['salsep']) {
     case 'Capital':
         $salloc = "Corrientes"; break;
     case 'goya':
         $salloc = "Goya"; break;
    case 'bella vista':
         $salloc = "Bella Vista"; break;
    case 'ituzaingo':
         $salloc = "Ituzaingó"; break;
    case 'posadas':
         $salloc = "Posadas"; break;
    case 'resistencia':
         $salloc = "Resistencia"; break;
    case 'formosa':
         $salloc = "Formosa"; break;
	default:
         $salloc = "Corrientes"; break;
	break;
	}
	?>  
    <title>SEPELIOS ANTERIORES - <?php echo $salloc; ?></title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<?php include('conexion.php'); ?>
<table width="705" align="center">
  <tr>
    <td>
	 <h1>Sepelios anteriores en <?php echo $salloc; ?></h1><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="1" cellspacing="1">
<tr>
<?php
$sql= "SELECT * FROM sepelio WHERE localidad_sala_sep='".$_GET['salsep']."' AND fecha_sep < CURRENT_DATE() ORDER BY fecha_sep DESC";
$contador=0;
$res=mysql_query($sql);
while($sep = mysql_fetch_array($res))
{
		if ($contador == 2){ $contador = 0; }
		$salas= mysql_query("SELECT cod_sal, direc_sal, sala FROM salas WHERE cod_sal='".$sep['sala_sep']."'");
		$sala = mysql_fetch_array($salas);
		
		$fondos= mysql_query("SELECT cod_fon, url_fon FROM fondos WHERE cod_fon='".$sep['fondo_sep']."'");
		$fondo = mysql_fetch_array($fondos);

		$fecha = $sep['fecha_sep']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);		
		
	
		echo "
			<td align='left' width='352'>
			<table width='350' height='160' id='sep' background='fondos/".$fondo['url_fon']."'>
			<tr><td><center>
				<a href='detalle_sep.php?idsep=".$sep['cod_sep']."'> 
				<img src='fotos/".$sep['foto_sep']."' alt='Ver Aviso' border='0' width='120'>
				<a>	</center>
			</td></tr>
			</table>
			<table align='left' width='350'>
			<tr><td><h2>".ucwords(strtolower($sep['nom_sep']))."</h2></td></tr>
			<tr><td>Sala: ".$sala['sala']." - Dirección:  ".$sala['direc_sal']."</td></tr>
			<tr><td>Fecha de Sepelio: ".$partes[3]."/".$partes[2]."/".$partes[1]."</td></tr>
			<tr><td>Destino Final: ".$sep['lug_ent_sep']."</td></tr>
			</table>
			</td>
		";
		$contador = $contador + 1;
		if ($contador == 2){
			echo "</tr>";
		}
}//CIERRO: while($sep = mysql_fetch_array($sql))
		echo "</tr>";

?>
</table>
<?php mysql_close();?>
</BODY>
</HTML>