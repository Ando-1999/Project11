<?php
include("session.php");
include("db_conn.php");
@$keywords = $mysqli->real_escape_string($_POST['keywords']);
$_SESSION['keywords'] = $keywords;
echo $keywords;
echo "www";


?>

