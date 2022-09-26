<?php
/*
Delete User Script for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/

include('db_conn.php'); //db connection

//receive the data from the form
$id=$mysqli->real_escape_string($_POST['id']);


if ($id != ""){

    //queries to check whether ID is in the table (check whether the user is registered)
	$deleteAnswer = "DELETE FROM sec_answers WHERE id ='$id'";
	$deleteUser		= "DELETE FROM users WHERE id ='$id'";

	//execute query to the database and retrieve the result
	if ($mysqli->query($deleteAnswer) === TRUE){
		if ($mysqli->query($deleteUser) === TRUE){
			echo "User Successfully Deleted.";
		}
	}
}
else {
	echo "Error...";
}

?>  