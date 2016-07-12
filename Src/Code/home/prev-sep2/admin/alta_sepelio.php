<?php 
include('../conexion.php'); 
include ("calendario/calendario.php");
include ("funcion_fechas.php");

if($_POST['guardar_sep'])
{
		$mensaje="";
		if (trim($_POST['nom_sep']) == ""){ $mensaje.="Complete el NOMBRE<br>"; }
		//if (trim($_POST['foto_sep']) == ""){ $mensaje.="Seleccione una imagen<br>";}
		if (trim($_POST['lug_ent_sep']) == ""){	$mensaje.="Escriba el lugar de entierro<br>";	}
		if (trim($_POST['salas']) == "0"){ $mensaje.="Seleccione una sala<br>";}
		if (trim($_POST['fondos']) == "0"){ $mensaje.="Seleccione un fondo <br>"; }
		if (trim($_POST['oracion']) == "0"){ $mensaje.="Seleccione una oraci&oacute;n <br>";}
		if (trim($_POST['musica']) == "0"){	$mensaje.="Seleccione una canci&oacute;n<br>";	}
		if (trim($_POST['fecha1']) == ""){ $mensaje.="Seleccione la fecha del Sepelio<br>";}
		if (trim($_POST['fecha2']) == ""){ $mensaje.="Seleccione la fecha de Fallecimiento<br>"; }
		if (trim($_POST['fecha3']) == ""){ $mensaje.="Seleccione la fecha de Entierro<br>";}

		//verifico que levante solo archivos de imagenes en el CAMPO FOTO:
		if (is_uploaded_file($_FILES['foto_sep']['tmp_name']))
		{
			$tipo_archivo = $_FILES['foto_sep']['type']; 
			if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "tiff") || strpos($tipo_archivo, "bmp") || strpos($tipo_archivo, "jpg")))) 
			{ 
				$mensaje.="Solo se aceptan im&aacute;genes de tipo: GIF-JPEG-JPG-PNG-TIFF-BMP como FOTO<br>";
			}
		}
if (!$mensaje){
	$fecha1 = cambiaf_a_mysql($_POST[fecha1]);
	$fecha2 = cambiaf_a_mysql($_POST[fecha2]);
	$fecha3 = cambiaf_a_mysql($_POST[fecha3]);

//$result = 
//mysql_query("SELECT * FROM `tbl-user` WHERE `username` = '" . $username ."'") or die ("Error: " . mysql_error()); 

$consullocalidad =  mysql_query("SELECT localidad_sal FROM `salas` WHERE `cod_sal` = '". $salas ."' limit 1");
$row=mysql_fetch_row($consullocalidad);
$localidad= $row[0];
	$instruccion = "insert into sepelio(cod_sep, nom_sep , fecha_sep, fecha_fall_sep, fecha_ent_sep, lug_ent_sep, sala_sep,localidad_sala_sep, fondo_sep, oracion_sep, musica_sep, ofrenda_sep,hora_sep) values ('','$_POST[nom_sep]', '$fecha1', '$fecha2', '$fecha3', '$_POST[lug_ent_sep]', '$_POST[salas]', '$localidad', '$_POST[fondos]', '$_POST[oracion]', '$_POST[musica]', '1','$_POST[hora_sep]')";
 	$consulta = mysql_query ($instruccion) or die ($mensaje="Fallo en la consulta(alta1)");
	$_POST['nom_sep'] = "";
	$_POST['foto_sep'] = "";
	$_POST['lug_ent_sep'] = "";
	$_POST['fecha1'] = "";
	$_POST['fecha2'] = "";
	$_POST['fecha3'] = "";
	
	$sql = "select max(cod_sep) as M from sepelio";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$max = $row['M']; 
	if (is_uploaded_file($_FILES['foto_sep']['tmp_name']))
	{
		//EXPLODE: para que separe la extension y pueda ser gif o jpg
		$extension = explode(".",$_FILES['foto_sep']['name']);
		$nombreDirectorio = "../fotos/"; 
		//para que no se repita la imagen con el mismo nombre

		$nombreFichero = "imagen".$max.".".$extension[1]; 
		move_uploaded_file ($_FILES['foto_sep']['tmp_name'],$nombreDirectorio .$nombreFichero)or die("Upload de IMG-1 incorrecto");
		mysql_query("UPDATE sepelio SET foto_sep = '$nombreFichero' WHERE cod_sep = '$max'");
    	
		$rutaimagen = $nombreDirectorio.$nombreFichero;
		$rutaDestino = "imagen".$max.".".$extension[1];;
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
	$mensaje = "Sepelio agregado con éxito";
} 


}
// FIN IF DE CONSULTA DE FORM

