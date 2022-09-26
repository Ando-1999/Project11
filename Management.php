<!--
Management Page for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
Daiwei Yang (546818)
-->
<!DOCTYPE html>

<?php
    //DB Connection
    include("assets/php/db_conn.php");

    //include the file session.php
    include('assets/php/session.php');

    //if there is any received error message
    if(isset($_GET['error']))
    {
	    $errormessage=$_GET['error'];
	    //show error message using javascript alert
	    echo "<script>alert('$errormessage');</script>";
    }

	//Puts a logged in user back to the dashboard
	if($session_access == 0){
		header('location: ./Sign-In.php?error=Not%20Logged%20In');
	} else if ($session_access != 2){
        header('location: ./Dashboard.php?error=Not%20Authorised');
    }
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" type="text/css" href="assets/css/manage.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Side Menu -->
    <section id="menu">
        <div class="logo">
            <img src="assets/img/logo.png" />
            <h2>Project 11 Dashboard</h2>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-chart-pie"></i><a href="Dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-magnifying-glass-chart"></i><a href="Analysis.php">Data Analysis</a></li>
            <li><i class="fa-solid fa-robot"></i><a href="MachineLearning.php">ML Algorithm</a></li>
            <?php
                if($session_access == 2){
		            echo "<li><i class=\"fa-solid fa-users\"></i><a href=\"Management.php\">User Management</a></li>";
	            }
            ?>
            <li><i class="fa-solid fa-file-excel"></i><a href="Excel.php">Excel</a></li>
        </div>
    </section>

    <!-- Interface -->
    <section id="interface">
        <div class="navigation">

            <!-- Spacer -->
            <div class="n1"></div>

            <!-- Profile (We will likey use something else here)-->
            <div class="profile">
                <img src="assets/img/userimg.png" />
                <?php
                if (isset($_SESSION['session_access'])) {
                    echo "<a class=\"sign-out\"  href=\"assets/php/signout.php\" id=\"loginbutton\">Logout</a>";
                }
                ?>
            </div>
        </div>

        <!-- Title -->
        <h3 class="i-name">User Management</h3>

        <!-- Table -->
        <div class="board">
            <table width="100%">
                <?php
                $query = "SELECT * FROM users ORDER BY id ASC";
                echo '
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Details</td>
                        <td>Role</td>
                        <td>Status</td>
                        <td></td>
                    </tr>
                </thead>
                ';

                if ($result = $mysqli->query($query)){
                while ($row = $result->fetch_assoc()) {
                //------------------------- Fetch Role Title --------------------------//
                $role_id = $row["role_id"];
                $role_query = "SELECT role_title FROM roles WHERE role_id = '$role_id'";
                $role_fetch = $mysqli->query($role_query);
                $role_result = $role_fetch->fetch_assoc();
                //---------------------------------------------------------------------//

                // Fetch user details
                $id = $row["id"];
                $firstname = $row["first_name"];
                $lastname = $row["last_name"];
                $email = $row["email"];
                $num = $row["num"];
                $role = $role_result["role_title"];
                $institute = $row["institute"]; 

                // Construct table 
                echo '
                <tbody>
                    <tr>
                        <td class="id">
                            <p>'.$id.'</p>
                        </td>

                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>'.$firstname.' '.$lastname.'</h5>
                                <p>'.$num.'  ('.$email.')</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>'.$role.'</h5>
                            <p>'.$institute.'</p>
                        </td>';
                            
                        if($row["available"] == 1){
                            $status = "Available";
                            echo '
                            <td class="active">
                                <p>'.$status.'</p>
                            </td>';
                        } else {
                            $status = "Unavailable";
                            echo '
                            <td class="inactive">
                                <p>'.$status.'</p>
                            </td>';
                        }

                        echo '
                        <td class="edit">
                            <p><a data-id="'.$id.'" class="btn btn-outline-dark editModal">Edit</a></p>
                        </td>
                    ';
                    }
                    }
                    ?>
                    </tr>
                    <tr>
                        <td class="add">
                            <p><a data-id="add" class="btn btn-outline-dark addModal">Add User</a></p>
                        </td>
                    </tr>
                <tbody>
            </table>
        </div>
    </section>


    <!-- User Management Modal -->
	<div class="modal fade" id="manageUserModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Manage User</h4>
				</div>

				<div class="modal-body manage-modal">
                <!-- Will be populated via remote method -->
				</div>

				<div class="modal-footer">
                    <button type="button" class="btn btn-success" id="updateUserSubmit">Update User</button>
                    <button type="button" class="btn btn-warning" id="deleteUserWarning">Delete User</button>
					<button type="button" class="btn btn-danger closeManage">Close</button>
				</div>
			</div>
		</div>
	</div>

    <!-- User Delete Modal -->
	<div class="modal fade" id="deleteUserModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete User</h4>
				</div>
                <div class="modal-body delete-modal">
                    <h2>Are you sure?</h2>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-dark" id="deleteUserSubmit">Delete User</button>
					<button type="button" class="btn btn-danger closeDelete">Close</button>
				</div>
			</div>
		</div>
	</div>

    <!-- User Add Modal -->
	<div class="modal fade" id="addUserModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add User</h4>
				</div>
                <div class="modal-body add-modal">
                    <form id='addUserForm' action='' method='POST'>
	                    <p>First Name<input id='addfirstname' type='text' /></p>
	                    <p>Last Name<input id='addlastname' type='text' /></p>
	                    <p>E-Mail<input id='addemail' type='text' /></p>
	                    <p>Number<input id='addnum' type='text' /></p>
	                    <p>Institute<input id='addinstitute' type='text' /></p>
	                    <p>Availability 
		                    <select name='availability' id='addavailability'>
			                    <option value='1' selected>Available</option>
			                    <option value='0'>Unavailable</option>
		                    </select>
	                    </p>
                        <p>Security Question
                            <select name="secQuestion" id="addquestion">
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
                        </p>
					    <p>Security Answer<input id='addanswer' type='text' /></p>
                    </form>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-success" id="addUserSubmit">Add User</button>
					<button type="button" class="btn btn-danger closeAdd">Close</button>
				</div>
			</div>
		</div>
	</div>

    <!-- JS Link for BS 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
    <script>
        $('#menu-btn').click(function () {
            $('#menu').toggleClass('active');
        })
    </script>

    <script>
    $(document).ready(function(){

        //Basic Button Functions
        $(".closeManage").click(function() {

            //close the modal
            $("#manageUserModal").modal("hide");

        });
        $(".closeAdd").click(function() {

            //close the modal
            $("#addUserModal").modal("hide");

        });
        $(".closeDelete").click(function() {

            //close the modal
            $("#deleteUserModal").modal("hide");

        });
        $("#deleteUserWarning").click(function() {

            //close the modal
            $("#deleteUserModal").modal("show");

        });
        $(".addModal").click(function() {

            //close the modal
            $("#addUserModal").modal("show");

        });


        // Data Manipulation Functions
        $('.editModal').click(function(){
   
            var userid = $(this).data('id');

            // AJAX request
            $.ajax({
                url: 'assets/php/populate_modal.php',
                method: "POST",
                data: {userid: userid},
                success: function(response){ 
                    // Add response in Modal body
                    $('.manage-modal').html(response);

                    // Display Modal
                    $('#manageUserModal').modal('show'); 
                }
            });
        });
        $("#updateUserSubmit").click(function(){
            var id =        $("#id_display").data('id');
	        var firstname = $("#firstname").val();
	        var lastname =  $("#lastname").val();
	        var email =     $("#email").val();
	        var num =       $("#num").val();
	        var institute = $("#institute").val(); 
            var available = $("#availability option:selected").val();
					
            $.ajax({
                url: "assets/php/edit_user.php",
                method: "POST",
                data:{
                    id,
                    firstname,
                    lastname,
                    email,
                    num,
                    institute,
                    available,
                },
                dataType: "html",
                //Reloads the page to update table
				success: function (response) {
					alert(response);
					if (response.trim() == 'User Successfully Edited.') {
						location.reload();
					} else {
						location.preventDefault();
					}
				}
            });
        });
        $("#deleteUserSubmit").click(function(){
            var id = $("#id_display").data('id');
					
            $.ajax({
                url: "assets/php/delete_user.php",
                method: "POST",
                data:{
                    id,
                },
                dataType: "html",
				success: function (response) {
					alert(response);
					if (response.trim() == 'User Successfully Deleted.') {
						location.reload();
					} else {
						location.preventDefault();
					}
				}
            });
        });
        $("#addUserSubmit").click(function(){
	        var firstname = $("#addfirstname").val();
	        var lastname =  $("#addlastname").val();
	        var email =     $("#addemail").val();
	        var num =       $("#addnum").val();
	        var institute = $("#addinstitute").val(); 
            var available = $("#addavailability option:selected").val();
            var question =  $("#addquestion option:selected").val();
            var answer =    $("#addanswer").val();
					
            $.ajax({
                url: "assets/php/add_user.php",
                method: "POST",
                data:{
                    firstname,
                    lastname,
                    email,
                    num,
                    institute,
                    available,
                    question,
                    answer,
                },
                dataType: "html",
                //Reloads the page to update table
				success: function (response) {
					alert(response);
					if (response.trim() == 'User Successfully Added.') {
						location.reload();
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