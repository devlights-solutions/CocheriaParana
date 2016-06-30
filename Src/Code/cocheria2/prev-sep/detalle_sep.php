<?php
$cod = $_GET['idsep'];
$ofcont = $_GET['ofcont'];
if($cod)
{
	include('conexion.php');
	include('funciones.php');


		$sql = mysql_query("select * from sepelio WHERE cod_sep ='".$cod."'");
		$cant_reg= mysql_num_rows($sql);
		if($cant_reg==1)
		{
			$registro_sep = mysql_fetch_array($sql);
			
			$cod_sep = $registro_sep['cod_sep'];
			$nom_sep = $registro_sep['nom_sep'];
			$foto_sep = $registro_sep['foto_sep'];
			$sala_sep = $registro_sep['sala_sep'];
			$fecha_fall_sep = $registro_sep['fecha_fall_sep'];
			$fecha_ent_sep = $registro_sep['fecha_ent_sep'];
			$lug_ent_sep = $registro_sep['lug_ent_sep'];
			$fondo_sep = $registro_sep['fondo_sep'];
			$oracion_sep = $registro_sep['oracion_sep'];
			$musica_sep = $registro_sep['musica_sep'];
			$ofrenda_sep = $registro_sep['ofrenda_sep'];


			preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha_ent_sep,$partes);		

	
			$sql = mysql_query("select cod_sal, direc_sal, sala from salas WHERE cod_sal='".$sala_sep."'");
			$registro_sala = mysql_fetch_array($sql);
	
			$sql = mysql_query("select cod_fon, url_fon from fondos WHERE cod_fon ='".$fondo_sep."'");
			$registro_fon= mysql_fetch_array($sql);

			$sql = mysql_query("select cod_ora, text_ora from oracion WHERE cod_ora ='".$oracion_sep."'");
			$registro_ora= mysql_fetch_array($sql);

			$sql = mysql_query("select cod_mus, tit_mus, url_mus from musica WHERE cod_mus ='".$musica_sep."'");
			$registro_mus= mysql_fetch_array($sql);
			
		}
	if($ofcont){// contador de ofrendas
		$ofrenda_sep = $registro_sep['ofrenda_sep']+1;
		$consulta = mysql_query ("UPDATE sepelio set ofrenda_sep='".$ofrenda_sep."' WHERE cod_sep='".$cod."'") or die ($error_sql=1);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>SEPELIOS DEL D√çA - CORRIENTES</title>
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
	 <h1>Sepelios en Corrientes - <?php echo $registro_sep['nom_sep'] ?></h1><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
        <table width="400" height='190' background='fondos/<?php echo $registro_fon['url_fon'] ?>'>
        <tr><td><center>
        <img src='fotos/<?php echo $registro_sep['foto_sep'] ?>' alt='Sin Foto' border='0' width='120'>
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
          <li><a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);var dir2= encodeURIComponent(dir);window.location.href=('http://www.facebook.com/share.php?u='+dir2+'&amp;t='+tit2+'');" target="_blank">Compartir en Facebook</a>
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
	<tr><td><h2><?php echo ucwords(strtolower($registro_sep['nom_sep'])) ?></h2></td></tr>
	<tr><td>Sala: <?php echo $registro_sala['sala'] ?> - Direcci&oacute;n:  <?php echo $registro_sala['direc_sal'] ?></td></tr>
	<tr><td>Fecha de Entierro: <?php echo $partes[3] ?>/<?php echo $partes[2] ?>/<?php echo $partes[1] ?></td></tr>
	<!-- <tr><td>Hora de Entierro: <?php echo $partes[4] ?>:<?php echo $partes[5] ?></td></tr>-->
	<tr><td>Sus restos descansar·n en: <?php echo $registro_sep['lug_ent_sep'] ?></td></tr>
</table>
<table width="705" align="center">
	<tr><td>
	<div id="oracion"><?php echo $registro_ora['text_ora'] ?></div>
    </td></tr>
</table>
<table width="705" align="center">
	<tr><td align="center">
	<?php 
	if ($registro_sep['ofrenda_sep']<> 0){ 
		$contador = 0;
		do {
			$flor = rand(1,14);
			echo "<img src='images/flores".$flor.".png' alt='Ofrenda Floral' border='0' width='120' height='120'>"; 
			$contador = $contador + 1;
			if ($contador == 9){
				echo "</td></tr><tr><td>";
			}
		} while ($contador<$registro_sep['ofrenda_sep']);
	}
	?>
    </td></tr>
</table>
<?php 	include('comentarios.php'); ?>
</body>
</html>