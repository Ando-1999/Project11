<?php
/*
Export Engine for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/

// Load the database configuration file
include('db_conn.php');

$query = "SELECT * FROM clientdata";
$result = $mysqli->query($query);
if (!$result) die('Couldn\'t fetch records');
$headers = $result->fetch_fields();
foreach($headers as $header) {
    $head[] = $header->name;
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, array_values($head)); 
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>