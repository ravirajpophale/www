<?php 

	/*
	* Created by Belal Khan
	* website: www.simplifiedcoding.net 
	* Retrieve Data From MySQL Database in Android
	*/
	
	//database constants
	define('DB_HOST', 'localhost');
	define('DB_USER', 'rohan');
	define('DB_PASS', 'rohanisgay');
	define('DB_NAME', 'gpsdata');
	
	//connecting to database and getting the connection object
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query
	$stmt = $conn->prepare("SELECT * from gpsvals;");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($lat, $longg, $time, $vehicle);
	
	$result = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){
		$temp = array();
		$temp['lat'] = $lat; 
		$temp['longg'] = $longg; 
		$temp['time'] = $time; 
		$temp['vehicle'] = $vehicle; 
		array_push($result, $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($result);