<?php
	include('db_conn.php');

	$stmt = $mysqli->prepare("SELECT * FROM clientdata");

	$stmt->execute();

	$clientdata = $stmt->get_result();
?>