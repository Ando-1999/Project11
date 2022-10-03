<?php
/*
Populate Modal Script for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/

// Load the database configuration file
error_reporting(0);
include('db_conn.php');

$userid = 0;
if(isset($_POST['userid'])){
   $userid = mysqli_real_escape_string($mysqli, $_POST['userid']);
}
$sql = "select * from users where id=".$userid;
$result = mysqli_query($mysqli,$sql);

$response = "<form id='manageUserForm' action='' method='POST'>";
while( $row = mysqli_fetch_array($result) ){

	// Fetch user details
	$id = $row["id"];
	$firstname = $row["first_name"];
	$lastname = $row["last_name"];
	$email = $row["email"];
	$num = $row["num"];
	$institute = $row["institute"]; 
	$available = $row["available"]; 


	$response .= "<p>ID: ";
	$response .= "<span style='float:right' id='id_display' data-id='$id'><b>".$id."</b></span>";
	$response .= "</p>";

	$response .= "<p>First Name: ";
	$response .= "<input id='firstname' type='text' value=".$firstname." />";
	$response .= "</p>";

	$response .= "<p>Last Name: ";
	$response .= "<input id='lastname' type='text' value=".$lastname." />";
	$response .= "</p>";

	$response .= "<p>E-Mail: "; 
	$response .= "<input id='email' type='text' value=".$email." />";
	$response .= "</p>";

	$response .= "<p>Number: ";
	$response .= "<input id='num' type='text' value=".$num." />";
	$response .= "</p>";

	$response .= "<p>Institute: ";
	$response .= "<input id='institute' type='text' value=".$institute." />"; 
	$response .= "</p>";

	$response .= "<p>Availability: ";
	$response .= "<select name='availability' id='availability'>";
	if(!$available){
		$response .= "<option value='1'>Available</option>";
		$response .= "<option value='0' selected>Unavailable</option>";
	} else {
		$response .= "<option value='1' selected>Available</option>";
		$response .= "<option value='0'>Unavailable</option>";
	}
	$response .= "</select>";
	$response .= "</p>";
}
$response .= "</form>";

echo $response;
exit;

?>