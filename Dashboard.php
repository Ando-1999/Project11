<!DOCTYPE html>


<?php
session_start();
?>

<?php
include("php/db_conn.php");
$query = "SELECT * FROM abalone";
$result = $mysqli->query($query);
$query2 = "SELECT * FROM abalone2";
$result2 = $mysqli->query($query2);


@$content = $_SESSION["content"];
?>

<html lang="en">
    <head>	
        <title>Environmental Data Analysis Tool</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dashboard.css">
		    
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>

		<!-- jQuery -->
		<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
            

        <style>
	        /*Nothing needed here yet...*/
        </style> 

        <!-- Pie Chart -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
        </script>
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
    <!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="">Environment Tool</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Data Analysis</a>
                        </li>
                        
                        <li class="nav-item">
                            <?php
                            if (!isset($_SESSION['session_access'])) {
                                echo "";
                            } elseif ($_SESSION['session_access'] == '1') {
                            ?>
                                <a class="nav-link" href="accountpage_client.php">Your Account</a>
                            <?php
                            } 
                            ?>
                        </li>

                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['session_access'])) {
                                //echo "<script type=\"text/javascript\">alert(\"You have successfully logged out\");</script>";
                                echo "<a class=\"nav-link\"  href=\"php/signout.php\" id=\"loginbutton\">Logout</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Navigation Bar--> 


        <!-- Searching -->
        <form class="row g-3 needs-validation" action="" method="post" >
            <div class = "search" id = "search">
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

        <div class = "display" id = "display" >
            <div class="table">
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
        </div>
        </form>



    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer
    ></script>

    	
    <!-- Ajax for Searching -->
    	
            <script>
			$(document).ready(function () {
				$("#searchbox").click(function () {
                    window.location.reload()					
				});
			});
		    </script>

    

    <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        const uluru = { lat: -25.344, lng: 131.031 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: uluru,
            });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }

        window.initMap = initMap;
    </script>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>
       

    </body>
</html>