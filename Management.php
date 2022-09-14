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
	    echo "
        <script>alert('$errormessage');</script>";
    }

	//Puts a logged in user back to the dashboard
	if($session_access == 0){
		header('location: ./Sign-In.php?error=Not%20Logged%20In');
	} else if ($session_access == 1){
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

            <!-- Search -->
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fa-solid fa-bars"></i>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <form>
                        <input type="text" placeholder="Search..." />
                    </form>
                </div>
            </div>

            <!-- Profile (We will likey use something else here)-->
            <div class="profile">
                <i class="fa-solid fa-bell"></i>
                <img src="assets/img/userimg.png"/>
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
                            <td>Name</td>
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
                                            <p>'.$email.'</p>
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
                                        <p><a href="#">Edit</a></p>
                                    </td>
                                </tr>
                            <tbody>
                        ';
                    }
                }
                ?>
            </table>
        </div>
    </section>

    <!-- JS Link for BS 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
    <script>
        $('#menu-btn').click(function () {
            $('#menu').toggleClass('active');
        })
    </script>

</body>
</html>