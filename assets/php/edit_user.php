<?php
/*
Edit User Script for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/
error_reporting(0);
include('db_conn.php'); //db connection

//receive the data from the form
$id=$mysqli->real_escape_string($_POST['id']);
$firstname=$mysqli->real_escape_string($_POST['firstname']);
$lastname=$mysqli->real_escape_string($_POST['lastname']);
$email=$mysqli->real_escape_string($_POST['email']);
$num=$mysqli->real_escape_string($_POST['num']);
$institute=$mysqli->real_escape_string($_POST['institute']);
$available=$mysqli->real_escape_string($_POST['available']);

if (($id != "") AND ($firstname != "") AND ($lastname != "") AND ($email != "") AND ($num != "") AND ($institute != "") AND ($available != "")){

    //queries to check whether ID is in the table (check whether the user is registered)
	$updateUser = "UPDATE users SET first_name ='$firstname', last_name ='$lastname', 
    email ='$email', num ='$num', institute ='$institute', 
    available ='$available' WHERE id ='$id'";

	//execute query to the database and retrieve the result
	if ($mysqli->query($updateUser) === TRUE){
		echo "User Successfully Edited.";
	}
}
else {
	echo "Error...   ";
}

?>  