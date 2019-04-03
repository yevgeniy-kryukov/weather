<?php

try {
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json; charset=utf-8");
	
	$config = include('config.php');
	
    # Create a connection
	$codecity = urlencode($_GET['codecity']);
	$apikey = $config['apikey'];
	$url = 'http://dataservice.accuweather.com/forecasts/v1/daily/5day/'.$codecity.'?apikey='.$apikey.'&language=ru&details=false&metric=true';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	# Get the response
	$response = curl_exec($ch);
	if($response === false) {
		echo json_encode(array('error' => curl_error($ch)));
	} else {
		echo $response;
	}

	curl_close($ch);

} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}