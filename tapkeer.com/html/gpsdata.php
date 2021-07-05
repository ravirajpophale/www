<?php  
$lat = $_POST["lat"];  
$longg = $_POST["longg"];  
$time = $_POST["time"];  
$user = "root";  
$password = "ILgta77!@#";  
$host ="localhost";  
$db_name ="gpsdata";  
$con = mysqli_connect($host,$user,$password,$db_name);  
$sql = "insert into gpsvals values('".$lat."','".$longg."','".$time."', 'mh12jv8841');";  
if(mysqli_query($con,$sql))  
{  
    echo "Data inserted successfully....";  
}  
else   
{  
    echo "some error occured";  
}  
mysqli_close($con);  
?> 
