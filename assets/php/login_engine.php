<?php
/*
Login Engine for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244) and Daiwei Yang (546818)
*/
	error_reporting(0);
	//include the file session.php
	include("session.php");
	//include the file db_conn.php
	include("db_conn.php");

	//receive the ID data from the form
	$user=$mysqli->real_escape_string($_POST['id']);
	//receive the password data from the form
	$password=$mysqli->real_escape_string($_POST['pwd']);

	//Check whether email or password is empty
	if (empty($user)) {
        echo "Email is required";
    }
    elseif (empty($password)) {
        echo "Password is required";
    }


	//Secondary check to ensure user/password is not empty before proceeding
	if (($user != "") AND ($password != "")){

		//queries to check whether ID is in the table (check whether the user is registered)
		$userQuery = "SELECT * FROM `users` WHERE email ='$user'";

		//execute query to the database and retrieve the result
		$userQueryResult = $mysqli->query($userQuery);

		//convert the results to array (the key of the array will be the column names of the table)
		$rowUser=$userQueryResult->fetch_array(MYSQLI_ASSOC);

		//Encrypted password and user check
		//For my test DB, the pwd is 'Project11password!', encrypted with bcrypt (12 rounds)
		if($rowUser['email'] == $user && password_verify($password, $rowUser['password']) ) {
			//save the ID in the session
			$session_ID = $rowUser['id'];
			//save the user's name in the session
			$session_firstname = $rowUser['first_name'];
			//save the access level (determined by role) in the session
			//save the access level (determined by role) in the session
			if($rowUser['role_id'] == 2){
				$session_access = "2";
			} else {
				$session_access = "1";
			}

			$_SESSION['session_ID']=$session_ID;
			$_SESSION['session_firstname']=$session_firstname;
			$_SESSION['session_access']=$session_access;

			//Message successful login
			echo 'Login Successful.';

		}
		else{
			echo 'Invalid e-mail or password, please try again.';
		} 
		
	}
	 
?>