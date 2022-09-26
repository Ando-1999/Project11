<?php
session_start();
include("db_conn.php");
@$ranges = $mysqli->real_escape_string($_POST['ranges']);
$_SESSION['ranges1'] = $ranges;
?>