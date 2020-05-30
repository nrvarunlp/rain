<?php
require "../PHPMailer/PHPMailerAutoload.php";


$errors = array(); // array to hold validation errors
$data   = array(); // array to pass back data
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['name']));
    $email   = stripslashes(trim($_POST['email']));
    $phone   = preg_replace('/[^0-9]/', '', stripslashes(trim($_POST['phone'])));
    $message = stripslashes(trim($_POST['message']));
	// Configure your Subject Prefix and Recipient here
	$subject = "SoQ Query - $name";
	$to       = 'support@rainfund.ai';	
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }
    if (empty($phone)) {
        $errors['phone'] = 'Phone is invalid.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is invalid.';
    }
    if (empty($subject)) {
        $errors['subject'] = 'Subject is required.';
    }
    if (empty($message)) {
        $errors['message'] = 'Message is required.';
    }
    // if there are any errors in our errors array, return a success boolean or false
    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $msg    = '
            <strong>Name: </strong>'.$name.'<br />
            <strong>Phone: </strong>'.$phone.'<br />
            <strong>Email: </strong>'.$email.'<br />
            <strong>Message: </strong>'.nl2br($message).'<br />
        ';
        if (sendMail($to, $subject, $msg)) {
			$data['success'] = true;
			$data['message'] = 'Congratulations. Your message has been sent successfully';
         }else{
			$data['success'] = false;
			$data['message'] = 'Something went wrong. Please reach us on support@rainfund.ai';
         }
    }
    // return all our data to an AJAX call
    echo json_encode($data);
}



function sendMail($to, $sub, $msg){
	date_default_timezone_set('Asia/Kolkata');
	$tran_date=date('Y-m-d');

	/*$msg = "<strong>You have received a new query from as below - </strong><br/><br/><br/>";
		$msg .= '<strong>Name :   </strong>'. $fullname ."<br><br/>";
		$msg .= '<strong>Email :   </strong>'. $email ."<br><br/>";
		$msg .= '<strong>Phone :   </strong>'. $phone ."<br><br/>";
		$msg .= '<strong>Query :   </strong>'. $query ."<br><br/>";*/

	$mail = new PHPMailer;

	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'rainwebtest@gmail.com';          // SMTP username
	$mail->Password = 'Rain@123'; // SMTP password
	$mail->SMTPSecure = 'tsl';                         // Enable TLS encryption,ssl also accepted
	$mail->Port = 587;                                 // TCP port to connect to

	$mail->setFrom('rainfund@rainfund.ai', 'RainFund');

	$mail->addAddress($to);   // Add a recipientt
	// $mail->addAddress('param@rainfund.ai');   // Add a recipient

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent=$msg;

	$mail->Subject = $sub;
	$mail->Body    = $bodyContent;

	// echo $query;

	if(!$mail->send()) {
		return false;
	} 
	
	return true;
}