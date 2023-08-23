<?php
// Set CORS headers
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type");

include "DbConnect.php";
$objDb = new DbConnect;
$conn=$objDb->connect();
var_dump($conn);

