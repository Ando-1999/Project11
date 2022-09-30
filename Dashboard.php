<!--
Dashboard Page for Environmental Data Analysis Tool
Author/s: Blake J. Anderson (540244)
Daiwei Yang (546818)
-->
<!DOCTYPE html>

<?php
    //DB Connection
    include("assets/php/db_conn.php");

    //Include the file session.php
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
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"     integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"         integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"                                                       integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Retrieve Pie Chart Data-->
    <?php
        //Set the arrays to the stored previously selected values for the session
        if(isset($_SESSION['ranges1']) & isset($_SESSION['specificfield1'])){
            $query6 = "SELECT `{$_SESSION['specificfield1']}` FROM `aq_data`";
            $result6 = $mysqli->query($query6);
            $row6 = mysqli_fetch_array($result6);
            @$rangearr = array();
            while ($row6 = $result6->fetch_assoc()) {
              array_push($rangearr,$row6[$_SESSION['specificfield1']]);
            }
            //To calculate the percentage of each item
            $total = 0;
            foreach(array_count_values($rangearr) as $x => $val){    
              $total = $val + $total;
            }
            foreach(array_count_values($rangearr) as $x => $val){    
              $percentage = $val / $total;
            }
        //Set the arrays to 'TRIP_ID' on startup
        } else {
            $query6 = "SELECT `TRIP_ID` FROM `aq_data`";
            $result6 = $mysqli->query($query6);
            $row6 = mysqli_fetch_array($result6);
            @$rangearr = array();
            while ($row6 = $result6->fetch_assoc()) {
              array_push($rangearr,$row6['TRIP_ID']);
            }
            //To calculate the percentage of each item
            $total = 0;
            foreach(array_count_values($rangearr) as $x => $val){    
              $total = $val + $total;
            }
            foreach(array_count_values($rangearr) as $x => $val){    
              $percentage = $val / $total;
            }
        }
    ?>

	<!--Draw Pie Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['SpecificField', 'Percentage'],
                    <?php
                    foreach(array_count_values($rangearr) as $x => $val){    
                      $percentage = $val / $total;
                      echo "['".$x."',".$percentage."],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Percentage'
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
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
            <li><i class="fa-solid fa-chart-pie"></i><a href="Dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-magnifying-glass-chart"></i><a href="Analysis.php">Data Analysis</a></li>
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
        <h3 class="i-name">Dashboard</h3>


        <!-- Searching -->
        <form class="row g-3 needs-validation" action="" method="post" >
            <div class = "values">
                <div class="val-box">
                    <!-- Retrive data for the first drop-down list -->
                    <?php
					    $query3 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME = 'aq_data'";
					    $result3 = $mysqli->query($query3);
					    $row = mysqli_fetch_array($result3);
					    $fieldarr = array();
					    while ($row = $result3->fetch_assoc()) {
						    array_push($fieldarr,$row['COLUMN_NAME']);
					    }
                    ?>

                    <div class = "specific" id = "specific">
                        <p>Please select a specific field</p>
                        <select name = "specificfield" id = "specificfield" onchange="PostFunction()">
                            <option value="">--Please choose an option--</option>
                            <?php
                            //$arr = array("PHP", "HTML", "CSS", "JavaScript");
                            foreach($fieldarr as $v){
                            ?>
                            <option value="<?php echo strtoupper($v); ?>"><?php echo $v; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
						    if(isset($_SESSION['specificfield1'])){
					    ?>
                            <p>Selected: <?php echo $_SESSION['specificfield1']; ?></p>
                        <?php
						    }
						?>
                    </div>


                    <!-- Function to post the data from the first drop-down list-->
                    <script>
                        function PostFunction(){
                            $(document).ready(function(){
							    var specificfield = $("#specificfield").val();
							    //Make a post request bt AJAX
							    $.post("assets/php/search_field.php", {specificfield: specificfield},function(data){
								    console.log(data)
							    })
						    })
						    window.location.reload()                                              
					    }
                    </script>
                </div>

                <div class="val-box">
                    <!-- Retrive data for the second drop-down list -->
                    <?php
                        if(isset($_SESSION['specificfield1']) & @$_SESSION['specificfield1'] != "" ){
						    $query4 = "SELECT DISTINCT `{$_SESSION['specificfield1']}` FROM `aq_data`";
						    $result4 = $mysqli->query($query4);
						    $row2 = mysqli_fetch_array($result4);
						    $rangearr = array();
						    while ($row2 = $result4->fetch_assoc()) {
							    array_push($rangearr,$row2[$_SESSION['specificfield1']]);
						    }
                        }
                    ?>

				    <div class = "range" id = "range">
					    <p>Please select a range</p>
					    <select name = "ranges" id = "ranges" onchange="PostFunction2()">
						    <option value="">--Please choose an option--</option>
						    <?php
						    if(isset($_SESSION['specificfield1'])){
							    foreach($rangearr as $v2){
								    ?>
								    <option value="<?php echo strtoupper($v2); ?>"><?php echo $v2; ?></option>
								    <?php
							    }
						    }
						    ?>
					    </select>
                        <?php
						    if(isset($_SESSION['ranges1'])){
					    ?>
                            <p>Selected: <?php echo $_SESSION['ranges1']; ?></p>
                        <?php
						    }
						?>
				    </div>
				
				    <!-- Function to post the data from the second drop-down list-->
				    <script>
				    function PostFunction2(){
					    $(document).ready(function(){
						    var ranges = $("#ranges").val();
						    //Make a post request bt AJAX
						    $.post("assets/php/search_range.php", {ranges: ranges},function(data){
							    console.log(data)
						    })	
					    })
				    }
				    </script>
                </div>
                <button type="submit" class="searchbox btn btn-primary btn-sm" id="searchbox">Search</button>
			</div>        
		</form>

		<!-- Piechart and Table-->
        <div class = "charts">
            <div class = "piecharts">
                <?php
                if(@$_SESSION['ranges1'] != ""){
                    echo "<div id=\"piechart\"></div>";
                }
                ?>                
            </div>

            <div class = "table">
                <table>
                    <thead>
                        <tr>
                            <?php
                            if(@$_SESSION['ranges1'] != ""){
                                echo "<td>Name</td>";
                                echo "<td>Percentage</td>";
                            }
                            ?>
                        </tr>
                    </thead>
                        <tr>
                            <?php
                            if(@$_SESSION['ranges1'] != ""){
                                foreach(array_count_values($rangearr) as $x => $val){    
                                    $percentage = $val / $total;
                                    echo "<tr>";
                                    echo "<td>$x</td>";
                                    echo "<td>$percentage</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>  
        </div>



        <!-- Rows and Columns to Display data -->
		<div class="board">
            <div class="scrollable">
			    <table>
				    <thead>
					    <tr>
						    <?php
						    $query3 = "SELECT `COLUMN_NAME` 
						    FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME = 'aq_data'";
						    $result3 = $mysqli->query($query3);
						    $row = mysqli_fetch_array($result3);
						    while ($row = $result3->fetch_assoc()) {
							    echo "<td>{$row['COLUMN_NAME']}</td>";
						    }
						    ?>
					    </tr>
				    </thead>
				    <tbody>
					    <?php                    
					    if(isset($_SESSION['ranges1']) & isset($_SESSION['specificfield1']) ){    
						    @$query5 = "SELECT * FROM `aq_data` WHERE `{$_SESSION['specificfield1']}` = '{$_SESSION['ranges1']}' ORDER BY TRIP_ID ASC";
						    $result5 = $mysqli->query($query5);
                            while ($row3 = $result5->fetch_array(MYSQLI_ASSOC)) {
                                echo "<tr>";
                                echo "<th scope=\"row\">";
                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
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