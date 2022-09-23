<?php
    require_once './getjwt.php';
    require_once 'connection.php';
    require_once 'vendor/autoload.php';

    $data = array();
    $i = 0;

    $sql = "SELECT username FROM `user_info` WHERE id=?;";
    $username = "";
    $user_id = getID();
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $username = $row["username"];
            }
            $sql = "SELECT * FROM `activities` WHERE username=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            if($stmt->execute()){
                $results = $stmt->get_result();
                if($results->num_rows > 0){
                    while($rows = $results->fetch_assoc()){
                        $data[$i]["ActivityTitle"] = $rows["ActivityTitle"];
                        $data[$i]["ActivityCategory"] = $rows["ActivityCategory"];
                        $data[$i]["ActivityStartTime"] = $rows["ActivityStartTime"];
                        $data[$i]["ActivityDueTime"] = $rows["ActivityDueTime"];
                        $data[$i]["ActivityImage"] = $rows["ActivityImage"];
                        $data[$i]["ActivityNote"] = $rows["ActivityNote"];
                        $data[$i]["isArchived"] = $rows["isArchived"];
                        $data[$i]["isStarred"] = $rows["isStarred"];
                        $data[$i]["inTrash"] = $rows["inTrash"];
                        $data[$i]["isComplete"] = $rows["isComplete"];
                        $data[$i]["isDue"] = $rows["isDue"];
                    }
                    echo json_encode($data);
                    http_response_code(200);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
                else{
                    echo json_encode([]);
                    http_response_code(100);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
            }
            else{
                http_response_code(500);
            }
        }
        else{
            http_response_code(404);
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
?>