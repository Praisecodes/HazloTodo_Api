<?php
    require_once "headers.php";
    require_once "connection.php";
    require_once "sendemail.php";

    $contents = trim(file_get_contents("php://input"));
    $decoded = json_decode($contents, true);
    $username = TestInput($decoded["username"]);
    $fullname = TestInput($decoded["fullname"]);
    $email = TestInput($decoded["email"]);
    $password = TestInput(md5($decoded["password"]));

    $sql = "INSERT INTO user_info(fullname, username, email, user_password) VALUES(?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $fullname, $username, $email, $password);
    if($stmt->execute()){
        if(WelcomeEmail($email, $username)){
            http_response_code(200);
            exit;
        }
        else{
            http_response_code(201);
            exit;
        }
    }
    else{
        http_response_code(500);
        exit;
    }
?>
