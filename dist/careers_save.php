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
sendMail($sub,$msg);

/*$mail = new PHPMailer;
try {
$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
// $mail->Username = 'rainwebtest@gmail.com';          // SMTP username
// $mail->Password = 'Rain@123'; // SMTP password
$mail->Username = 'rainfundai@gmail.com';          // SMTP username
$mail->Password = 'hiHDu$s42da#'; // SMTP password
$mail->SMTPSecure = 'tsl';                         // Enable TLS encryption,ssl also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('rainfund@rainfund.ai', 'Rain Query');

// $mail->addAddress('hr.goodera@goodera.com');   // Add a recipient
// $mail->addAddress('careers@goodera.com');   // Add a recipient
// $mail->addAddress('richa.bajpai@goodera.com');   // Add a recipient


// $mail->addAddress('varun@lollypop.biz');   // Add a recipientt
$mail->addAddress('raghu@rainfund.ai');   // Add a recipientt
$mail->addAddress('aseem@rainfund.ai');   // Add a recipient
$mail->addAddress('nitin@rainfund.ai');   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

$bodyContent=$msg;

$mail->Subject = $sub;
$mail->Body    = $bodyContent;

echo $query;

if(!$mail->send()) {
	echo ' Message could not be sent.'."Mailer Error: {$mail->ErrorInfo}";
} 
else {
	echo ' Mail has been sent';
}
} catch (Exception $e) {
    echo " Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}*/

function sendMail( $sub, $msg){
    date_default_timezone_set('Asia/Kolkata');
    $tran_date=date('Y-m-d');


    $mail = new PHPMailer;

    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'AKIAJTHWYZKV2RHKFMVA';          // SMTP username
    $mail->Password = 'BJlu7V5tvGPEk7L3fIKer7sg+XJLqBeKspzKBlLlzEm3'; // SMTP password
    $mail->SMTPSecure = 'tsl';                         // Enable TLS encryption,ssl also accepted
    $mail->Port = 587;                                 // TCP port to connect to

    // set priority; For most clients expecting the Priority header:
    // 1 = High, 2 = Medium, 3 = Low
    $mail->Priority = 1;
    // MS Outlook custom header
    // May set to "Urgent" or "Highest" rather than "High"
    $mail->AddCustomHeader("X-MSMail-Priority: High");
    // Not sure if Priority will also set the Importance header:
    $mail->AddCustomHeader("Importance: High");

    /* // add different reply-to
    $mail->ClearReplyTos();
    $mail->addReplyTo('support@rainfund.ai', 'Rain Technologies');*/
    $mail->setFrom('support@rainfund.ai', 'Rain Technologies');

    // $mail->addAddress($to);   // Add a recipientt
    $mail->addAddress('raghu@rainfund.ai');   // Add a recipient
	$mail->addAddress('aseem@rainfund.ai');   // Add a recipient
	$mail->addAddress('nitin@rainfund.ai');   // Add a recipient

    $mail->isHTML(true);  // Set email format to HTML

    $bodyContent=$msg;

    $mail->Subject = $sub;
    $mail->Body    = $bodyContent;

    // echo $query;

    if(!$mail->send()) {
        return false;
    } 
    // var_dump($mail);
    
    return true;
}


?>