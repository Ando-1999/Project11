<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'blakea1', 'ando540244', 'projecttestdb');

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>