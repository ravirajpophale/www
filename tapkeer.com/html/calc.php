<html>
<body>

<form name="form1" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	Num 1 <br><input type="text" name="num1"><br><br>
	Num 2 <br><input type="text" name="num2"><br><br>
	RES <br><input type="text" name="RES" VALUE="<?php if(isset($_POST['+'])) echo calc(1);
							else if(isset($_POST['-'])) echo calc(2);
							else if(isset($_POST['*'])) echo calc(3);
							else if(isset($_POST['/'])) echo calc(4);


						
						 ?>"><br><br>
	<input type="submit" value="+" name="+">
	<input type="submit" value="-" name="-">
	<input type="submit" value="*" name="*">
	<input type="submit" value="/" name="/"><br><br>
	<input type="reset" value="Clear" name="clr">

</form>


<?php

function calc($n){
	$no1=$_POST['num1'];
	$no2=$_POST['num2'];
	switch($n){
		case 1:
			echo $no1+$no2;
		break;
			
		case 2:
			echo $no1-$no2;
		break;
			
		case 3:
			echo $no1*$no2;
		break;
			
		case 4:
			echo $no1/$no2;
		break;
		
	}	
}

if($_SERVER['REQUEST_METHOD']=="POST"){
	
	if($_POST['num1'] =="" || $_POST['num2'] == ""){		
		echo"Text is empty";
	}
	
}

?>

</body>
</html>
