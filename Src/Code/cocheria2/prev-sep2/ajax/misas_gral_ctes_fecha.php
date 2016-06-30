<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php 
	$MesMisa = $_GET['NEWMES'];
	if ($MesMisa =="")
	{$MesMisa=date("m");}
	
	$DiaMisa = $_GET['NEW'];
	if ($DiaMisa =="")
	{$DiaMisa=date("d/m/Y");}
	?>  
    <title>CORRIENTES / MISAS</title>
	<link href="../default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<BODY>
<?php include('../conexion.php'); ?>


<table width="705" align="center">
  <tr>
    <td>
	 <h1>CORRIENTES / MISAS <?php echo $DiaMisa?></h1>
   </td>
   </tr>
</table>
<table width="705" align="center">
  <tr><td align="center"><img src="img/misas.jpg" border="0" /></td></tr>
</table>
<table width="705" align="center" border="0" cellpadding="0" cellspacing="10">
<tr><td>
<!--Dropdown Mes -->
<form id="form2" name="form2" method="get" action="<?php echo "misas_gral_ctes_fecha.php?fechamisa="; ?>">
            Mes :
            <select Name='NEWMES'>
            <option value="">--- Seleccione ---</option>
            <?
                $list=mysql_query("SELECT DISTINCT (MONTH(Dia)) as Dia FROM sepelio WHERE DATE(dia) <> '0000-00-00' ORDER BY Dia DESC" );
            while($row_list=mysql_fetch_assoc($list)){
                ?>
                    <option value="<? echo $row_list['Dia']; ?>"<? if($row_list['Dia']==$select){ echo "selected"; } ?>>
                                         <?echo $row_list['Dia'];?>/2013
                    </option>
                <?
                }
                ?>
            </select>
            <input type="submit" name="Submit" value="Seleccionar" />
        </form>
        <br />
 <!--Dropdown -->
<form id="form1" name="form1" method="get" action="<?php echo "misas_gral_ctes_fecha.php?fechamisa="; ?>">
            Fecha :
            <select Name='NEW'>
            <option value="">--- Seleccione ---</option>
            <?
                $list=mysql_query("SELECT DISTINCT (DATE(Dia)) as Dia FROM sepelio WHERE DATE(dia) <> '0000-00-00' AND MONTH(Dia) = ".$MesMisa." ORDER BY Dia DESC" );
            while($row_list=mysql_fetch_assoc($list)){
                ?>
                    <option value="<? echo $row_list['Dia']; ?>"<? if($row_list['Dia']==$select){ echo "selected"; } ?>>
                                         <?echo $row_list['Dia'];?>
                    </option>
                <?
                }
                ?>
            </select>
            <input type="submit" name="Submit" value="Seleccionar" />
        </form>
 </td></tr>
 
 
<tr>

<?php
$sql= "SELECT Dia, Nombre, HoraMisa, id FROM sepelio WHERE LugarMisa=1 AND Dia = '".$DiaMisa."' ORDER BY HoraMisa ASC";
$total = mysql_num_rows(mysql_query($sql));
if($total<>0){
$res = mysql_query($sql) or die ("asdasda");
$res2 = mysql_query($sql) or die ("asdasda");
$mis2 = mysql_fetch_array($res2);
$fecha2 = $mis2['Dia'];
preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha2,$partes2);

echo "
<td id='titulo_misas'>Lugar: Iglesia Catedral</td>
<tr><td id='titulo_misas'>Fecha: ".$partes2[3]."/".$partes2[2]."/".$partes2[1]."</td></tr>
<tr><td id='titulo_misas'>En conmemoración de:</td></tr>
";
while($mis = mysql_fetch_array($res))
{

		$fecha = $mis['Dia']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);		
		
	
		echo "
		<tr><td><a href='http://www.cocheriadelparana.com.ar/cocheria2/prev-sep2/detalle_sep.php?idsep=".$mis['id']."'>	".ucwords(strtolower($mis['Nombre']))."- Hora: ".ucwords(strtolower($mis['HoraMisa']))."</a></td></tr>
			
		";
}//CIERRO: while($sep = mysql_fetch_array($sql))
		echo "</tr>
		<tr><td><br></td></tr>"
		;}

?>

</td>


<?php
$sql= "SELECT Dia, Nombre, HoraMisa, id FROM sepelio WHERE LugarMisa=18 AND Dia = '".$DiaMisa."' ORDER BY HoraMisa ASC";
$total = mysql_num_rows(mysql_query($sql));
if($total<>0){
$res = mysql_query($sql) or die ("asdasda");
$res2 = mysql_query($sql) or die ("asdasda");
$mis2 = mysql_fetch_array($res2);
$fecha2 = $mis2['Dia'];
preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha2,$partes2);

echo "
<td id='titulo_misas'>Lugar: Parque Jardin Natural</td>
<tr><td id='titulo_misas'>Fecha: ".$partes2[3]."/".$partes2[2]."/".$partes2[1]."</td></tr>
<tr><td id='titulo_misas'>En conmemoración de:</td></tr>
";
while($mis = mysql_fetch_array($res))
{

		$fecha = $mis['Dia']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);		
		
	
		echo "
			<tr><td><a href='http://www.cocheriadelparana.com.ar/cocheria2/prev-sep2/detalle_sep.php?idsep=".$mis['id']."'>	".ucwords(strtolower($mis['Nombre']))."- Hora: ".ucwords(strtolower($mis['HoraMisa']))."</a></td></tr>
		";
}//CIERRO: while($sep = mysql_fetch_array($sql))
		echo "</tr>
		<tr><td><br></td></tr>"
		;}

?>
<?php
$sql= "SELECT Dia, Nombre, HoraMisa, id FROM sepelio WHERE LugarMisa=19 AND Dia = '".$DiaMisa."' ORDER BY HoraMisa ASC";
$total = mysql_num_rows(mysql_query($sql));
if($total<>0){
$res = mysql_query($sql) or die ("asdasda");
$res2 = mysql_query($sql) or die ("asdasda");
$mis2 = mysql_fetch_array($res2);
$fecha2 = $mis2['Dia'];
preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha2,$partes2);

echo "
<td id='titulo_misas'>
Misas en agradecimiento por las donaciones recibidas del Hogar de Ancianos Juana de Chapo:</td>
<tr><td align='center'><img src='img/floressolidarias.png' border='0' width='80' height='80'/></td></tr>
<tr><td id='titulo_misas'>Fecha: ".$partes2[3]."/".$partes2[2]."/".$partes2[1]."</td></tr>
<tr><td id='titulo_misas'>En conmemoración de:</td></tr>
";
while($mis = mysql_fetch_array($res))
{

		$fecha = $mis['Dia']; 
		preg_match('/(\d{4})-(\d{2})-(\d{2})/',$fecha,$partes);		
		
	
		echo "
			<tr><td><a href='http://www.cocheriadelparana.com.ar/cocheria2/prev-sep2/detalle_sep.php?idsep=".$mis['id']."'>	".ucwords(strtolower($mis['Nombre']))."- Hora: ".ucwords(strtolower($mis['HoraMisa']))."</a></td></tr>
		";
}//CIERRO: while($sep = mysql_fetch_array($sql))
		echo "</tr>";}

?>
</td>
</td>
</tr>
</table>
</td></tr>

</table>
</td>
</tr>
</table>
<?php mysql_close();?>
</BODY>
</HTML>