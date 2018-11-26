<?php

$token = "5fcc55c8-ead3-4317-9035-ec93baaf9441";
$start = "24.143658,120.671827";
$end = "24.123552,120.675326";

if( isset($_GET['start'])&& isset($_GET['end']))
{
	$start = $_GET['start'];
	$end = $_GET['end'];
}


// $url = "https://graphhopper.com/api/1/route?point=".$start."&point=".$end."&locale=en&points_encoded=true&key=".$token;

$url = "http://36.233.29.48:8000/navigation/start=".$start."&end=".$end."&transpotation=scooter";
// start=24.150841,120.6640538&end=24.144998,120.67054&transpotation=car


getHTML($url);
function getHTML($url)
{
	$cURL = $url;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $cURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	# https 呼叫設定(SSL)
	$output = curl_exec($ch);
	curl_close($ch);
	//echo $url."<br>";
	echo $output;
}


?>