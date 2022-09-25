<?php
    require_once "vendor/autoload.php";
    require_once "headers.php";
    require_once "connection.php";

    use Firebase\JWT\JWT;

    $contents = trim(file_get_contents("php://input"));
    $decoded_contents = json_decode($contents, true);

    $username = (!empty(TestInput($decoded_contents["username"]))?TestInput($decoded_contents["username"]):null);
    $password = (!empty($decoded_contents["password"]) ? TestInput(md5($decoded_contents["password"])) : null);
    $userID;
    $mainPassword;

    if(!empty($username) && !empty($password)){
        $sql = "SELECT id, user_password FROM `user_info` WHERE username=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        if($stmt->execute()){
            $results = $stmt->get_result();
           if($results->num_rows > 0){
                while($row = $results->fetch_assoc()){
                    $mainPassword = $row["user_password"];
                    $userID = $row["id"];
                }
                if(!($password !== $mainPassword)){
                    http_response_code(200);
                    $secretKey = "some_crazy_long_secret_key_I_used";
                    $payload = [
                        'iss'=>'https://hazloapi.herokuapp.com/login.php',
                        'iat'=>time(),
                        'id'=>$userID
                    ];
                    $jwt = JWT::encode($payload, $secretKey, "HS256");
                    echo json_encode([
                       $jwt
                    ]);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
                else{
                   http_response_code(403);
                   $stmt->close();
                   $conn->close();
                   exit;
               }
            }
           else{
                http_response_code(404);
                $stmt->close();
                $conn->close();
            }
        }
        else{
            http_response_code(500);
           $stmt->close();
           $conn->close();
            exit;
        }
    }
?>