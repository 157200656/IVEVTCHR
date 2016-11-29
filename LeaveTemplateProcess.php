<?php
    
    include 'sql.php';
    
    session_start();
    
    $leaveTemplateObj = new LeaveTemplate();
    
    $action = $_POST["action"];
    
    if($action === "create") {
        $leaveTemplate = $_POST["leaveTemplateCode"];
        $description = $_POST["description"];
        $annualLeave = $_POST["annualLeave"];
        $sickLeave = $_POST["sickLeave"];
        $maternityLeave = $_POST["maternityLeave"];
        $paternityLeave = $_POST["paternityLeave"];
        $speacialLeave = $_POST["speacialLeave"];
        $insert = $leaveTemplateObj->insertLeaveTemplateRecord($leaveTemplate, $description, $annualLeave, $sickLeave, $maternityLeave, $paternityLeave, $speacialLeave);
        if($insert) {
            echo "ok";
        } else {
            echo "fail";
        }        
    } else if($action === "detail") {
		unset($_SESSION['leaveTemplateCode']);
		unset($_SESSION['description']);
		unset($_SESSION['annualLeave']);
		unset($_SESSION['sickLeave']);
		unset($_SESSION['maternityLeave']);
		unset($_SESSION['paternityLeave']);
		unset($_SESSION['speacialLeave']);
        
        $leaveTemplate = $_POST["leaveTemplateCode"];        
        $detail = $leaveTemplateObj->getLeaveTemplateRecord($leaveTemplate);
        if(sizeof($detail) > 0) {
            $_SESSION["leaveTemplateCode"] = $detail["leaveTemplateCode"];
            $_SESSION["description"] = $detail["description"];
            $_SESSION["annualLeave"] = $detail["annualLeave"];
            $_SESSION["sickLeave"] = $detail["sickLeave"];
            $_SESSION["maternityLeave"] = $detail["maternityLeave"];
            $_SESSION["paternityLeave"] = $detail["paternityLeave"];
            $_SESSION["speacialLeave"] = $detail["speacialLeave"];
            header('Location: EditLeaveTemplate.php');
        } else {
            header('Location: LeaveTemplateList.php');
        }
    } else if($action === "edit") {
        $leaveTemplate = $_SESSION["leaveTemplateCode"];
        $description = $_POST["description"];
        $annualLeave = $_POST["annualLeave"];
        $sickLeave = $_POST["sickLeave"];
        $maternityLeave = $_POST["maternityLeave"];
        $paternityLeave = $_POST["paternityLeave"];
        $speacialLeave = $_POST["speacialLeave"];
        $update = $leaveTemplateObj->updateLeaveTemplateRecord($leaveTemplate, $description, $annualLeave, $sickLeave, $maternityLeave, $paternityLeave, $speacialLeave);
        if($update) {
            $_SESSION["description"] = $description;
            $_SESSION["annualLeave"] = $annualLeave;
            $_SESSION["sickLeave"] = $sickLeave;
            $_SESSION["maternityLeave"] = $maternityLeave;
            $_SESSION["paternityLeave"] = $paternityLeave;
            $_SESSION["speacialLeave"] = $speacialLeave;
            echo "ok";
        } else {
            echo "fail";
        }
    } else if($action === "delete") {
        $leaveTemplate = $_SESSION["leaveTemplateCode"];
        $delete = $leaveTemplateObj->deleteLeaveTemplateRecord($leaveTemplate);
        if($delete) {
            unset($_SESSION['leaveTemplateCode']);
            unset($_SESSION['description']);
            unset($_SESSION['annualLeave']);
            unset($_SESSION['sickLeave']);
            unset($_SESSION['maternityLeave']);
            unset($_SESSION['paternityLeave']);
            unset($_SESSION['speacialLeave']);
                
            echo "ok";
        } else {
            echo "fail";
        }
    }
?>