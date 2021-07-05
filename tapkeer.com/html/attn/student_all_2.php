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
	
	$j = 0;
	$bigArr = array();
	
	for($j = 1; $j< 13; $j++){
	//creating a query
		$stmt = $conn->prepare("SELECT s".$j." from ledger where year='".$year."';");
		
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
		}
		
		$temp["present".$j] = $present; 
		$temp["absent".$j] = $absent; 
		
		if($j == 12)array_push($bigArr, $temp);
	
	}
	
	echo json_encode($bigArr);
	
?>