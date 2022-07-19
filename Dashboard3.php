<!--
Dashboard Page for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
-->
<!DOCTYPE html>

<?php
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
	}

    /* Pie Chart Conections */
    if($session_access != 0){
        include("assets/php/db_conn.php");
		$query = "SELECT * FROM abalone";
        $result = $mysqli->query($query);
        $query2 = "SELECT * FROM abalone2";
        $result2 = $mysqli->query($query2);


        @$content = $_SESSION["content"];
	}
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard3</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <!-- Pie Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" />
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Abalone', 'Length'],
                <?php
                while ($chart = mysqli_fetch_assoc($result))
                {
                    echo "['".$chart['Name']."',".$chart['Value']."],";
                }
                ?>
            ]);

            var options = {
                title: 'Abalone Length'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Abalone', 'Diameter'],
                <?php
                while ($chart2 = mysqli_fetch_assoc($result2))
                {
                    echo "['".$chart2['Name']."',".$chart2['Value']."],";
                }
                ?>
            ]);

            var options = {
                title: 'Abalone Diameter'
            };
            var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
            chart2.draw(data, options);
        }
    </script>


</head>
<body>

    <!-- Side Menu -->
    <section id="menu">
        <div class="logo">
            <img src="assets/img/logo.png" />
            <h2>Project 11 Dashboard</h2>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-house"></i><a href="Home.php">Home</a></li>
            <li><i class="fa-solid fa-chart-pie"></i><a href="Dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-magnifying-glass-chart"></i><a href="Analysis.php">Data Analysis</a></li>
            <li><i class="fa-solid fa-users"></i><a href="Management.php">User Management</a></li>
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
                <img src="assets/img/userimg.png" />
                <?php
                if (isset($_SESSION['session_access'])) {
                    //echo "<script type=\"text/javascript\">alert(\"You have successfully logged out\");</script>";
                    echo "<a class=\"sign-out\"  href=\"assets/php/signout.php\" id=\"loginbutton\">Logout</a>";
                }
                ?>
            </div>
        </div>

        <!-- Title -->
        <h3 class="i-name">Dashboard</h3>

        <!-- DB Connection for tables (is there a better way?) -->
        <?php
            if($session_access != 0){
                include("assets/php/db_conn.php");
	        }
        ?>

        <!-- Placholder 1 (Dropdowns here) -->
        <div class="values">
            <h5>Dropdowns go here --> </h5>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

        </div>

        <!-- Placholder 2 (Piecharts here) -->
        <div class="values">
            <h5>Piecharts go here --> </h5>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>
        </div>

        <!-- Table (Useful for User Management/Adaptation to Display Enviro Data) -->
        <div class="board">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php
                            $query3 = "SELECT `COLUMN_NAME` 
                            FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME = 'clientdata'";
                            $result3 = $mysqli->query($query3);
                            $row = mysqli_fetch_array($result3);
                            while ($row = $result3->fetch_assoc()) {
                                echo "<th scope=\"col\">{$row['COLUMN_NAME']}</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php         
                        if(isset($_SESSION['ranges1']) & isset($_SESSION['specificfield1']) ){    
                        @$query5 = "SELECT * FROM `clientdata` WHERE `{$_SESSION['specificfield1']}` = '{$_SESSION['ranges1']}' ";
                        $result5 = $mysqli->query($query5);
                        while ($row3 = $result5->fetch_array(MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<th scope=\"row\">";
                            echo $row3['TRIP_ID'];
                            echo "</th>";
                            echo "<td>";
                            echo $row3['DATE_TRIP'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['YEAR'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['MONTH'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['SITE_CODE'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['LATITUDE'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['LONGITUDE'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['GEOM'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['LICOR_AV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['DEPTH_SECCHI'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['DEPTH'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['REPLICATE'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['VOLUME_FILTERED'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['GC_CHLOROPHYLL_A'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['GC_CHLOROPHYLL_A_STDDEV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_A'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_A_STDDEV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PP_CHLOROPHYLL_A'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PP_CHLOROPHYLL_A_STDDEV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_B'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_B_STDDEV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_C'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PT_CHLOROPHYLL_C_STDDEV'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PHAEOPHYTIN'];
                            echo "</td>";
                            echo "<td>";
                            echo $row3['PHAEOPHYTIN_STDDEV'];
                            echo "</td>";
                            }
                        }
                    ?>
                </tbody>
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