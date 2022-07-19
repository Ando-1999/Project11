<?php
	//Connect to MySQL database
	$servername='localhost';
	$username='project11';
	$password2='ToorToor1';
	$dbname = "projecttestdb";
	$mysqli=mysqli_connect($servername,$username,$password2,$dbname);

	if(!$mysqli){
	   die('Could not Connect My Sql:' .mysqli_error($mysqli));
	}
?>	