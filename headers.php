<?php
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, DELETE");
    header("Access-Conrol-Allow-Credentials: true");

    function TestInput($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        
        return $data;
    }
?>