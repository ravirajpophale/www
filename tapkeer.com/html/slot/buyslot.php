<?php  
	
	$day = $_POST["day"];  
	$month = $_POST["month"];  
	$year = $_POST["year"];  
	$slot = $_POST["slot"];  
	$game = $_POST["game"]; 
	
	$user = $_POST["user"]; 
	
	$cardno = $_POST["cardno"];
	$cardname = $_POST["cardname"];  
 

	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'rohanm');
	define('DB_PASS', 'rohanm123');
	define('DB_NAME', 'slot');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$sql = "insert into booking values(".$day.",".$month.",".$year.",".$slot.", ".$game.",'".$user."');";  
	$sql2 = "insert into orders values('".$user."','".$cardno."','".$cardname."')";  
	if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql2)) {  
		
		$res->result = 1;
		echo json_encode($res);
		
	}  
	else{  
		
		$res->result = 0;
		echo json_encode($res); 
		
	}  
	mysqli_close($con);  
?> 
