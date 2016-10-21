<?php

	$weekDays = array(
		0 => 'Sun',
		1 => 'Mon',
		2 => 'Tue',
		3 => 'Wed',
		4 => 'Thu',
		5 => 'Fri',
		6 => 'Sat',
	);

	$woeId = 839722;
	if(isset($_POST['woeId'])){
		$woeId = $_POST['woeId'];
	}
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    //$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="chicago, il")';
	//$yql_query = 'select * from geo.places(1) where woeid = 2442047';
	$yql_query = 'select * from weather.forecast where woeid = ' . $woeId . ' and u = "c"';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $json = curl_exec($session);
    // Convert JSON to PHP object
     $phpObj =  json_decode($json);
	 $result = $phpObj->query->results->channel;
    
	if(isset($_POST['woeId'])){
		ob_start();
		include "weather-box.html";
		$content = ob_get_contents();
		ob_end_clean();
		
		$response = array(
			'success' => true,
			'content' => $content
		);
		
		echo json_encode($response);
	}
?>