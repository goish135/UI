<?php
$value_file = fopen("./data/66000m10153.json","rb") or die("Unable to open file!");

$content = "";
while (!feof($value_file))
{
	$content .= fread($value_file,10000);
}
fclose($value_file);
$content = json_decode($content,true);
// echo print_r($content,true);

foreach($content as $locate)
{
	echo $locate['predict result']."<br>";
}

?> 