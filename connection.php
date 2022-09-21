<?php
    // $conn = new mysqli('localhost', 'root', '', 'hazlodb');

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);

    $conn = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    if($conn->connect_error){
        die("error!");
    }

?>