<?php

/*
This is usage example
 GET ?generate
 GET ?token=12345
*/


error_reporting(E_ALL);
ini_set('display_errors', '1');

require('tokenator.php');

Tokenator::$DB_host = '127.0.0.1';
Tokenator::$DB_user = 'root';
Tokenator::$DB_pass = 'password';
Tokenator::$DB_name = 'tokenator';

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