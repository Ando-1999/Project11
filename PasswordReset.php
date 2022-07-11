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
		<link rel="stylesheet" href="css/style-master.css">
		<link rel="stylesheet" href="css/style-table.css">
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
	<body>
		<!-- The Navigation Bar -->
		<!-- Note: For this page, it's highly simplified due to it's overall purpose -->
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand">Environmental Data Analysis Tool</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ml-auto">
					<?php
						if($session_access != 0){
							echo '
								<a href="php/signout.php" class="btn btn-light" role="button" id="signout">
								Sign-Out <i class="fas fa-sign-in-alt"></i></a>
							';
						} else {
							echo '
								<a href="Sign-In.php" class="btn btn-light" role="button" id="signin">
								Sign-In <i class="fas fa-sign-in-alt"></i></a>
							';
						}
					?>
				</ul>
			</div>
		</nav>

		<!-- Main Content -->
		<!-- Note: For this page, it's highly simplified due to it's overall purpose -->
		<div class="container" style="margin-top:15px; margin-bottom: 45px;">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="text-center">Password Reset</h2>
					<br>
				</div>
				<div class="col-sm-12">
					<p>Please enter your e-mail, and proceed to answer your chosen security question from your registration.</p>

					<form id="pwdReset" action="" method="POST">
						<label for="userID">Your E-mail: </label>
						<br>
						<input class="form-control" type="text" id="userID" name="userID" placeholder="e.g johnsmith@domain.com">
						<br><br>
						<label for="phrase">Passphrase: </label>
						<br>
						<input class="form-control" type="text" id="phrase" name="phrase">
						<br><hr>
						<label for="pwd">New Password: </label>
						<br>
						<input class="form-control" type="text" id="pwd" name="pwd">
						<br><hr>
						<button type="button" class="btn btn-success" id="resetPwdSubmit">Reset Your Password</button>
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
