<?php 
include('../conexion.php'); 

if($_POST['guardar_ora'])
{
	$mensaje="";
	if (trim($_POST['tit_ora'])== ""){ $mensaje.="Complete el TITULO<br>"; }
	if (trim($_POST['text_ora']) == ""){ $mensaje.="Complete el TEXTO DE LA ORACIÓN<br>"; }

	//VERIFICO SI TENGO MENSAJES DE ERROR:
	if (!$mensaje){
		$instruccion = "insert into oracion(cod_ora, tit_ora , text_ora) values ('','$_POST[tit_ora]','$_POST[text_ora]')";
		$consulta = mysql_query ($instruccion) or die ($mensaje="Fallo en la consulta(alta1)");
		$_POST['tit_ora'] = "";
		$_POST['text_ora'] = "";
		
		$mensaje = "Oración agregada con éxito";
	} 


}

 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Agregar Oración</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
	<script language="JavaScript" src="calendario/javascripts.js"></script>
</head>
<BODY>
<table width="705" align="center">
  <tr>
    <td>
	 <h2>Agregar Oración<h2><br>
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
        <td><input name="tit_ora" type="text" id="tit_ora" value="<?php  echo $_POST['tit_ora'];?>" size="60"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Oración:</strong></div></td>
        <td><textarea name="text_ora" cols="45" rows="15" id="text_ora"><?php  echo $_POST['text_ora']?></textarea></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><label>
          <input name="guardar_ora" type="submit" id="guardar_ora" value="Guardar Oración" class="boton" />
        </label></td>
      </tr>
    </table>
    
    </form>

</body>
</html>