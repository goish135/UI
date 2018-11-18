<?php

	$apikey = 'e831b1c1f127447bad940049181811';
	$baseUrl = 'https://api.worldweatheronline.com/free/v2/weather.ashx';
	
	// $queryURL = "$baseUrl/?q=Taichung&num_of_days=7&format=json&key=e831b1c1f127447bad940049181811";
	$queryURL = "http://api.worldweatheronline.com/premium/v1/weather.ashx?key=e831b1c1f127447bad940049181811&q=48.85,2.35&num_of_days=7&tp=3&format=json";
	// for curl 
	$params = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_URL => $queryURL
	);
	
	// Seeting curl options
	$curl = curl_init();
	curl_setopt_array($curl,$params);
	
	if(!$result = curl_exec($curl)){
		die('ErrorL "' .curl_error($curl) .'" -Code: ' .curl_errno($curl));
	}
	curl_close($curl);
		
	$response = json_decode($result,true);
	
	// 顯示天氣資訊
	echo '<table style="font-size: 10px; font-family: Arial, Helvetica,sans-serif">';
	for($i=0;$i<3;$i++){
		echo "<tr>";
		foreach($response['data']['weather'] as $weather){
			echo "<td>";
			switch ($i){
				case 0:
					echo date('D',strtotime($weather['date']));
					break;
				case 1:
					echo $weather['hourly'][0]['weatherDesc'][0]['value'];
					break;
				case 2:
					$imgSrc = $weather['hourly'][0]['weatherIconUrl'][0]['value'];
					echo "<img src='$imgSrc'/>";
					break;
			}
			echo "</td>";
		}
		echo "</tr>";
	}	
	echo '</table>';
?>

	