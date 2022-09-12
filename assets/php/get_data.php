<?php
	include('db_conn.php');

	$stmt = $mysqli->prepare("SELECT * FROM clientdata ORDER BY TRIP_ID ASC");

	$stmt->execute();

	$clientdata = $stmt->get_result();
?>