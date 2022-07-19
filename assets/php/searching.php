<?php
session_start();
include("db_conn.php");
@$specificfield= $mysqli->real_escape_string($_POST['specificfield']);
$_SESSION['specificfield1'] = $specificfield;


?>

