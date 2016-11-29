<?php
    
    include 'sql.php';
    
    session_start();
    
    $accID = $_POST['accID'];
    $password = $_POST['password'];
    $action = $_POST["action"];
    
    $loginObj = new Login();
    
    if($action === "login") {
        $record = $loginObj->getLoginRecord($accID, $password);
        if(sizeof($record) > 0) {
            $_SESSION["staffID"] = $record["staffID"];
            $_SESSION["staffType"] = $record["staffType"];
            echo "ok";
        } else {
            echo "fail";
        }
    } else if($action === "register") {
        $staffID = $_POST['staffID'];
        $insert = $loginObj->insertLoginRecord($accID, $staffID, $password);
        if($insert) {
            echo "ok";
        } else {
            echo "fail";
        }
    } else if($action === "logout") {
        unset($_SESSION['staffID']);
        unset($_SESSION['staffType']);
        
        unset($_SESSION['d_staffID']);
        unset($_SESSION['d_staffType']);
        unset($_SESSION['d_eName']);
        unset($_SESSION['d_cName']);
        unset($_SESSION['d_gender']);
        unset($_SESSION['d_HKID']);
        unset($_SESSION['d_birthday']);
        unset($_SESSION['d_employDate']);
        unset($_SESSION['d_employEndDate']);
        unset($_SESSION['d_departCode']);
        
        header('Location: Login.html');
    }
?>