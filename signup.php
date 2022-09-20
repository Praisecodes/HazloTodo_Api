<?php
    require_once "headers.php";
    require_once "connection.php";
    require_once "sendemail.php";

    $contents = trim(file_get_contents("php://input"));

    $decoded_contents = json_decode($contents, true);
    $fullname = TestInput($decoded_contents["fullname"]);
    $username = TestInput($decoded_contents["username"]);
    $email = TestInput($decoded_contents["email"]);
    $password = TestInput(md5($decoded_contents["password"]));

    $sql = "INSERT INTO `user_info` (fullname, username, email, user_password) VALUES(?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $fullname, $username, $email, $password);
    if($stmt->execute()){
        if(WelcomeEmail($email, $username)){
            http_response_code(200);
        }
        else{
            http_response_code(201);
        }
        exit;
    }
    else{
        http_response_code(500);
        exit;
    }
?>