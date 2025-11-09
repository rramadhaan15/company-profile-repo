<?php
$servername = "localhost";
$username = "rizki";
$password = "GantiPasswordBaru123!";
$dbname = "companydb";

$mysqli = new mysqli('localhost', 'rizki', 'GantiPasswordBaru123!', 'companydb');
if ($mysqli->connect_error) {
  die('DB Connection failed: ' . $mysqli->connect_error);
}
?>
