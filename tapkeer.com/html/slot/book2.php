<?php 

	//$_POST = json_decode(file_get_contents('php://input'), true);
	
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$slot = $_POST["slot"];
	
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
	
	$stmt = $conn->prepare("SELECT * from booking where slot=".$slot." and day=".$day." and month=".$month." and year=".$year.";");
	
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($day2, $month2, $year2, $slot2);
	
	$result = array(); 
	
	$i = 0;
	
	while($stmt->fetch()){
		$temp = array();
		$temp['day'] = $day2; 
		$temp['month'] = $month2; 
		$temp['year'] = $year2; 
		$temp['slot'] = $slot2; 
		array_push($result, $temp);
		$i++;
	}
	
	if($i > 0){
		$res->result = 0;
	}else{
		$res->result = 1;
	}
	
	$resJ = json_encode($res);
	
	echo json_encode($result);

?>