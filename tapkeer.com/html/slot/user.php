<?php 

	
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
	
	//creating a query
	$stmt = $conn->prepare("SELECT * from userdb;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($user, $pass);
	
	$result = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['user'] = $user; 
		$temp['pass'] = $pass; 
		array_push($result, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($result);