<?php
/*
Add User Script for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
*/

include('db_conn.php'); //db connection

//receive the data from the form
$firstname=$mysqli->real_escape_string($_POST['firstname']);
$lastname=$mysqli->real_escape_string($_POST['lastname']);
$email=$mysqli->real_escape_string($_POST['email']);
$num=$mysqli->real_escape_string($_POST['num']);
$institute=$mysqli->real_escape_string($_POST['institute']);
$available=$mysqli->real_escape_string($_POST['available']);
$question=$mysqli->real_escape_string($_POST['question']);
$answer=$mysqli->real_escape_string($_POST['answer']);

//Encrypting important data
$password = password_hash($num, PASSWORD_BCRYPT);
$answer = password_hash($answer, PASSWORD_BCRYPT);

if (($firstname != "") AND ($lastname != "") AND ($email != "") AND ($num != "") 
AND ($institute != "") AND ($available != "") AND (($question != "") AND ($question != "null")) AND ($answer != "") ){

    //queries to check whether ID is in the table (check whether the user is registered)
	$addUser = "INSERT INTO `users` (`first_name`, `last_name`, `password`, `email`, `num`, `role_id`, `available`, `institute`) VALUES
	('$firstname', '$lastname', '$password', '$email', '$num', 1, '$available', '$institute')";

	//execute query to the database and retrieve the result
	if ($mysqli->query($addUser) === TRUE){
		$newUser = $mysqli->query("SELECT id FROM users WHERE num = '$num'"); 
		$newUserRow = $newUser->fetch_array(MYSQLI_ASSOC);
		$id = $newUserRow['id'];
		$addSecAns = "INSERT INTO `sec_answers` (`id`, `sq_id`, `answer`) VALUES ('$id', '$question', '$answer')";
		if($mysqli->query($addSecAns) === TRUE){
			echo "User Successfully Added.";
		}
	}
}
else {
	echo "Error...";
}

?>  