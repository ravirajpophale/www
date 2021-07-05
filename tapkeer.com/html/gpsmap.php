<?php  

	session_start();

	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	  header("location: gpslogin.php");
	  exit;
	}
	
	$user = "root";  
	$password = "ILgta77!@#";  
	$host ="localhost";  
	$db_name ="gpsdata";  

	$con = mysqli_connect($host,$user,$password,$db_name);  
	
	echo"
	<html>
	  <head>
		<style>
		  #map {
			height: 400px;
			width: 100%;
		   }
		</style>
	  </head>
	  <body>
		<h3>Hello ". $_SESSION['username'] .". GPS Car Beacon</h3>
		<div id='map'></div>
		
		<script>
		  function initMap() {
			var uluru = {lat: 18.537988, lng: 73.8346178};
			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 15,
			  center: uluru
			});";
			
			
			$sql2 = "select * from gpsvals";
	
			if ($result=mysqli_query($con,$sql2)){
				$ctr = 1;
				while ($row=mysqli_fetch_assoc($result)){
					$lat = $row['lat'];
					$longg = $row['longg'];
				
					if($ctr!=1){echo"
					var uluru".$ctr." = {lat: ".$lat.", lng: ".$longg."};
					var marker".$ctr." = new google.maps.Marker({
					position: uluru".$ctr.",
					map: map
					});";}
				
					$ctr++;
				}
				mysqli_free_result($result);
			}else {
				echo "No matching records are found.";
			}
			
		  echo"
		  }
		  </script>
		  <script async defer
		src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAczk19RYIl-HnPOSHeXWErO5ATdZDCwwo&callback=initMap'>
		</script>
	  </body>
	</html>";

	mysqli_close($con); 

?> 

