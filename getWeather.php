<?php

	$weekDays = array(
		0 => array(
			'short_title' => 'Sun',
			'long_title' => 'Sunday'
		),
		1 => array(
			'short_title' => 'Mon',
			'long_title' => 'Monday'
		),
		2 => array(
			'short_title' => 'Tue',
			'long_title' => 'Tuesday'
		),
		3 => array(
			'short_title' => 'Wed',
			'long_title' => 'Wednesday'
		),
		4 => array(
			'short_title' => 'Thu',
			'long_title' => 'Thursday'
		),
		5 => array(
			'short_title' => 'Fri',
			'long_title' => 'Friday'
		),
		6 => array(
			'short_title' => 'Sat',
			'long_title' => 'Saturday'
		),
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