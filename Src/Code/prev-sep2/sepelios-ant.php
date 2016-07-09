<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
	switch ($_GET['salsep']) {
     case '1':
         $salloc = "Corrientes"; break;
     case '2':
         $salloc = "Goya"; break;
    case '3':
         $salloc = "Bella Vista"; break;
    case '4':
         $salloc = "Ituzaingó"; break;
    case '5':
         $salloc = "Posadas"; break;
    case '7':
         $salloc = "Resistencia"; break;
    case '6':
         $salloc = "Formosa"; break;
	case '8':
		 $salloc= "Puerto Rico"; break;
	case '10':
	  	 $salloc= "Santo Tomé"; break;
	case '23':
	  	 $salloc= "Santa Lucía"; break;
	case '24':
	  	 $salloc= "Concepción"; break;
	default:
         $salloc = "Corrientes"; break;
	break;
	}
	?>  
    <title>SEPELIOS ANTERIORES - <?php echo $salloc; ?></title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<?php include('conexion.php'); 
function limpiarString($string) //función para limpiar strings, PARA DESPUES EVITAR EL PROBLEMA DE LA Ñ
		   {
			  $string = strip_tags($string);
			  $string = htmlentities($string);
			  return stripslashes($string);  
			// si llevaremos esto a mySQL deberímos agregar al final mysql_real_escape_string($string);
		   }

?>
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
$sql= "SELECT * FROM sepelio WHERE Localidad='".$_GET['salsep']."' AND Aprobado = 1 AND FechaSepelio < CURRENT_DATE() ORDER BY FechaSepelio DESC";
$contador=0;
$res=mysql_query($sql);


