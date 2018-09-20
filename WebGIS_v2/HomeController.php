<?php

$token = "AIzaSyAQF-RXijNaXP2F8YsphQxipN0jkDH84L8";
$start = "25.0574121,121.5964832";
$end = "25.0534121,121.5964832";

if( isset($_GET['start'])&& isset($_GET['end']))
{
	$start = $_GET['start'];
	$end = $_GET['end'];
}

$url = "https://maps.googleapis.com/maps/api/directions/json?language=zh-TW&origin=".$start."&destination=".$end."&key=".$token;

//$url = "https://maps.googleapis.com/maps/api/directions/json?language=zh-TW&origin=25.0574121,121.5964832&destination=25.0534121,121.5964832&key=AIzaSyC83Y7_mGH7tCKz5LBv72yiy4BaQa4rNG8";
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