<?php
//setting header to json
header('Content-Type: application/json');

/*//database
define('DB_HOST', '217.116.197.83');
define('DB_USERNAME', 'wu_mizmeryonetim');
define('DB_PASSWORD', 'Ax5o#90xt5290');
define('DB_NAME', 'mizmeryonetim');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}*/

//query to get data from the table
$query = sprintf("SELECT playerid, score,mac FROM score ORDER BY playerid");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
//$mysqli->close();

//now print the data
print json_encode($data);