//VERIFICO SI TENGO MENSAJES DE ERROR:

// LISTAS DESPLEGABLES
function generasalas()
{
	$consulta_sala=mysql_query("select * from salas ORDER BY prov_sal, localidad_sal, sala");

	echo "<select name='salas' id='salas' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige una Sala Velatoria</option>";
	while($registro=mysql_fetch_row($consulta_sala))
	{
		echo "<option value='".$registro[0]."'>".$registro[2]."-".$registro[1]."-".$registro[4]."</option>";
	}
	echo "</select>";
}

function generafondos()
{
	$consulta_fon = mysql_query("select * from fondos ORDER BY tit_fon");

	echo "<select name='fondos' id='fondos' onChange='cargaContenido_cat(this.id)'>";
	echo "<option value='0'>Elige un fondo</option>";
	while($registro_cat=mysql_fetch_row($consulta_fon))
	{
		echo "<option value='".$registro_cat[0]."'>".$registro_cat[1]."</option>";
	}
	echo "</select>";
}

function generaoracion()
{
	$consulta_ora = mysql_query("select * from oracion ORDER BY tit_ora");

	echo "<select name='oracion' id='' onChange='cargaContenido_cat(this.id)'>";
	echo "<option value='0'>Elige una oraci&oacute;n</option>";
	while($registro_ora=mysql_fetch_row($consulta_ora))
	{
		echo "<option value='".$registro_ora[0]."'>".$registro_ora[1]."</option>";
	}
	echo "</select>";
}
function generamusica()
{
	$consulta_mus = mysql_query("select * from musica ORDER BY interp_mus, tit_mus");

	echo "<select name='musica' id='' onChange='cargaContenido_cat(this.id)'>";
	echo "<option value='0'>Elige una canci&oacute;n</option>";
	while($registro_mus=mysql_fetch_row($consulta_mus))
	{
		echo "<option value='".$registro_mus[0]."'>".$registro_mus[2]."-".$registro_mus[1]."</option>";
	}
	echo "</select>";
}
// FIN LISTAS DESPLEGABLES

 
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
	 <h2>Agregar Sepelio<h2><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
    <form action="" method="post" enctype="multipart/form-data" name="fcalen" id="fcalen">
      <tr>
        <td width="100%" colspan="2" align="center"><span class="mens-alert"><?php  echo $mensaje; ?></span></td>
      </tr>
      <tr>
        <td width="150"><div align="right"><strong>Nombre:</strong></div></td>
        <td><label>
          <input name="nom_sep" type="text" id="nom_sep" value="<?php  echo $_POST['nom_sep'];?>" size="50">
        </label></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Foto:</strong></div></td>
        <td><label>
          <input name="foto_sep" type="file" id="foto_sep" value= <?php echo $_POST['foto_sep']?>>
        </label></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Lugar de Entierro:</strong></div></td>
        <td><textarea name="lug_ent_sep" cols="40" rows="4" id="lug_ent_sep"><?php  echo $_POST['lug_ent_sep']?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Sala:</strong></div></td>
        <td><?php generasalas(); ?><br></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Fondo:</strong></div></td>
        <td><?php generafondos(); ?><br></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Oraci&oacute;n:</strong></div></td>
        <td><?php generaoracion(); ?><br></td>
      </tr>
      <tr>
        <td><div align="right"><strong>M&uacute;sica:</strong></div></td>
        <td><?php generamusica(); ?><br></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Fecha de Sepelio:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha1","fcalen"); ?></td>
      </tr>
            <tr>
        <td><div align="right"><strong>Fecha de Fallecimiento:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha2","fcalen"); ?></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Fecha de Entierro:</strong></div></td>
        <td><?php escribe_formulario_fecha_vacio("fecha3","fcalen"); ?></td>
      </tr>
     <tr>
        <td width="150"><div align="right"><strong>Hora Entierro:</strong></div></td>
        <td><label>
          <input name="hora_sep" type="text" id="hora_sep" value="<?php  echo $_POST['hora_sep'];?>" size="20">
        </label></td>
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