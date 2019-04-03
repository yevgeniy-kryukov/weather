<?php

try {
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json; charset=utf-8");
	
	$config = include('config.php');
	
    # Create a connection
	$q = urlencode($_GET['q']);
	$apikey = $config['apikey'];
	$url = 'http://dataservice.accuweather.com/locations/v1/cities/autocomplete?apikey='.$apikey.'&q='.$q.'&language=ru';
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
