<?php
    require_once './getjwt.php';
    require_once './vendor/autoload.php';
    require_once './connection.php';
    header("HTTP/1.1 200 OK");

    $user_id = getID();
    $username = "";
    $confirm = "true";
    $unconfirm = "false";

    $data = array();
    $sql = "SELECT username FROM `user_info` WHERE id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    if($stmt->execute()){
        $results = $stmt->get_result();
        if($results->num_rows > 0){
            while($row = $results->fetch_assoc()){
                $username = $row["username"];
            }
            $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=?;";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
                $results = $stmt->get_result();
                if($results->num_rows > 0){
                    while($rows = $results->fetch_assoc()){
                        $data["TotalActivities"] = $rows["COUNT(ActivityTitle)"];
                    }
                    $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=? AND isDue=?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $username, $confirm);
                    if($stmt->execute()){
                        $results = $stmt->get_result();
                        if($results->num_rows > 0){
                            while($row = $results->fetch_assoc()){
                                $data["DueActivities"] = $row["COUNT(ActivityTitle)"];
                            }
                            $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=? AND isComplete=?;";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('ss', $username, $confirm);
                            if($stmt->execute()){
                                $results = $stmt->get_result();
                                if($results->num_rows > 0){
                                    while($row = $results->fetch_assoc()){
                                        $data["ActivitiesCompleted"] = $row["COUNT(ActivityTitle)"];
                                    }
                                    $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=? AND isArchived=?;";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param('ss', $username, $confirm);
                                    if($stmt->execute()){
                                        $results = $stmt->get_result();
                                        if($results->num_rows > 0){
                                            while($row = $results->fetch_assoc()){
                                                $data["ArchivedActivities"] = $row["COUNT(ActivityTitle)"];
                                            }
                                            $sql = "SELECT COUNT(AcitivityTitle) FROM `activities` WHERE username=? AND isComplete=?;";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param('ss', $username, $unconfirm);
                                            if($stmt->execute()){
                                                $results = $stmt->get_result();
                                                if($results->num_rows > 0){
                                                    while($row = $results->fetch_assoc()){
                                                        $data["UnfinishedActivities"] = $row["COUNT(ActivityTitle)"];
                                                    }
                                                    $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=? AND isTrash=?;";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->bind_param('ss', $username, $confirm);
                                                    if($stmt->execute()){
                                                        $results = $stmt->get_result();
                                                        if($results->num_rows > 0){
                                                            while($row = $results->fetch_assoc()){
                                                                $data["TrashedActivities"] = $row["COUNT(ActivityTitle)"];
                                                            }
                                                            $sql = "SELECT COUNT(ActivityTitle) FROM `activities` WHERE username=? AND isStarred=?;";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->bind_param('ss', $username, $confirm);
                                                            if($stmt->execute()){
                                                                $results = $stmt->get_result();
                                                                if($results->num_rows > 0){
                                                                    while($row = $results->fetch_assoc()){
                                                                        $data["StarredActivities"] = $row["COUNT(ActivityTitle)"];
                                                                    }
                                                                    echo json_encode($data);
                                                                    http_response_code(200);
                                                                    $stmt->close();
                                                                    $conn->close();
                                                                    exit;
                                                                }
                                                                else{
                                                                    http_response_code(100);
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
                                                        else{
                                                            http_response_code(100);
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
                                                else{
                                                    http_response_code(100);
                                                }
                                            }
                                            else{
                                                http_response_code(500);
                                                $stmt->close();
                                                $conn->close();
                                                exit;
                                            }
                                        }
                                        else{
                                            http_response_code(100);
                                        }
                                    }
                                    else{
                                        http_response_code(500);
                                        $stmt->close();
                                        $conn->close();
                                        exit;
                                    }
                                }
                                else{
                                    http_response_code(100);
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
                        else{
                            http_response_code(100);
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
                else{
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