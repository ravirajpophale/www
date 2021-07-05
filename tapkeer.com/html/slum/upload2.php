<?php
    $json = json_decode(file_get_contents('php://input'),true);
 
    $name = $json["name"]; //within square bracket should be same as Utils.imageName & Utils.image
    $image = $json["image"];
 
    $response = array();
 
    $decodedImage = base64_decode("$image");
 
	$name = "temp";
 
    $return = file_put_contents("uploads/".$name.".jpg", $decodedImage);
 
    if($return !== false){
        $response['success'] = 1;
        $response['message'] = "Image Uploaded Successfully";
		$command = escapeshellcmd('python3 testImageForest.py');
		$output = shell_exec($command);
		$response['result'] = $output;
    }else{
        $response['success'] = 0;
        $response['message'] = "Image Uploaded Failed";
    }
 
    echo json_encode($response);
?>