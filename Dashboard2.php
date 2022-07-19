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
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

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

        <?php
            include('assets/php/get_data.php');
        ?>

        <!-- Searching -->
        <form class="row g-3 needs-validation" action="" method="post" >
            <div class = "values">
                <div class = "keyword" id= "keyword">
                    <input type="keywords" class="form-control shadow-none" id="keywords" name="keywords" placeholder="Please enter the keyword">
                    <button type="submit" class="searchbox btn btn-primary btn-sm" id = "searchbox">Search</button>
                </div>


                <!-- Retrive data for the first drop-down list -->
                <?php
					$query3 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME = 'clientdata'";
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
                </div>


                <!-- Function to post the data from the first drop-down list-->
                <script>
                    function PostFunction(){
                        $(document).ready(function(){
							var specificfield = $("#specificfield").val();
							//Make a post request bt AJAX
							$.post("php/searching.php", {specificfield: specificfield},function(data){
								console.log(data)
							})
						})
						window.location.reload()                                              
					}
                </script>

                
                <?php
                    //Retrive data for the second drop-down list
                    if(isset($_SESSION['specificfield1']) & @$_SESSION['specificfield1'] != "" ){
						$query4 = "SELECT DISTINCT `{$_SESSION['specificfield1']}` FROM `clientdata`";
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
				</div>
				
				<!-- Function to post the data from the second drop-down list-->
				<script>
				function PostFunction2(){
					$(document).ready(function(){
						var ranges = $("#ranges").val();
						//Make a post request bt AJAX
						$.post("php/SearchRange.php", {ranges: ranges},function(data){
							console.log(data)
						})	
					})
				}
				</script>
			</div>
        
			<!-- Data visuilization-->
			<div class = "visualization" id = "visualization" >
				<?php
				if(@$_SESSION['ranges1'] != ""){
					echo "<div id=\"piechart\" style=\"width: 50%; height: 90%;\"></div>";
					echo "<div id=\"piechart2\" style=\"width: 50%; height: 90%;\"></div>";
				}
				?>              
			</div>
		</form>

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

		<div class="board">
			<table width="100%">
				<thead>
					<tr>
						<?php
						$query3 = "SELECT `COLUMN_NAME` 
						FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_NAME = 'clientdata'";
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
						@$query5 = "SELECT * FROM `clientdata` WHERE `{$_SESSION['specificfield1']}` = '{$_SESSION['ranges1']}' ";
						$result5 = $mysqli->query($query5);
						while ($row3 = $result5->fetch_array(MYSQLI_ASSOC)) {
							echo "<td >";
							echo $row3['TRIP_ID'];
							echo "</td>";
							echo "<td >";
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