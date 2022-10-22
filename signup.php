<?php
    require_once "headers.php";
    require_once "connection.php";
    require_once "sendemail.php";

    $contents = trim(file_get_contents("php://input"));
    $decoded = json_decode($contents, true);
    $username = TestInput($decoded["username"]);
    $fullname = TestInput($decoded["fullname"]);
    $email = TestInput($decoded["email"]);
    $password = TestInput(password_hash($decoded["password"], PASSWORD_DEFAULT));

    if(!empty($fullname) && !empty($username) && !empty($email) && !empty($password)){
        $sql = 'SELECT * FROM `user_info` WHERE username=? OR email=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $email);
        if($stmt->execute()){
            $results = $stmt->get_result();
            if($results->num_rows > 0){
                http_response_code(304);
                exit;
            }
            else{
                $sql = "INSERT INTO user_info(fullname, username, email, user_password) VALUES(?,?,?,?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssss', $fullname, $username, $email, $password);
                if($stmt->execute()){
                    if(WelcomeEmail($email, $username)){
                        http_response_code(200);
                        $stmt->close();
                        $conn->close();
                        exit;
                    }
                    else{
                        http_response_code(201);
                        $stmt->close();
                        $conn->close();
                        exit;
                    }
                }   
                else{
                    http_response_code(500);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
            }
        }
        else{
            http_response_code(500);
            exit;
        }
    }
    else{
        exit;
    }
?>
