<?php
    $conn = new mysqli('localhost', 'root', '', 'hazlodb');
    if($conn->connect_error){
        http_response_code(500);
        exit;
    }
    
?>