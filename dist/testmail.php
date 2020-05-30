<?php
// require "./connection.php";
require "./PHPMailer/PHPMailerAutoload.php";

// for jwt token generation
// require_once './php-jwt-5.0.0/src/JWT.php';
// use \Firebase\JWT\JWT;

$jwt_secret_key = "5hM2408fUC1Bdlji52ML";
define('DAY_IN_SECONDS', 86400);

$errors = array(); // array to hold validation errors
$data   = array(); // array to pass back data
sendMail('nitin@rainfund.ai','testMail','testMail sent');




function sendMail($to, $sub, $msg){
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

    $mail->addAddress($to);   // Add a recipientt

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

