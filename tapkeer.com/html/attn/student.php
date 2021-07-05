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
	$stmt = $conn->prepare("SELECT s".$student." from ledger where year='".$year."';");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($data);
	
	$i = 0;
	$present = 0;
	$absent = 0;
	
	//traversing through all the result 
	while($stmt->fetch()){
		if($data == "A"){
			$absent++;
		}
		if($data == "P"){
			$present++;
		}
		$i++;
	}
	
	if($i > 0){
		$res->result = 1;
		$res->present = $present;
		$res->absent = $absent;
		echo json_encode($res);
	}else{
		$res->result = 0;
		echo json_encode($res);
	}
	
?>