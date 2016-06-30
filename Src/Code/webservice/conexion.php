<?php

$conexion = mysql_connect('localhost','cocheria_prevsep','quilombito69')
or die ("No se puede conectar con el servidor");

$db = mysql_select_db('cocheria_prevsephome')
or die ("no se puede señalar la BD");

?>
