<?php

    include 'sql.php';
    
    session_start();
    
    $departObj = new Department();
    
    $action = $_POST["action"];
    
    if($action === "create") {
        $departmentCode = $_POST["departmentCode"];
        $description = $_POST["description"];
        $insert = $departObj->insertDepartmentRecord($departmentCode, $description);
        if($insert) {
            echo "ok";
        } else {
            echo "fail";
        }        
    } else if($action === "detail") {
        $departmentCode = $_POST["departmentCode"];
        $detail = $departObj->getDepartmentRecord($departmentCode);
        unset($_SESSION['departmentCode']);
        unset($_SESSION['description']);
        if(sizeof($detail) > 0) {
            $_SESSION["departmentCode"] = $detail["departmentCode"];
            $_SESSION["description"] = $detail["description"];
            header('Location: EditDepartment.php');
        } else {
            header('Location: DepartmentList.php');
        }
    } else if($action === "edit") {
        $departmentCode = $_SESSION["departmentCode"];
        $description = $_POST["description"];
        $update = $departObj->updateDepartmentRecord($departmentCode, $description);        
        if($update) {
            echo "ok";
        } else {
            echo "fail";
        }
    } else if($action === "delete") {
        $departmentCode = $_SESSION["departmentCode"];
        $delete = $departObj->deleteDepartmentRecord($departmentCode);
        if($delete) {
            unset($_SESSION['departmentCode']);
            unset($_SESSION['description']);
    
            echo "ok";
        } else {
            echo "fail";
        }
    }
?>