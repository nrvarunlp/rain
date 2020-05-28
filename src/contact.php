<?php
    require_once './PHPMailer/PHPMailerAutoload.php';


    if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['company']) && isset($_POST['message'])){

        $name = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $company = isset($_POST['company']) ? $_POST['company'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        $result['success'] = false;
        $result['message'] = "Error Sending Email.";

        if(!empty($name) && !empty($email)&& !empty($company) && !empty($message)){
            $msg = "You have received a new query from Goodera as below- <br/><br/>";
            $msg .= 'Name: '. $name ."<br>";
            $msg .= 'Email: '. $email ."<br>";
            $msg .= 'Company Name: '. $company ."<br>";
            $msg .= 'Contact Number: '. $telephone ."<br>";
            $msg .= 'Message: '. $message ."<br>";

            $phpmailer = new PHPMailer();
            $phpmailer->CharSet = 'UTF-8';
            
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.gmail.com';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = 'gooderaweb@gmail.com';
            $phpmailer->Password = 'Goodera_123';
            $phpmailer->SMTPSecure = 'tls';
            $phpmailer->Port = 587;
            
            $phpmailer->SetFrom("brand@goodera.com", "Goodera");

            // $phpmailer->AddAddress('Kaushik.arun@nextgenpms.com');
            // $phpmailer->AddAddress('richa.bajpai@goodera.com');
            $phpmailer->AddAddress('maleeha.mukhtar@goodera.com');

            $phpmailer->AddAddress('varun@lollypop.biz');
            
            $phpmailer->Subject = "Contact Query";
            $phpmailer->MsgHTML($msg);

            if(!$phpmailer->Send()) {
                $result['success'] = false;
                $result['message'] = "Failed to send Email.";
            }else{            
                $result['success'] = true;
                $result['message'] = 'Thanks for the Contacting  us.Our team will get in touch with you as early as possible.';
            }
        }else{
            $result['success'] = false;
            $result['message'] = 'Please fill all fields with valid data.';
        }
        echo json_encode($result);
        exit;
    }
?>



