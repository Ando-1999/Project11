<!--
Password Reset Page for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
-->

<!DOCTYPE html>

<?php
    //include the file session.php
    include('php/session.php');
	include('php/db_conn.php');


    //if there is any received error message
    if(isset($_GET['error']))
    {
	    $errormessage=$_GET['error'];
	    //show error message using javascript alert
	    echo "
		<script>alert('$errormessage');</script>";
    }
?>

<html lang="en">
	<head>	
		<title>Environmental Data Analysis Tool</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/sign-in.css">"
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>

		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<style>
			/**/
		</style>
	</head>
	<body style="background-color:lightseagreen;"> 
		<!-- Main Content -->
		<div class="container">
            <div class="row">
                <div class="col-sm">
                    <form id="pwdReset" action="" method="POST" class="form-signin" style="background-color:#ffffff;">
                        <h2 class="title mb-3 fw-normal text-center">Password Reset</h2>
						<p>Please enter your e-mail, and proceed to answer your chosen security question from your registration.</p>
                        <div class="form-floating" style="padding-bottom: 0.25px;">
                            <label for="userID">Your E-mail: </label>
							<input class="form-control" type="text" id="userID" name="userID" placeholder="e.g name@example.com">
                            <br>
                        </div>
                        <div class="form-floating">
                            <label for="phrase">Passphrase: </label>
							<input class="form-control" type="text" id="phrase" name="phrase">
                            <br>
                        </div>
						<div class="form-floating" style="padding-bottom:10px;">
							<label for="pwd">New Password: </label>
							<input class="form-control" type="text" id="pwd" name="pwd">
                        </div>
						<button type="button" class="btn btn-primary" id="resetPwdSubmit">Reset Your Password</button>
                    </form>
                </div>
            </div>
        </div>

		<script>
            $(document).ready(function(){
                $("#resetPwdSubmit").click(function(){
					var user = $("#userID").val();
                    var phrase = $("#phrase").val();
					var pwd = $("#pwd").val();

                    $.ajax({
                        url: "php/reset_engine.php",
                        method: "POST",
                        data:{	//Data to be submitted
                            user,
							phrase,
							pwd,
                        },

                        dataType: "html",
                        //Reloads the page to update table
                        //If the message output is as shown, send to main page
                        success: function(response){
                            alert(response);
                            if(response.trim()=="Password reset."){
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
