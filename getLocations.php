<?php

include('dbconnect.php');

$query = 'SELECT * FROM locations';
$queryConn = mysql_query($query);
$locations = array();
if($queryConn){
	while($row = mysql_fetch_array($queryConn, MYSQL_ASSOC))
	{
		$locations[] = $row;
	}
}