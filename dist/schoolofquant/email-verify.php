<?php 
require "./connection.php";
require_once '../php-jwt-5.0.0/src/JWT.php';

use \Firebase\JWT\JWT;
$jwt_secret_key = "5hM2408fUC1Bdlji52ML";

$jwt_token = $_GET['token'];
if (! preg_match("/[A-Za-z0-9\-\._~\+\/]+=*/", $jwt_token)) {
	echo "Something went wrong(Error code #231). Please reach us on support@rainfund.ai";
	die();
}

try {
	$decoded = JWT::decode($jwt_token, $jwt_secret_key, array('HS256'));
	$name = $decoded->data->name;
	$email = $decoded->data->email;
	$phone = $decoded->data->phone;
	$id = $decoded->data->id;
	if ($id) {
		// update if data already exists
		$query="UPDATE `webinar_registrations` SET `verified`=TRUE WHERE `id`=$id";
		echo "Congratulations! Your seat has been reserved. We would send you the joining link before the webinar.";
	}else{
		// insert otherwise
		$query="INSERT INTO `webinar_registrations` (`name`, `phone`, `email`, `verified`)
            VALUES ('$name', '$phone', '$email', false)";
		echo "Congratulations! Your seat has been reserved. We would send you the joining link before the webinar.";
	}
	$conn->query($query);
} catch (Exception $e) {
	echo "Something went wrong(Error code #232). Please reach us on support@rainfund.ai";	
}

?>