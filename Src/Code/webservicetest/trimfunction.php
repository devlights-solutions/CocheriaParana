<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>



<?php

$str = "Santiago  ";


$array =str_word_count($str, 1);

//echo str_word_count($str);

echo '<br/>';
echo '<br/>';
$normalice='';
for ($i = 0; $i <= (str_word_count($str)-1); $i++) {
    $normalice=$normalice.$array[$i].' '; 
	//echo $i;
}
echo $normalice;
?>
</body>
</html>