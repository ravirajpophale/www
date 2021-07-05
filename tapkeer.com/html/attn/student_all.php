<?php 

	$year = $_POST["year"];
	$student = $_POST["student"];
	
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
	
	//creating a query
	$stmt = $conn->prepare("SELECT * from ledger where year='".$year."';");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($name, $day, $month, $year, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11, $s12);
	
	$result = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['name'] = $name; 
		$temp['day'] = $day; 
		$temp['month'] = $month; 
		$temp['year'] = $year; 
		$temp['s1'] = $s1; 
		$temp['s2'] = $s2; 
		$temp['s3'] = $s3; 
		$temp['s4'] = $s4; 
		$temp['s5'] = $s5; 
		$temp['s6'] = $s6; 
		$temp['s7'] = $s7; 
		$temp['s8'] = $s8; 
		$temp['s9'] = $s9; 
		$temp['s10'] = $s10; 
		$temp['s11'] = $s11; 
		$temp['s12'] = $s12; 
		array_push($result, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($result);
	
?>