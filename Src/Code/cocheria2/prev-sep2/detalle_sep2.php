<?php
$cod = $_GET['idsep'];
$ofcont = $_GET['ofcont'];
if($cod)
{
	include('conexion.php');
	include('funciones.php');



		$sql = mysql_query("select * from sepelio WHERE id ='".$cod."'");

		//Resguardo año de nacimiento y fallecimiento
		$AnoNacimientos = mysql_fetch_array(mysql_query("select YEAR(FechaNacimiento) as nacim,MONTH(FechaNacimiento) as mnacim, DAY(FechaNacimiento) as dnacim from sepelio WHERE id ='".$cod."'"));
		$AnoNacimiento = $AnoNacimientos['nacim'];
		$MesNacimiento = $AnoNacimientos['mnacim'];
		$DiaNacimiento = $AnoNacimientos['dnacim'];
		$AnoFallecimientos = mysql_fetch_array(mysql_query("select Year(FechaFallecimiento) as fall,MONTH(FechaFallecimiento) as mfall, DAY(FechaFallecimiento) as dfall from sepelio WHERE id ='".$cod."'"));
		$AnoFallecimiento = $AnoFallecimientos['fall'];
		$MesFallecimiento = $AnoFallecimientos['mfall'];
		$DiaFallecimiento = $AnoFallecimientos['dfall'];

		$cant_reg= mysql_num_rows($sql);
		if($cant_reg==1)
		{
			
			$registro_sep = mysql_fetch_array($sql);
			
			$cod_sep = $registro_sep['id'];
			$nom_sep = $registro_sep['Nombre'];
			//controlo si la foto no esta vacía
			if ($registro_sep['Foto'] == '') {
			$foto_sep ='/images/fotos/vacia.png';
			
			}else{$foto_sep = $registro_sep['Foto'];}			;
			
			$sala_sep = $registro_sep['Salon'];
			$fecha_fall_sep = $registro_sep['FechaFallecimiento'];
			$fecha_ent_sep = $registro_sep['FechaSepelio'];
			$lug_ent_sep = $registro_sep['Lugar'];
			$fondo_sep = $registro_sep['Fondo'];
			
			$oracion_sep = $registro_sep['Oracion'];
			$musica_sep = $registro_sep['Musica'];
			$ofrenda_sep = $registro_sep['Ofrendas'];
			$opcion = $registro_sep['opcion'];
			$Religion = $registro_sep['Religion'];
			$HoraMisa =$registro_sep['HoraMisa'];
			$FechaMisa = $registro_sep['Dia'];
			$opcionmisa = $registro_sep['LugarMisa'];
			$otrolugarmisa = $registro_sep['OtroLugar'];
			
			//COntrolo donde lo van a inhumar o cremar
			if ($opcion == 1) {
				if ($registro_sep['LugarInhumacion'] == 5 OR $registro_sep['LugarInhumacion'] == 13 OR $registro_sep['LugarInhumacion'] == 14 OR $registro_sep['LugarInhumacion'] == 15 OR $registro_sep['LugarInhumacion'] == 16 OR $registro_sep['LugarInhumacion'] == 17 OR $registro_sep['LugarInhumacion'] == 18 OR $registro_sep['LugarInhumacion'] == 19)  {
						$lugarfinal=$registro_sep['Lugar'];}					
					else{

						$inhumaciones = mysql_query("SELECT Lugar FROM lugarinhumacion WHERE id='".$registro_sep['LugarInhumacion']."'");
					$lugarfinal= mysql_fetch_array($inhumaciones);
					$lugarfinal=$lugarfinal['Lugar'];
						}
					
					}
		else{
			if ($registro_sep['LugarCremacion'] == 2 OR $registro_sep['LugarCremacion'] == 10 OR $registro_sep['LugarCremacion'] == 11 OR $registro_sep['LugarCremacion'] == 12 OR $registro_sep['LugarCremacion'] == 13 OR $registro_sep['LugarCremacion'] == 14 OR $registro_sep['LugarCremacion'] == 15  OR $registro_sep['LugarCremacion'] == 16){
			$lugarfinal=$registro_sep['Lugar'];	}
			else {						
			$cremaciones = mysql_query("SELECT Lugar FROM lugarcremacion WHERE id='".$registro_sep['LugarCremacion']."'");
				$lugarfinal= mysql_fetch_array($cremaciones);
					$lugarfinal=$lugarfinal['Lugar'];}
			
		};

	//Controlo donde se va a hacer la misa
		//$opcionmisa = $sep['LugarMisa'];
		//$otrolugarmisa = $sep['OtroLugar'];
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
			preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha_ent_sep,$partes);
			preg_match('/(\d{4})-(\d{2})-(\d{2})/',$FechaMisa,$partesmisa);			

	
			$sql = mysql_query("select id, Direccion, Sala from salas WHERE id='".$sala_sep."'");
			$registro_sala = mysql_fetch_array($sql);
			//Controlo que la sala no sea "OTRA"!!!
			if ($registro_sala['id']==20){
						$salas= mysql_query("SELECT id, OtroSalon as Sala, DomicilioOtroSalon as Direccion FROM sepelio WHERE id='".$cod."'");
				$registro_sala = mysql_fetch_array($salas);
			}
			
	
			$sql = mysql_query("select cod_fon, url_fon from fondos WHERE cod_fon ='".$fondo_sep."'");
			$registro_fon= mysql_fetch_array($sql);

			$sql = mysql_query("select id, Texto from oracion WHERE id ='".$oracion_sep."'");
			$registro_ora= mysql_fetch_array($sql);

			$sql = mysql_query("select cod_mus, tit_mus, url_mus from musica WHERE cod_mus ='".$musica_sep."'");
			$registro_mus= mysql_fetch_array($sql);
			
		}
	if($ofcont){// contador de ofrendas
		$ofrenda_sep = $registro_sep['Ofrendas']+1;
		$consulta = mysql_query ("UPDATE sepelio set Ofrendas='".$ofrenda_sep."' WHERE id='".$cod."'") or die ($error_sql=1);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta property="og:title" content="Sepelio Compartido en Facebook"/>
    <meta property="og:description" content="Descripcion sepelio compartido"/>
    <title>SEPELIOS DEL DIA</title>
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="mp3-player-button.css" />
    <script type="text/javascript" src="script/soundmanager2.js"></script>
    <script type="text/javascript" src="script/mp3-player-button.js"></script>
    <script>
    soundManager.setup({
      // required: path to directory containing SM2 SWF files
      url: 'swf/'
    });
    
    </script>

</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h1>Sepelio - <?php echo $registro_sep['Nombre'] ?></h1><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
        <table width="400" height='190' background='fondos/<?php echo $registro_fon['url_fon'] ?>'>
        <tr><td><center>
        <img src='/home<?php echo $foto_sep ?>' border='0' width='120'>
        </center>
        </td></tr>
       	</table>
	</td>
	<td>
        <table width="305" height='190' bgcolor="#DDD2A3" cellpadding="0" cellspacing="0">
        <tr><td>
        <div id="menu">
         <ul>
          <li><a href="detalle_sep.php?idsep=<?php echo $cod ?>&ofcont=1">Dejar Ofrenda Floral</a></li>
          <li><a href="comentarios_r.php?idsep=<?php echo $cod ?>">Escribir Condolencia</a></li>
          <li><a href="condolencias_r.php?idsep=<?php echo $cod ?>">Seleccionar una oraci&oacute;n de despedida</a></li>
          <li><a href="#" 
  onclick="
    window.open(
      'http://www.facebook.com/sharer.php?s=100&p[url]=http://www.cocheriadelparana.com.ar/home/index.php/sepelio-cocheria-del-parana?idsep=<?php echo $cod?>&p[title]=Sepelio Cocheria del Parana - <?php echo $nom_sep?>&p[summary]=Sala: <?php echo $registro_sala['Sala'] ?> - Direccion:  <?php echo $registro_sala['Direccion'] ?> Fecha de Inhumación: <?php echo $partes[3] ?>/<?php echo $partes[2] ?>/<?php echo $partes[1] ?> - Sus restos descansaran en:<?php echo $lugarfinal?>&&p[images][0]=http://www.cocheriadelparana.com.ar/home/templates/ah-68-flexi/images/logo.png',
      'facebook-share-dialog',
      
      'width=626,height=436'); 
      
    return false;">
  Compartir Facebook
</a>
</li>
         
         
          <li><a href="mp3_files/<?php echo $registro_mus['url_mus'] ?>" class="sm2_button"></a></li>
         </ul>
        </div>
        </td></tr>
       	</table>
	</td>
</tr>
</table>
<table width="705" align="center">
	<tr align="center"><td>	<img align="center" src="http://www.cocheriadelparana.com.ar/home/prev-sep2/images/religion/<?php echo $Religion ?>.png" border="0" width="20" height = "30" ></td></tr>
	<tr><td><h2><?php echo ucwords(strtolower($registro_sep['Nombre'])) ?></h2></td></tr>
    <tr><td><h2><?php echo ($DiaNacimiento)?>/<?php echo ($MesNacimiento)?>/<?php echo ($AnoNacimiento)?>  -  <?php echo($DiaFallecimiento) ?>/<?php echo($MesFallecimiento) ?>/<?php echo($AnoFallecimiento) ?></h2></td></tr>
	<tr><td>Sala: <?php echo $registro_sala['Sala'] ?> - Direcci&oacute;n:  <?php echo $registro_sala['Direccion'] ?></td></tr>
	<tr><td>Fecha de Inhumación: <?php echo $partes[3] ?>/<?php echo $partes[2] ?>/<?php echo $partes[1] ?></td></tr>
	<!-- <tr><td>Hora de Entierro: <?php echo $partes[4] ?>:<?php echo $partes[5] ?></td></tr>-->
	<tr><td>Sus restos descansarán en: <?php echo $lugarfinal ?></td></tr>
	<tr><td><?php if($lugarmisa !=''){echo 'Misa: ';
			echo $partesmisa[3];
			echo '/';
			echo $partesmisa[2];
			echo '/';
			echo $partesmisa[1];
			echo ' - ';
			echo $HoraMisa;
			echo ' hs';
			}?></td></tr>
    <tr><td><?php if($lugarmisa !=''){
		echo 'Lugar de misa :';
		echo $lugarmisa;
		}?></td></tr>

    
</table>
<table width="705" align="center">
	<tr><td>
	<div id="oracion"><?php echo $registro_ora['Texto'] ?></div>
    </td></tr>
</table>
<table width="705" align="center">
	<tr><td align="center">
	<?php 
	if ($registro_sep['Ofrendas']<> 0){ 
		$contador = 0;
		do {
			$flor = rand(1,14);
			echo "<img src='images/flores".$flor.".png' alt='Ofrenda Floral' border='0' width='120' height='120'>"; 
			$contador = $contador + 1;
			if ($contador == 9){
				echo "</td></tr><tr><td>";
			}
		} while ($contador<$registro_sep['Ofrendas']);
	}
	?>
    </td></tr>
</table>
<?php 	include('comentarios.php'); ?>
</body>
</html>