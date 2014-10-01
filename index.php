<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('tokenator.php');

if(isset($_GET['generate'])){
	$apikey = "TEST_APIKEY";
	$userid = "TEST_USERID";
	$token = Tokenator::generate($apikey, $userid);
  	echo $token;
}else if(isset($_GET['token'])){
	$token = $_GET['token'];
	$valid = Tokenator::validate($token);
	if($valid){
		echo "Token is valid!";
		print_r($valid);
	}else{
		echo "Token not valid";
	}
}else{
	echo "Nothing to do.";
}

?>