while($sep = mysql_fetch_array($res))
{
		//Controlo donde lo van a cremar o inhumar
		if ($contador == 2){ $contador = 0; }
		$salas= mysql_query("SELECT id, Direccion, Sala FROM salas WHERE id='".$sep['Salon']."'");
		$sala = mysql_fetch_array($salas);
		if ($sala['id']==20){
						$salas= mysql_query("SELECT id, OtroSalon as Sala, DomicilioOtroSalon as Direccion FROM sepelio WHERE id='".$sep['id']."'");
				$sala = mysql_fetch_array($salas);
			}
	
		
		$fondos= mysql_query("SELECT cod_fon, url_fon FROM fondos WHERE cod_fon='".$sep['Fondo']."'");
		$fondo = mysql_fetch_array($fondos);
		$opcion = $sep['opcion'];
		
		if ($opcion == 1) {
				if ($sep['LugarInhumacion'] == 5 OR $sep['LugarInhumacion'] == 13 OR $sep['LugarInhumacion'] == 14 OR $sep['LugarInhumacion'] == 15 OR $sep['LugarInhumacion'] == 16 OR $sep['LugarInhumacion'] == 17 OR $sep['LugarInhumacion'] == 18 OR $sep['LugarInhumacion'] == 19 OR $sep['LugarInhumacion'] == 23)  {
						$lugarfinal=$sep['Lugar'];}					
					else{

						$inhumaciones = mysql_query("SELECT Lugar FROM lugarinhumacion WHERE id='".$sep['LugarInhumacion']."'");
					$lugarfinal= mysql_fetch_array($inhumaciones);
					$lugarfinal=$lugarfinal['Lugar'];
						}
					
					}
		else{
			if ($sep['LugarCremacion'] == 2 OR $sep['LugarCremacion'] == 10 OR $sep['LugarCremacion'] == 11 OR $sep['LugarCremacion'] == 12 OR $sep['LugarCremacion'] == 13 OR $sep['LugarCremacion'] == 14 OR $sep['LugarCremacion'] == 15  OR $sep['LugarCremacion'] == 16 OR $sep['LugarCremacion'] == 17){
			$lugarfinal=$sep['Lugar'];	}
			else {						
			$cremaciones = mysql_query("SELECT Lugar FROM lugarcremacion WHERE id='".$sep['LugarCremacion']."'");
				$lugarfinal= mysql_fetch_array($cremaciones);
					$lugarfinal=$lugarfinal['Lugar'];}
			
		};
	//Fin control lugar inhumacion
	
	//CONTROL PALABRA CEMENTERIO O CREMATORIO

	if ($opcion == 1) 
	{
		//CONTROLO POR CEMENTERIO
		
		if (eregi('cementerio',$lugarfinal))
		{
			
		}
		else{
			$lugarfinal='Cementerio ' . $lugarfinal; 
		}
	}
	else
	{
		//CONTROLO POR Crematorio
		
		if (eregi('crematorio',$lugarfinal))
		{
			
		}
		else{
			$lugarfinal='Crematorio ' . $lugarfinal; 
		}
	}
	//
	
	//Controlo donde se va a hacer la misa
		$opcionmisa = $sep['LugarMisa'];
		$otrolugarmisa = $sep['OtroLugar'];
		if ($opcionmisa == 2 or $opcionmisa == 11 or $opcionmisa == 12 or $opcionmisa == 13 or $opcionmisa == 14 or $opcionmisa == 15 or $opcionmisa == 17 or $opcionmisa == 16 or $opcionmisa == 21) {
			$lugarmisa = $otrolugarmisa;
		}
		else{
			$iglesia = mysql_query("SELECT Nombre FROM iglesias WHERE id='".$sep['LugarMisa']."'");
			$lugarmisa= mysql_fetch_array($iglesia);
			$lugarmisa=$lugarmisa['Nombre'];
			};
		;
	//fin control misa
		
		

		$fecha = $sep['FechaSepelio'];
		preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$fecha,$partes);

		$fechamisa = $sep['Dia'];
		preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$fechamisa,$partesmisa);			
		$hora = $sep['Hora'];
		
		//Traigo la fecha de sepelio(inhumacion)
		$AnoFallecimientos = mysql_fetch_array(mysql_query("select Year(FechaSepelio) as fall,MONTH(FechaSepelio) as mfall, DAY(FechaSepelio) as dfall from sepelio WHERE id ='".$sep['id']."'"));
		$AnoInhumacion = $AnoFallecimientos['fall'];
		$MesInhumacion = $AnoFallecimientos['mfall'];
		$DiaInhumacion = $AnoFallecimientos['dfall'];

		//Resguardo año de nacimiento y fallecimiento
		$AnoNacimientos = mysql_fetch_array(mysql_query("select YEAR(FechaNacimiento) as nacim,MONTH(FechaNacimiento) as mnacim, DAY(FechaNacimiento) as dnacim from sepelio WHERE id ='".$sep['id']."'"));
		$AnoNacimiento = $AnoNacimientos['nacim'];
		$MesNacimiento = $AnoNacimientos['mnacim'];
		$DiaNacimiento = $AnoNacimientos['dnacim'];
		$AnoFallecimientos = mysql_fetch_array(mysql_query("select Year(FechaFallecimiento) as fall,MONTH(FechaFallecimiento) as mfall, DAY(FechaFallecimiento) as dfall from sepelio WHERE id ='".$sep['id']."'"));
		$AnoFallecimiento = $AnoFallecimientos['fall'];
		$MesFallecimiento = $AnoFallecimientos['mfall'];
		$DiaFallecimiento = $AnoFallecimientos['dfall'];

		
		//controlo si la foto no esta vacía
		if ($sep['Foto'] == '') {
			$sep['Foto'] ='/images/fotos/vacia.png';
			};
			
			//Controlo que sala no este vacía:
	if ($sala['Sala'] == '') {
			$sala['Sala'] ='';
			}else{
				$salacompleta=$sala['Sala'];
				
				if ($sep['Salon']==20)
				{
					$salacompleta= $salacompleta . " - ";
				}
				else
				{
					$salacompleta= "Salón: " . $salacompleta . " - ";
				}
				$sala['Sala'] =$salacompleta;
				};
				
		
				
		echo "
			<td align='left' width='352'>
			<table width='350' height='160' id='sep' background='fondos/".$fondo['url_fon']."'>
			<tr><td><center>
			<a href='detalle_sep.php?idsep=".$sep['id']."'> 
				<img src='http://www.cocheriadelparana.com.ar/home".$sep['Foto']."' alt='Ver Aviso' border='0' width='120'>
				<a>
				<a href='detalle_sep.php?idsep=".$sep['id']."'> 
				<a>	</center>
			</td></tr>
			</table>
			<table align='left' width='350' height='190'>
			<tr align='center'><td>	<img align='center' src='http://www.cocheriadelparana.com.ar/home/prev-sep2/images/religion/".$sep['Religion'].				".png' border='0' width='20' height = '30' ></td></tr>
			<tr><td><h2><a href='detalle_sep.php?idsep=".$sep['id']."'>	".ucwords(strtolower(limpiarString($sep['Nombre'])))."</a></h2></td></tr>
			<tr align='center'><td><strong>".$DiaNacimiento."/".$MesNacimiento."/".$AnoNacimiento." - ".$DiaFallecimiento."/".$MesFallecimiento."/".$AnoFallecimiento."</strong></td></tr>
			<tr><td>".ucwords(strtolower(limpiarString($sala['Sala'])))."Dirección:  ".ucwords(strtolower(limpiarString($sala['Direccion'])))."</td></tr>
			<tr><td>Homenaje de despedida: ".$DiaInhumacion."/".$MesInhumacion."/".$AnoInhumacion." - Hora: ".$hora."</td></tr>
			<tr><td>Destino Final: ".ucwords(strtolower(limpiarString($lugarfinal)))."</td></tr>";

		//oculto las misas que vengan con lugar vacio o hora 00:00 o año 1901
			if ($lugarmisa !='' AND $sep['HoraMisa'] != '00:00' AND $partesmisa[1] > 1910 )
			{
				echo"
				<tr><td>Misa: ".$partesmisa[3]."/".$partesmisa[2]."/".$partesmisa[1]." - Hora: ".$sep['HoraMisa']."</td></tr>
				<tr><td>Lugar de misa: ".ucwords(strtolower(limpiarString($lugarmisa)))."</td></tr>
				";
			}
			
			echo"
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