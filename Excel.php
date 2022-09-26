<!--
Excel Page for Environmental Data Analysis Tool
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
    <title>Excel</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/excel.css" />

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
        <h3 class="i-name">Excel Import and Export</h3>
        
        <div class="values">

            <!-- Export -->
            <div class="val-box">
                <div class="row">
                    <h3>Excel Export</h3>
                    <div class="input-row">
                    <p/ ><p/ ><br>
                        <div class="export">
                            <form action="assets/php/export.php">
                                <input type="submit" name="submit" class="btn-submit" value="Export Data" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import -->
            <div class="val-box">
                <div class="row">
                    <h3>Excel Import</h3>
                    <form class="form-horizontal" action="assets/php/import.php" method="post" id="importcsv" enctype="multipart/form-data">
                        <div class="input-row">
                            <input type="file" name="import_csv" id="import_csv" class="file" accept=".csv"/>
                            <button type="submit" name="submit" value="submit" class="btn-submit">Import Data</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Guide -->
            <div class="val-box">
                <div class="row">
                    <h3>Excel Import and Export Guide</h3>
                    <p>Accepted file type for import is ".csv" only</p>
                    <p>Exports will be also be of ".csv" file type.</p>
                </div>
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

    <!-- Import Function -->
    <script>  
	    $(document).ready(function(){  
		    $('#importcsv').on("submit", function(e){
                e.preventDefault();             //form will not submitted 
			    $.ajax({  
				    url:"assets/php/import.php",  
				    method:"POST",  
				    data:new FormData(this),  
				    contentType:false,          // The content type used when sending data to the server.  
				    cache:false,                // To unable request pages to be cached  
				    processData:false,          // To send DOMDocument or non processed data file it is set to false  
				    success: function (response) {  
					    if(response.trim() == "Success!")  
					    {  
						    alert("CSV file data has been imported!");  
						    $('#importcsv')[0].reset();                     //Resets the form for new submissions
					    }  
					    else  
					    {  
                            alert("Error: Please check CSV file");
					    }  
				    }  
			    })  
		    });  
	    });  
    </script>
</body>
</html>

