<?php
include('../conexion.php');
include('../generar_x.php');
include ("calendario/calendario.php");
include ("funcion_fechas.php");
$mensaje="";
$cod = $_GET['idsep'];
if ($_GET['act']==1){
	if($cod)
	{
			$sql = mysql_query("select * from sepelio WHERE cod_sep ='".$cod."'");
			$cant_reg= mysql_num_rows($sql);
			if($cant_reg==1)
			{
				$registro_sep = mysql_fetch_array($sql);
				
				$cod_sep = $registro_sep['cod_sep'];
				$nom_sep = $registro_sep['nom_sep'];
				$foto_sep = $registro_sep['foto_sep'];
				$sala_sep = $registro_sep['sala_sep'];
				$fecha_sep = $registro_sep['fecha_sep'];
				$fecha_fall_sep = $registro_sep['fecha_fall_sep'];
				$fecha_ent_sep = $registro_sep['fecha_ent_sep'];
				$lug_ent_sep = $registro_sep['lug_ent_sep'];
				$fondo_sep = $registro_sep['fondo_sep'];
				$oracion_sep = $registro_sep['oracion_sep'];
				$musica_sep = $registro_sep['musica_sep'];
				$ofrenda_sep = $registro_sep['ofrenda_sep'];
	
				preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha_sep,$partessep);		
				preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha_fall_sep,$partesfall);		
				preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha_ent_sep,$partesent);		
		
				$sql = mysql_query("select cod_sal, localidad_sal, prov_sal, sala from salas WHERE cod_sal='".$sala_sep."'");
				$registro_sala = mysql_fetch_array($sql);
		
				$sql = mysql_query("select cod_fon, tit_fon, url_fon from fondos WHERE cod_fon ='".$fondo_sep."'");
				$registro_fon= mysql_fetch_array($sql);
	
				$sql = mysql_query("select cod_ora, tit_ora, text_ora from oracion WHERE cod_ora ='".$oracion_sep."'");
				$registro_ora= mysql_fetch_array($sql);
	
				$sql = mysql_query("select cod_mus, tit_mus, url_mus,interp_mus from musica WHERE cod_mus ='".$musica_sep."'");
				$registro_mus= mysql_fetch_array($sql);
			}
	}
}
if($_POST['guardar_sep'])
{
		$mensaje="";
	if($_POST['nom_sep'] or $_POST['nom_sep'] or $_POST['lug_ent_sep'] or $_POST['salas'] or $_POST['fondo'] or $_POST['oracion'] or $_POST['musica'] or $_POST['fecha1'] or $_POST['fecha2'] or $_POST['fecha3']){
		
		if($_POST['nom_sep']){ 
			$instruccion = "UPDATE sepelio set nom_sep='".$_POST['nom_sep']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['lug_ent_sep']){ 
			$instruccion = "UPDATE sepelio set lug_ent_sep='".$_POST['lug_ent_sep']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['salas']){ 
			$instruccion = "UPDATE sepelio set sala_sep='".$_POST['salas']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['fondo']){ 
			$instruccion = "UPDATE sepelio set fondo_sep='".$_POST['fondo']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['oracion']){ 
			$instruccion = "UPDATE sepelio set oracion_sep='".$_POST['oracion']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['musica']){ 
			$instruccion = "UPDATE sepelio set musica_sep='".$_POST['musica']."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}
		
		if($_POST['fecha1']){ 
			$fecha1 = cambiaf_a_mysql($_POST[fecha1]);
			$instruccion = "UPDATE sepelio set fecha_sep='".$fecha1."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['fecha2']){ 
			$fecha2 = cambiaf_a_mysql($_POST[fecha2]);
			$instruccion = "UPDATE sepelio set fecha_fall_sep='".$fecha2."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}

		if($_POST['fecha3']){ 
			$fecha3 = cambiaf_a_mysql($_POST[fecha3]);
			$instruccion = "UPDATE sepelio set fecha_ent_sep='".$fecha3."' WHERE cod_sep='".$_POST['cod_sep']."'";
 			$consulta = mysql_query ($instruccion) or die ("NO se registro MODIFICACION(1) <br>");
		}
		


	// FIN ACTUALIZACION DE SEPELIO	
	}	
			if (is_uploaded_file($_FILES['foto_sep']['tmp_name']))
			{
				$sql = "select max(cod_sep) as M from sepelio";
				$res = mysql_query($sql);
				$row = mysql_fetch_array($res);
				$max = $row['M']; 
				//EXPLODE: para que separe la extension y pueda ser gif o jpg
				$extension = explode(".",$_FILES['foto_sep']['name']);
				$nombreDirectorio = "../fotos/"; 
				//para que no se repita la imagen con el mismo nombre
		
				$nombreFichero = "imagen".$max.".".$extension[1]; 
				move_uploaded_file ($_FILES['foto_sep']['tmp_name'],$nombreDirectorio .$nombreFichero)or die("Upload de IMG-1 incorrecto");
				mysql_query("UPDATE sepelio SET foto_sep = '$nombreFichero' WHERE cod_sep = '".$_POST['cod_sep']."'");
				
				$rutaimagen = $nombreDirectorio.$nombreFichero;
				$rutaDestino = "imagen".$_POST['cod_sep'].".".$extension[1];;
				$original = imagecreatefromjpeg($nombreDirectorio.$nombreFichero);
				$anchoThumb = 205;
				$altoThumb = 246;
				if ($original !== false){
				   $thumb = imagecreatetruecolor($anchoThumb,$altoThumb);
				   if ($thumb !== false){
					  $ancho = imagesx($original);
					  $alto = imagesy($original);
		
					  imagecopyresampled($thumb,$original,0,0,0,0,$anchoThumb,$altoThumb,$ancho,$alto);
					  imagejpeg($thumb,$nombreDirectorio.$rutaDestino,100);
				   }
				}
			}	

header('Location: bm_sepelio.php');
}

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
	 <h2>Modificar Sepelio<h2><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="5" cellspacing="5">
    <form action="" method="post" enctype="multipart/form-data" name="fcalen" id="fcalen">
      <input type="hidden" name="cod_sep" value="<?php  echo $cod_sep;?>">	
      <tr>
        <td width="100%" colspan="3" align="center"><span id="mens-alert"><?php  echo $mensaje; ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td width="120"><div align="right"><strong>Nombre:</strong></div></td>
        <td><input name="nom_sep" type="text" id="nom_sep" value="" size="50"><br /><span id="text-mod"><?php  echo $nom_sep;?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Foto:</strong></div></td>
        <td><img src="../fotos/<?php echo $foto_sep;?>" width="120" height="144" /><input name="foto_sep" type="file" id="foto_sep"><br />
        </td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Destino Final:</strong></div></td>
        <td><textarea name="lug_ent_sep" cols="40" rows="2" id="lug_ent_sep"></textarea><br /><span id="text-mod"><?php  echo $lug_ent_sep;?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Sala:</strong></div></td>
        <td><?php generasalas(); ?><br><span id="text-mod"><?php echo $registro_sala['prov_sal'] ?>-<?php echo $registro_sala['localidad_sal'] ?>-Sala: <?php echo $registro_sala['sala'] ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Fondo:</strong></div></td>
        <td><?php generafondos(); ?><br><span id="text-mod"><?php echo $registro_fon['tit_fon'] ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Oraci&oacute;n:</strong></div></td>
        <td><?php generaoracion(); ?><br><span id="text-mod"><?php echo $registro_ora['tit_ora']; ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>M&uacute;sica:</strong></div></td>
        <td><?php generamusica(); ?><br><span id="text-mod"><?php echo $registro_mus['tit_mus']; ?>-<?php echo $registro_mus['interp_mus']; ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Fecha de Sepelio:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha1","fcalen"); ?><br /><span id="text-mod"><?php echo $partessep[3] ?>/<?php echo $partessep[2] ?>/<?php echo $partessep[1] ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Fecha de Fallecimiento:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha2","fcalen"); ?><br /><span id="text-mod"><?php echo $partesfall[3] ?>/<?php echo $partesfall[2] ?>/<?php echo $partesfall[1] ?></span></td>
      </tr>
      <tr bgcolor='#FFFFFF'>
        <td><div align="right"><strong>Fecha de Entierro:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha3","fcalen"); ?><br /><span id="text-mod"><?php echo $partesent[3] ?>/<?php echo $partesent[2] ?>/<?php echo $partesent[1] ?></span></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><label>
          <input name="guardar_sep" type="submit" id="guardar_sep" value="Guardar Sepelio" class="boton" />
        </label></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    
    
    </form>
</body>
</html>