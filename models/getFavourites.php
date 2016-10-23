<?php

include('dbconnect.php');

$query = 'SELECT * FROM favourites';
$queryConn = mysql_query($query);
$result = array();
if($queryConn){
	while($row = mysql_fetch_array($queryConn, MYSQL_ASSOC))
	{
		$result[] = $row;
	}

	ob_start();
	include "../templates/favourites-list.html";
	$content = ob_get_contents();
	ob_end_clean();
	
	$response = array(
		'success' => true,
		'content' => $content
	);
	
	echo json_encode($response);
}