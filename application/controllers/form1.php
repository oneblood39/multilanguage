<?php

//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
} else {
	echo 'test1 sayfası:D';
}




?>