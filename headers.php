<?php
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, DELETE");
    header("Access-Conrol-Allow-Credentials: true");
    header("Access-Control-Allow-Origin: *");

    function TestInput($data){
        $data = stripslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
?>