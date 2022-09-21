<?php
    require_once "vendor/autoload.php";
    require_once "emailbody.php";

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
    $clientId = "464344199134-p14jtpa6t8uje8nmdbtec1nc0h19di7t.apps.googleusercontent.com";
    $clientSecret = "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";
    $refreshToken = "1//04HsofFekNHXyCgYIARAAGAQSNwF-L9IrTh3p8a3CjQ75RdlmUuX5SrQa6Fo13nc4qviY9FOG5FmsohFMdZS8fxi6sqt5bmzzAbY";

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
        $mail->msgHTML(Welcome($usersname), __DIR__);
        if(!$mail->send()){
            return false;
        }
        else{
            return true;
        }
    }
?>