<?php

include('dbconnect.php');

if($_POST){
	$post = $_POST;
	
	switch($post['type']){
		case 'add': 
			$checkQuery = 'SELECT * FROM favourites WHERE woeid = ' . $post['woeId'];
			$check = mysql_query($checkQuery);
			$row = mysql_fetch_array($check);
			
			if(!$row){
				$query = 'INSERT INTO favourites (location, woeid) VALUES("' . $post['location'] . '", ' . $post['woeId'] . ')';
				mysql_query($query) or die('Couldnt save!');
			} else {
				$response = array(
					'success' => false,
					'exists' => true
				);
				echo json_encode($response);
				die();
			}
			break;
			
		case 'del': 
			$query = 'DELETE FROM favourites WHERE woeid = ' . $post['woeId'];
			mysql_query($query) or die('Couldnt delete!');
			break;
	}
	
	$response = array(
		'success' => true
	);
	
	echo json_encode($response);
}