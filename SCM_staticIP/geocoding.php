<?php

// $token = "5fcc55c8-ead3-4317-9035-ec93baaf9441";


if(isset($_GET['q']))
{
	$q = $_GET['q'];
}


// $url = "https://graphhopper.com/api/1/geocode?q=".$q."&locale=zh&debug=true&key=".$token;
$url = "http://nominatim.openstreetmap.org/search.php?format=json&zoom=18&addressdetails=1&q=".$q;
// echo $url;
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
	echo $output;
}


?>