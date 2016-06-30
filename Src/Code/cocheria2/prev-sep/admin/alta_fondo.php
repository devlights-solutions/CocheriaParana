<?php 
include('../conexion.php'); 
include ("calendario/calendario.php");
include ("funcion_fechas.php");

if($_POST['guardar_fondo'])
{
	$mensaje="";
	if (trim($_POST['tit_fon'])== ""){ $mensaje.="Complete el TITULO<br>"; }
	if (trim($_POST['img_fon']) == "0"){ $mensaje.="Seleccione una IMAGEN <br>"; }

		//verifico que levante solo archivos de imagenes en el CAMPO IMG_FON:
		if (is_uploaded_file($_FILES['img_fon']['tmp_name']))
		{
			$tipo_archivo = $_FILES['img_fon']['type']; 
			if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "tiff") || strpos($tipo_archivo, "bmp") || strpos($tipo_archivo, "jpg")))) 
			{ 
				$mensaje.="Solo se aceptan im&aacute;genes de tipo: GIF-JPEG-JPG-PNG-TIFF-BMP como Fondo<br>";
			}
		}



	//VERIFICO SI TENGO MENSAJES DE ERROR:
	if (!$mensaje){
		$instruccion = "insert into fondos(cod_fon, tit_fon , url_fon) values ('','$_POST[tit_fon]','')";
		$consulta = mysql_query ($instruccion) or die ($mensaje="Fallo en la consulta(alta1)");
		$_POST['tit_fon'] = "";

	$sql = "select max(cod_fon) as M from fondos";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$max = $row['M']; 
	if (is_uploaded_file($_FILES['img_fon']['tmp_name']))
	{
		//EXPLODE: para que separe la extension y pueda ser gif o jpg
		$extension = explode(".",$_FILES['img_fon']['name']);
		$nombreDirectorio = "../fondos/"; 
		//para que no se repita la imagen con el mismo nombre

		$nombreFichero = "fondo".$max.".".$extension[1]; 
		move_uploaded_file ($_FILES['img_fon']['tmp_name'],$nombreDirectorio .$nombreFichero)or die("Upload de IMG-1 incorrecto");
		mysql_query("UPDATE fondos SET url_fon = '$nombreFichero' WHERE cod_fon = '$max'");
    	
		$rutaimagen = $nombreDirectorio.$nombreFichero;
		$rutaDestino = "fondo".$max.".".$extension[1];;
     	$original = imagecreatefromjpeg($nombreDirectorio.$nombreFichero);
        $anchoThumb = 400;
		$altoThumb = 190;
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
		
		$mensaje = "Fondo agregado con éxito";
	} 


}

 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Agregar Fondo</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Agregar Fondo<h2><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
    <form action="" method="post" enctype="multipart/form-data">
      <tr>
        <td width="100%" colspan="2" align="center"><span class="mens-alert"><?php  echo $mensaje; ?></span></td>
      </tr>
      <tr>
        <td width="150"><div align="right"><strong>Título:</strong></div></td>
        <td><input name="tit_fon" type="text" id="tit_fon" value="<?php  echo $_POST['tit_fon'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Fondo:</strong></div></td>
        <td><input name="img_fon" type="file" id="img_fon" value= <?php echo $_POST['img_fon']?>></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><label>
          <input name="guardar_fondo" type="submit" id="guardar_fondo" value="Guardar Fondo" class="boton" />
        </label></td>
      </tr>
    </table>
    
    </form>

</body>
</html>