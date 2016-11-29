<?php
    
    include 'sql.php';
    
    session_start();
    
    $attendObj = new Attendance();
    
    $action = $_POST["action"];
    
    if($action === "create") {
        $staffID = $_POST["staffID"];
        $site = $_POST["siteCode"];
        $insert = $attendObj->insertAttendanceRecord($staffID, $site);
        $response = array(
                        "success" => "",
                        "staffID" => $staffID,
                        "message" => ""
                        );
        if($insert) {
            $response["success"] = "ok";
        } else {
            $response["success"] = "fail";
        }
        echo json_encode($response);
    }
?>