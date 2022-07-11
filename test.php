<!DOCTYPE html>
<?php
session_start();
?>

<html>
<body>
<select id="pid" onchange="myFunction()">

<option grade="1" value="a">Option One</a>

<option grade="2" value="b">Option Two</a>

</select>

<script>
function myFunction() {
     
    (document).ready(function () { {
        var keywords = $("#pid").text();
        
					$.ajax({
						url: "php/searching.php",
						method: "POST",
						data: {	//Data to be submitted
							keywords,
						},
						dataType: "html",

					});
				};
			});
            //alert("Hello");
}
</script>

<?php
if(isset($_SESSION['keywords'])){
    echo $_SESSION['keywords'];
    }
?>

</body>
</html>

