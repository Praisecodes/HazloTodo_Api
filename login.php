<?php
    require_once "vendor/autoload.php";
    require_once "headers.php";
    require_once "connection.php";

    use Firebase\JWT\JWT;

    $contents = trim(file_get_contents("php://input"));
    $decoded_contents = json_decode($contents, true);

    $username = TestInput($decoded_contents["username"]);
    $password = TestInput($decoded_contents["password"]);

    if (empty($username) || empty($password)) {
      http_response_code(400);
      exit;
    }


    $sql = "SELECT id, user_password FROM `user_info` WHERE username=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);

    $execVar = $stmt->execute();
    $results = $stmt->get_result();

    if ($results->num_rows === 0) {
      http_response_code(400);
      $stmt->close();
      $conn->close();
      exit;
    }

    $resultsData = $results->fetch_assoc();
    $recordValues = [...$resultsData];

    $mainPassword = $recordValues['user_password'];
    $userID = $recordValues["id"];

    $passwordIsVerified = password_verify($password, $mainPassword);

    if (!$passwordIsVerified) {
      http_response_code(403);
      $stmt->close();
      $conn->close();
      exit;
    }

    http_response_code(200);
    $secretKey = "some_crazy_long_secret_key_I_used";
    $payload = [
        'iss'=>'hazloapi.herokuapp.com',
        'iat'=>time(),
        'exp'=>time()+10000,
        'user_id'=>$userID
    ];

    $jwt = JWT::encode($payload, $secretKey, "HS256");
    echo json_encode([
        "token: ".$jwt
    ]);
    
    $stmt->close();
    $conn->close();
    exit;
?> 