<?php
    require_once 'headers.php';
    require_once 'vendor/autoload.php';
    header("HTTP/1.1 200 OK");

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    function getID(){
        $headers = getallheaders();
        $jwt_supplied = $headers["authorization"];
        $secretKey = "some_crazy_long_secret_key_I_used";

        $userID = JWT::decode($jwt_supplied, new Key($secretKey, "HS256"))->id;
        return $userID;
    }
?>