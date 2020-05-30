<?php
require "./connection.php";
require "../PHPMailer/PHPMailerAutoload.php";

// for jwt token generation
require_once '../php-jwt-5.0.0/src/JWT.php';
use \Firebase\JWT\JWT;

$jwt_secret_key = "5hM2408fUC1Bdlji52ML";
define('DAY_IN_SECONDS', 86400);

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
    /*if (empty($message)) {
        $errors['message'] = 'Message is required.';
    }*/
    // if there are any errors in our errors array, return a success boolean or false
    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        if (sendVerificationEmail($name, $phone, $email)) {
            $data['success'] = true;
            $data['message'] = 'Please click on the link sent to your email to confirm your seat! (check your spam folder)';
         }else{
            $data['success'] = false;
            $data['message'] = 'Something went wrong. Please reach us on support@rainfund.ai';
         }
    }
    // return all our data to an AJAX call
    echo json_encode($data);
}


function sendVerificationEmail($name, $phone, $email)
{
    global $conn;
    // insert in db
    $query="INSERT INTO `webinar_registrations` (`name`, `phone`, `email`, `verified`)
            VALUES ('$name', '$phone', '$email', false)";
    $id = 0;
    if ($conn->query($query) === TRUE) {
        $id = $conn->insert_id;
    }

    // create verification link
    $jwt_token = createJWT(['email'   => $email, 'phone' => $phone, 'name' => $name, 'id' => $id ]);
    $link = 'https://rainfund.ai/schoolofquant/email-verify.php?token='.$jwt_token;
    // subject
    $sub = 'Welcome to Rain Technologies';
    // body
    $msg = "Hi $name,<br/><br/><br/>";
    $msg .= 'Welcome to Rain Technologies. Please click on the following link to confirm your seat<br>';
    $msg .= "<a href=\"$link\">$link</a><br/>";
    // send verification email to user
    return sendMail($email, $sub, $msg);
}

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

function createJWT($data)
{
    global $jwt_secret_key;
    $login_time = time();
    $expires = $login_time + DAY_IN_SECONDS*7;  // expires in a week
    $token = array(
        "iat" => $login_time,
        "exp" => $expires,
        "iss" => 'https://rainfund.ai/',
        'data' => $data
    );

    return JWT::encode($token, $jwt_secret_key);
}