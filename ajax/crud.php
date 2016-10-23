<?php

include('../models/dbconnect.php');

if($_POST){
	$post = $_POST;
	
	include('../models/' . $post['data_class'] . '.php');
	
	switch($post['type']){
		case 'add': 
			$class = new $post['data_class'];
			echo $class->add($post);
			break;
			
		case 'del': 
			$class = new $post['data_class'];
			echo $class->delete($post);
			break;
	}
	
	$response = array(
		'success' => true
	);
	
	echo json_encode($response);
}