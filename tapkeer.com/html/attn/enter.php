<?php 

	//$_POST = json_decode(file_get_contents('php://input'), true);
	
	$name = $_POST["name"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$s1 = $_POST["1"];
	$s2 = $_POST["2"];
	$s3 = $_POST["3"];
	$s4 = $_POST["4"];
	$s5 = $_POST["5"];
	$s6 = $_POST["6"];
	$s7 = $_POST["7"];
	$s8 = $_POST["8"];
	$s9 = $_POST["9"];
	$s10 = $_POST["10"];
	$s11 = $_POST["11"];
	$s12 = $_POST["12"];


	
	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'admin');
	define('DB_PASS', 'admin123');
	define('DB_NAME', 'attn');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	$sql = "insert into ledger values('".$name."','".$day."','".$month."','".$year."','".$s1."','".$s2."','".$s3."','".$s4."','".$s5."','".$s6."','".$s7."','".$s8."','".$s9."','".$s10."','".$s11."','".$s12."');"; 
	
	if(mysqli_query($conn,$sql)) {  
		
		$res->result = 1;
		echo json_encode($res);
		
	}  
	else{  
		
		$res->result = 0;
		echo json_encode($res); 
		
	}  
	mysqli_close($con);  
	

?>