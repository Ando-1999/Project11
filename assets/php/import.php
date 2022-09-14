<?php
/*
Import Engine for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/


// Load the database configuration file
include('db_conn.php');
 
// Read the uploaded CSV file
$fh = fopen($_FILES["import_csv"]["tmp_name"], "r");
if ($fh === false) { exit("Failed to open uploaded CSV file"); }
 
// Import the CSV file, row by row
$count = 0;
while (($row = fgetcsv($fh)) !== false) {
	
    $count++;
    if ($count == 1) { continue; }
	try {
		$stmt = $mysqli->prepare("INSERT INTO `aq_data` (FID,TRIP_ID,DATE_TRIP,YEAR,MONTH,SITE_CODE,LATITUDE,LONGITUDE,GEOM,LICOR_AV,DEPTH_SECCHI,DEPTH,
		REPLICATE,VOLUME_FILTERED,GC_CHLOROPHYLL_A,GC_CHLOROPHYLL_A_STDDEV,PT_CHLOROPHYLL_A,PT_CHLOROPHYLL_A_STDDEV,PP_CHLOROPHYLL_A,PP_CHLOROPHYLL_A_STDDEV,PT_CHLOROPHYLL_B,
		PT_CHLOROPHYLL_B_STDDEV,PT_CHLOROPHYLL_C,PT_CHLOROPHYLL_C_STDDEV,PHAEOPHYTIN,PHAEOPHYTIN_STDDEV) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->execute([
			$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10], $row[11], $row[12], $row[13], $row[14], 
			$row[15], $row[16], $row[17], $row[18], $row[19], $row[20], $row[21], $row[22], $row[23], $row[24], $row[25]
		]);
	} catch (Exception $ex) { echo $ex->getmessage(); }	
}
fclose($fh);

echo "Success!";

?>