<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dberror = 'Could not connect!';
$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die($dberror);

$myDb = mysql_select_db('weather') or die('Could not select database!');