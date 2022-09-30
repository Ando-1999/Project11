<!DOCTYPE html>

<?php
    //include the file session.php
    include('assets/php/session.php');
	include('assets/php/db_conn.php');


    //if there is any received error message
    if(isset($_GET['error']))
    {
	    $errormessage=$_GET['error'];
	    //show error message using javascript alert
	    echo "
		<script>alert('$errormessage');</script>";
    }
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Password Reset</title>

		<!-- CSS Links -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
		<link rel="stylesheet" href="assets/css/password.css" />

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	</head>
	<body>
		<!-- Main Content -->
		<!-- Note: For this page, it's highly simplified due to it's overall purpose -->
		<div class="container" style="margin-top:15px; margin-bottom: 45px;">
			<div class="row">
				<form id="pwdReset" class="form-reset" action="" method="POST">
					<div class="col-sm-12">
						<h2 class="subtitle">Password Reset</h2>
					</div>
					<hr>
					<div class="col-sm-12">
						<p>Please enter your ID, and proceed to answer your chosen security question from your registration.</p>
					</div>
					<label for="userID">Your ID: </label>
					<br>
					<input class="form-control" type="email" id="userID" name="userID" placeholder="placeholder@address.com">
					<br>
					<label for="secQuestion">Question: </label>
					<br>
					<select class="form-control" id="questionSelect">
						<?php
							//Query value
							$questionsQuery = "SELECT * FROM sec_questions";

							//a php function using the value
							$questionsQueryResult = $mysqli->query($questionsQuery);
							echo '<option value="null">--Select an Option--</option>';
							while($questionsRow = mysqli_fetch_array($questionsQueryResult)){
								echo '
									<option value="'.$questionsRow['sq_id'].'">'.$questionsRow['sq_id'].' - '.$questionsRow['question'].'</option>
								';
							}
						?>
					</select>
					<br><hr>
					<label for="answer">Answer: </label>
					<br>
					<input class="form-control" type="text" id="answer" name="answer" placeholder="Answer...">
					<br>
					<label for="pwd">New Password: </label>
					<br>
					<input class="form-control" type="text" id="pwd" name="pwd" placeholder="New Password...">
					<br><hr>
					<button type="button" class="btn btn-success btn-reset" id="resetPwdSubmit">Reset Your Password</button>
					<button type="button" class="btn btn-danger btn-reset" id="resetPwdSubmit" onclick="history.back()">Cancel</button>
				</form>
			</div>
		</div>

		<script>
            $(document).ready(function(){
                $("#resetPwdSubmit").click(function(){
					var email = $("#userID").val();
                    var question = $("#questionSelect option:selected").val();
					var answer = $("#answer").val();
					var pwd = $("#pwd").val();

                    $.ajax({
                        url: "assets/php/reset_engine.php",
                        method: "POST",
                        data:{	//Data to be submitted
                            email,
							question,
							answer,
							pwd,
                        },

                        dataType: "html",
                        //Reloads the page to update table
                        //If the message output is as shown, send to main page
                        success: function(response){
                            alert(response);
                            if(response.trim()=="Password reset!"){
                                window.location.href='Sign-In.php';
							} else {
                                location.preventDefault();   
							}
			            }
                    });
                });
            });
        </script>
	</body>
</html>
