<?php 
include('../conexion.php'); 

if($_POST['guardar_musica'])
{
	$mensaje="";
	if (trim($_POST['tit_mus'])== ""){ $mensaje.="Complete el TITULO<br>"; }
	if (trim($_POST['interp_mus'])== ""){ $mensaje.="Complete el INTERPRETE<br>"; }
	if (trim($_POST['arc_mus']) == "0"){ $mensaje.="Seleccione un ARCHIVO <br>"; }
	
		//verifico que levante solo archivos de sonidos:
		if (is_uploaded_file($_FILES['arc_mus']['tmp_name']))
		{
			$tipo_archivo = $_FILES['arc_mus']['type']; 
			if (!((strpos($tipo_archivo, "mp3") || strpos($tipo_archivo, "mpeg")))) 
			{ 
				$mensaje.="Solo se aceptan archivos de sonido de tipo: MP3<br>";
			}
		}	

	//VERIFICO SI TENGO MENSAJES DE ERROR:
	if (!$mensaje){
		$instruccion = "insert into musica(cod_mus, tit_mus , interp_mus, url_mus) values ('','$_POST[tit_mus]','$_POST[interp_mus]','')";
		$consulta = mysql_query ($instruccion) or die ($mensaje="Fallo en la consulta(alta1)");
		$_POST['tit_mus'] = "";
		$_POST['interp_mus'] = "";

	$sql = "select max(cod_mus) as M from musica";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$max = $row['M']; 
	if (is_uploaded_file($_FILES['arc_mus']['tmp_name']))
	{
		//EXPLODE: para que separe la extension y pueda ser gif o jpg
		$extension = explode(".",$_FILES['arc_mus']['name']);
		$nombreDirectorio = "../mp3_files/"; 
		//para que no se repita la imagen con el mismo nombre

		$nombreFichero = "musica".$max.".".$extension[1]; 
		move_uploaded_file ($_FILES['arc_mus']['tmp_name'],$nombreDirectorio .$nombreFichero)or die("Upload de IMG-1 incorrecto");
		mysql_query("UPDATE musica SET url_mus = '$nombreFichero' WHERE cod_mus = '$max'");
    	
	}	
		
		$mensaje = "Archivo de Sonido agregado con éxito";
	} 


}

 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Agregar Música</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Agregar Música<h2><br>
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
        <td><input name="tit_mus" type="text" id="tit_mus" value="<?php  echo $_POST['tit_mus'];?>" size="50"></td>
      </tr>
      <tr>
        <td width="150"><div align="right"><strong>Interprete:</strong></div></td>
        <td><input name="interp_mus" type="text" id="interp" value="<?php  echo $_POST['interp_mus'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Música:</strong></div></td>
        <td><input name="arc_mus" type="file" id="arc_mus" value= <?php echo $_POST['arc_mus']?>></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><label>
          <input name="guardar_musica" type="submit" id="guardar_musica" value="Guardar Música" class="boton" />
        </label></td>
      </tr>
    </table>
    
    </form>

</body>
</html>