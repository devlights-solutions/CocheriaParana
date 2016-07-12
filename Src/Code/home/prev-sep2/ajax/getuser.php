<?php
$q = intval($_GET['q']);

$con = mysql_connect('localhost','cocheria_prevsep','quilombito69');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

$db = mysql_select_db('cocheria_prevsep2')
or die ("no se puede señalar la BD");

$sql="SELECT month(Dia) as Dia FROM sepelio WHERE MONTH(Dia) = '".$q."' limit 1";


$result = mysqli_query($con,$sql);

echo "<table border='1'>
<tr>
<th>Dia</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Dia'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>