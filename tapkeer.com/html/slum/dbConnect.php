<?php
 define('HOST','localhost');
 define('USER','sanved');
 define('PASS','sanved123');
 define('DB','cnn');
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');