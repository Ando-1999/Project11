<?php
	include('db_conn.php');

	$stmt = $mysqli->prepare("SELECT * FROM aq_data ORDER BY TRIP_ID ASC");

	$stmt->execute();

	$clientdata = $stmt->get_result();
?>