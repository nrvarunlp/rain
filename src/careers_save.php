<?php
/*include_once 'db.php';*/
// $sPATH="";

// include_once 'SendEMail.php';

require "./PHPMailer/PHPMailerAutoload.php";


$fullname=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$query=$_POST['query'];


date_default_timezone_set('Asia/Kolkata');
$tran_date=date('Y-m-d');

// if (!file_exists('uploads/careers')) {
// 	mkdir('uploads/careers', 0777, true);
// }
 
// move_uploaded_file($_FILES["file"]["tmp_name"],
// "uploads/careers/" . $_FILES["file"]["name"]);

// $resume=$_FILES['file']['name'];
// $link="http://13.126.31.120/uploads/careers/".$resume;

$msg = "<strong>You have received a new query from as below - </strong><br/><br/><br/>";
// $msg .= '<strong>Name :   </strong>'. $fullname ."<br><br/>";
$msg .= '<strong>Name :   </strong>'. $fullname ."<br><br/>";
$msg .= '<strong>Email :   </strong>'. $email ."<br><br/>";
$msg .= '<strong>Phone :   </strong>'. $phone ."<br><br/>";
$msg .= '<strong>Query :   </strong>'. $query ."<br><br/>";

$sub='Rain query';
$receiver_email='';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rainwebtest@gmail.com';          // SMTP username
$mail->Password = 'Rain@123'; // SMTP password
$mail->SMTPSecure = 'tsl';                         // Enable TLS encryption,ssl also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('rainfund@rainfund.ai', 'Rain Query');

// $mail->addAddress('hr.goodera@goodera.com');   // Add a recipient
// $mail->addAddress('careers@goodera.com');   // Add a recipient
// $mail->addAddress('richa.bajpai@goodera.com');   // Add a recipient


$mail->addAddress('param@lollypop.biz');   // Add a recipientt
$mail->addAddress('raghu@rainfund.ai');   // Add a recipientt
$mail->addAddress('aseem@rainfund.ai');   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

$bodyContent=$msg;

$mail->Subject = $sub;
$mail->Body    = $bodyContent;

echo $query;

if(!$mail->send()) {
	echo 'Message could not be sent.';
} 
else {
	echo 'Mail has been sent';
}


?>