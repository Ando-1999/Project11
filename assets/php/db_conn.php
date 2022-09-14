<?php
	//Connect to MySQL database
	$servername='localhost';
	$username='root';
	$password='';
	$dbname = 'aq_data_db';
	$mysqli=mysqli_connect($servername,$username,$password,$dbname);

	if(!$mysqli){
	   die('Could not Connect My Sql:' .mysqli_error($mysqli));
	}
?>	