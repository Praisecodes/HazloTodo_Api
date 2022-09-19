<?php
    require_once "vendor/autoload.php";

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\OAuth;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use League\OAuth2\Client\Provider\Google;

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->AuthType = "XOAUTH2";

    $sender_email = "hazlotodoapp@gmail.com";
    $clientId = "";
    $clientSecret = "";
    $refreshToken = "";

    $provider = new Google([
        'clientId' => $clientId,
        'clientSecret' => $clientSecret
    ]);

    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $sender_email
            ]
        )
    );

    $mail->setFrom($sender_email, "Hazlo Todo");

    function WelcomeEmail($receiver_email, $usersname){
        global $mail;
        $mail->addAddress($receiver_email);
        $mail->Subject = "Welcome " . $usersname . "!!";
        $mail->Body = "Welcome To The Club " . $usersname . "<br/> We're happy to have you";
        if(!$mail->send()){
            return false;
        }
        else{
            return true;
        }
    }
?>