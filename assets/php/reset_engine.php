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

	//receive the data from the form
	$email=$mysqli->real_escape_string($_POST['email']);
	$question=$mysqli->real_escape_string($_POST['question']);
	$answer=$mysqli->real_escape_string($_POST['answer']);
	$pwd=$mysqli->real_escape_string($_POST['pwd']);


	//Secondary check to ensure user/phrase is not empty before proceeding
	if (($email != "") AND ($question != "") AND ($answer != "")AND ($pwd != "")){
		//Very neat lil query here
		$questionFetch = $mysqli->query("SELECT * FROM sec_answers WHERE id IN (SELECT id FROM users WHERE email = '$email')");
		$question_cnt = $questionFetch->num_rows;

		//Both a check for the question, and the user's role
		//All users have a sec question, so one will exist within the corresponding field
		if($question_cnt == 0){
			echo 'No question exists for this ID. Please ensure ID is correct, and that position is correct. If both are correct, contact IT support.';
		} else {
					
			
			$questionRow=$questionFetch->fetch_array(MYSQLI_ASSOC);

			if($question != $questionRow['sq_id']){
				echo 'Selected question does not match your previously selected question.';
			} 
			
			//Success, now check if answers match			
			if(crypt($answer, $questionRow['answer'])){
				$encryptedPassword = password_hash($pwd, PASSWORD_BCRYPT);
				$passwordReset = "UPDATE users SET password = '".$encryptedPassword."' WHERE id = '".$id."'";
				if ($mysqli->query($passwordReset) === TRUE) {
					echo "Password reset!";
				} else {   
					//Outputs an error message for the query
					echo "Error: " . $mysqli->error;
				}
			}
		}
	} else {
		echo 'Failed to reset password. ' . $id;
	}

?>

