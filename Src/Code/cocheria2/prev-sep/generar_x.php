<?php 

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