<?php

include('models/dbconnect.php');
include('helpers/getWeather.php');
include('models/Location.php');

$location = new Location();
$locations = $location->getLocations();

include('templates/layout.html');