<?php
// forcing browser not to cache; response type json
header("Access-Control-Allow-Origin: rainfund.ai");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
header('Content-Type: application/json');

date_default_timezone_set('Asia/Kolkata');


// First, include Requests
require_once './razorpay-php/Razorpay.php';

// Next, make sure Requests can load internal classes
use Razorpay\Api\Api;
Requests::register_autoloader();

// $id = $_POST['razorpay_payment_id'];

$id = preg_replace("/[^0-9A-Za-z_]+/", "", $_POST['razorpay_payment_id']);

if (empty($id)) {
	// return 401
	http_response_code(401);
	echo '{"status": "error", "message": "id not found"}';
	die();
}

$amount = 1450000;	// amount in paise

/*$api_key = "rzp_test_I2ymLszr6L1E8Z";	// test key
$api_secret = "FcpTsm2tjMWyuqKMTN37gqnC";*/
$api_key = "rzp_live_CFDShpkrgvuvxb";		// live key
$api_secret = "gexZcoHTY1xHkAS0g5lA3QcI";

// rzp_live_CFDShpkrgvuvxb,gexZcoHTY1xHkAS0g5lA3QcI 		// live key
// rzp_test_I2ymLszr6L1E8Z,FcpTsm2tjMWyuqKMTN37gqnC			// test key




$api = new Api($api_key, $api_secret);
$api->payment->fetch($id)->capture(array(amount=>$amount)); // Captures a payment
$payment = $api->payment->fetch($id); // Returns a particular payment
$status = $payment->status;


if ($status=='captured') {
	$clientEmail = $payment->email;
	$clientNumber = $payment->contact;
	$clientNumber = preg_replace("/[^0-9]+/", "", $clientNumber);
	// captured
	// insert in db
	// send response 200
	http_response_code(200);
	echo '{"status": "success", "message": "Payment captured successfully"}';
	die();
}

http_response_code(403);
echo '{"status": "error", "message": "Error occured, please contact us at support@rainfund.ai"}';
die();

?>