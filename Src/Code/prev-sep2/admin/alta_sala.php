<?php 
include('../conexion.php'); 
include ("calendario/calendario.php");
include ("funcion_fechas.php");

if($_POST['guardar_sala'])
{
	$mensaje="";
	if (trim($_POST['localidad_sal'])== ""){ $mensaje.="Complete la LOCALIDAD<br>"; }
	if (trim($_POST['prov_sal']) == ""){ $mensaje.="Complete la PROVINCIA<br>"; }
	if (trim($_POST['direc_sal']) == ""){ $mensaje.="Complete la DIRECCIÓN<br>"; }
	if (trim($_POST['sala']) == ""){ $mensaje.="Complete la SALA<br>"; }

	//VERIFICO SI TENGO MENSAJES DE ERROR:
	if (!$mensaje){
		$instruccion = "insert into salas(cod_sal, localidad_sal , prov_sal, direc_sal, sala) values ('','$_POST[localidad_sal]','$_POST[prov_sal]','$_POST[direc_sal]', '$_POST[sala]')";
		$consulta = mysql_query ($instruccion) or die ($mensaje="Fallo en la consulta(alta1)");
		$_POST['localidad_sal'] = "";
		$_POST['prov_sal'] = "";
		$_POST['lug_ent_sep'] = "";
		$_POST['direc_sal'] = "";
		$_POST['sala'] = "";
		
		$mensaje = "Sala agregada con éxito";
	} 


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
	 <h2>Agregar Sala<h2><br>
   </td>
   </tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
    <form action="" method="post" enctype="multipart/form-data">
      <tr>
        <td width="100%" colspan="2" align="center"><span class="mens-alert"><?php  echo $mensaje; ?></span></td>
      </tr>
      <tr>
        <td width="150"><div align="right"><strong>Localidad:</strong></div></td>
        <td><input name="localidad_sal" type="text" id="localidad_sal" value="<?php  echo $_POST['nom_sep'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Provincia:</strong></div></td>
        <td><input name="prov_sal" type="text" id="prov_sal" value="<?php  echo $_POST['nom_sep'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Dirección:</strong></div></td>
        <td><input name="direc_sal" type="text" id="direc_sal" value="<?php  echo $_POST['nom_sep'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Sala:</strong></div></td>
        <td><input name="sala" type="text" id="sala" value="<?php  echo $_POST['nom_sep'];?>" size="50"></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><label>
          <input name="guardar_sala" type="submit" id="guardar_sala" value="Guardar Sala" class="boton" />
        </label></td>
      </tr>
    </table>
    
    </form>

</body>
</html>