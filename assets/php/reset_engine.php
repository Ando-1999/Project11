<?php
/*
Reset Engine for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244) 
*/

	error_reporting(0);
	//include the file session.php
	include("session.php");
	//include the file db_conn.php
	include("db_conn.php");

	//receive the ID data from the form
	$user=$mysqli->real_escape_string($_POST['user']);
	//receive the phrase data from the form
	$phrase=$mysqli->real_escape_string($_POST['phrase']);
	//receive the password data from the form
	$pwd=$mysqli->real_escape_string($_POST['pwd']);

	//Check whether email or password is empty
	if (empty($user)) {
        echo "Email is required";
    }
    elseif (empty($phrase)) {
        echo "Phrase is required";
    }
	elseif (empty($pwd)) {
        echo "Password is required";
    }
	//Secondary check to ensure user/phrase is not empty before proceeding
	if (($user != "") AND ($phrase != "") AND ($pwd != "")){

		$encryptedPassword = password_hash($pwd, PASSWORD_BCRYPT);

		//queries to check whether ID is in the table (check whether the user is registered)
		$userQuery = "SELECT * FROM `users` WHERE email ='$user'";

		//execute query to the database and retrieve the result
		$userQueryResult = $mysqli->query($userQuery);

		//convert the results to array (the key of the array will be the column names of the table)
		$rowUser=$userQueryResult->fetch_array(MYSQLI_ASSOC);

		if($rowUser['email'] == $user){
			if(password_verify($phrase, $rowUser['passphrase'])) {
				$passwordReset = "UPDATE `users` SET `password` = '$encryptedPassword' WHERE `email` = '$user'";
				if ($mysqli->query($passwordReset) === TRUE) {
					echo "Password reset.";
				}
			}
		} else {
			echo 'Failed to reset password.';
		}
	} else {
		echo 'Failed to reset password.';
	}
?>