<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php 
include('conexion.php');
$contar = "SELECT * FROM localidad"; 
$contarok= mysql_query($contar);
$total_records = mysql_num_rows($contarok);

return "Hola ".$total_records;

?>
<body>
</body>
</html>