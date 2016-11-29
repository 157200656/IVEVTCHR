<?php
    
    include 'sql.php';
    
    session_start();
    
    $leaveTakenObj = new LeaveTaken();
    $leaveBalanceObj = new LeaveBalance();
		
	$action = $_POST["action"];
    
    if($action === "create") {
        $staffID = $_SESSION["staffID"];
        $leaveType = $_POST["leaveTypeCode"];
        $startDate = $_POST["startDate"];
        $startTakenUnit = $_POST["startTakenUnit"];
        $endDate = $_POST["endDate"];
        $endTakenUnit = $_POST["endTakenUnit"];
        $taken = 0;
        
    } else if($action === "detail") {
        $id = $_POST["leaveID"];
        $detail = $leaveTakenObj->getLeaveTakenRecordById($id);
		unset($_SESSION['leaveID']);
		unset($_SESSION['leaveTypeCode']);
		unset($_SESSION['leaveDate']);
		unset($_SESSION['taken']);
		unset($_SESSION['status']);
        if(sizeof($detail) > 0) {
            $_SESSION["leaveID"] = $id;
            $_SESSION["leaveTypeCode"] = $detail["leaveTypeCode"];
            $_SESSION["leaveDate"] = $detail["leaveDate"];
            $_SESSION["taken"] = $detail["taken"];
            $_SESSION["status"] = $detail["status"];
            header('Location: EditLeaveApp.php');
        } else {
            header('Location: LeaveInquiry.php');
        }
    } else if($action === "edit") {
        
    } else if($action === "delete") {
        $id = $_SESSION["leaveID"];
		$staffID = $_SESSION["staffID"];
		$leaveType = $_SESSION["leaveTypeCode"];
        $leaveDate = $_SESSION["leaveDate"];
        $taken = $_SESSION["taken"];
        $date = date_create($leaveDate);
        $leaveYear = $date->format("Y");
        
        $update = $leaveBalanceObj->addLeaveBalanceRecord($staffID, $leaveType, $leaveYear, $taken);
        if($update) {
            $delete = $leaveTakenObj->deleteLeaveTakenRecord($id);
            if($delete) {
                echo "ok";              
            } else {
                echo "fail";
            }
        } else {
            echo "reAddBalfail";
        }
    } else if($action === "approval") {        
        $approvalList = $_POST["approval"];
        $idList = $_POST["leaveID"];
        $totalRecord = count($idList);
        for ($i = 0; $i < $totalRecord; $i++) {
            $id = $idList[$i];
            if($approvalList[$i] === ap) {
                $status = LeaveTaken::status_approved;
            } else {
                $status = LeaveTaken::status_rejected;
                
                $detail = $leaveTakenObj->getLeaveTakenRecordById($id);
                if(sizeof($detail) > 0) {
                    $staffID = $detail["staffID"];
                    $leaveType = $detail["leaveTypeCode"];
                    $leaveDate = $detail["leaveDate"];
                    $taken = $detail["taken"];
                    
                    $date = date_create($leaveDate);
                    $leaveYear = $date->format("Y");
                    
                    $update = $leaveBalanceObj->addLeaveBalanceRecord($staffID, $leaveType, $leaveYear, $taken);
                    if(!$update) {
                        header('Location: LeaveApproval.php');
                    }
                } else {
                    header('Location: LeaveApproval.php');
                }
            }
            
            $update = $leaveTakenObj->updateLeaveStatusRecord($id, $status);
            if($update) {
                header('Location: LeaveApproval.php');
            } else {
                header('Location: LeaveApproval.php');
            }
        }
    }
?>