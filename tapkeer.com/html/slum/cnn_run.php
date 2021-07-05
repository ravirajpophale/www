<?php 

echo "hello";

$command = escapeshellcmd('python3 testImage.py');
$output = shell_exec($command);
echo $output;

?>
