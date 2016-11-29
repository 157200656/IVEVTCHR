<?php
    
    include 'sql.php';
    
    session_start();
    
    $leaveTypeObj = new LeaveType();
	
	$action = $_POST["action"];
    
    if($action === "create") {
        $leaveType = $_POST["leaveTypeCode"];
        $description = $_POST["description"];
        $yearStartList = $_POST["yearStart"];
        $yearEndList = $_POST["yearEnd"];
        $entitleList = $_POST["entitle"];
        for ($x = 0; $x <= 10; $x++) {
            $yearStart = intval($yearStartList[$x]);
            $yearEnd = intval($yearEndList[$x]);
            $entitle = intval($entitleList[$x]);
            if($yearEnd == 0 || $entitle == 0 || $yearEnd < $yearStart) {
                continue;
            }
            $insert = $leaveTypeObj->insertLeaveTypeRecord($leaveType, $description, $yearStart, $yearEnd, $entitle);
            if(!$insert) {
                echo "fail";
				break;
            }
        }
		header('Location: CreateLeaveType.php');
    } else if($action === "detail") {
        unset($_SESSION['leaveTypeCode']);
        unset($_SESSION['description']);
        unset($_SESSION['yearStart']);
        unset($_SESSION['yearEnd']);
        unset($_SESSION['entitle']);
        
        $leaveType = $_POST["leaveType"];
        $detail = $leaveTypeObj->getLeaveTypeRecord($leaveType);
        if (sizeof($detail) > 0) {
            $_SESSION['leaveTypeCode'] = $leaveType;
            $_SESSION['description'] = $detail["description"];
            $_SESSION['yearStart'] = $detail["yearStart"];
            $_SESSION['yearEnd'] = $detail["yearEnd"];
            $_SESSION['entitle'] = $detail["entitle"];
            
            header('Location: EditLeaveType.php');
        } else {
            header('Location: LeaveTypeList.php');
        }
    } else if($action === "edit") {
        $leaveType = $_SESSION["leaveTypeCode"];
        $description = $_POST["description"];
        $yearStartList = $_POST["yearStart"];
        $yearEndList = $_POST["yearEnd"];
        $entitleList = $_POST["entitle"];
        $startSession = array();
        $endSession = array();
        $entitleSession = array();
        
        $delete = $leaveTypeObj->deleteLeaveTypeRecord($leaveType);
        if($delete) {
            for ($x = 0; $x <= 10; $x++) {
                $yearStart = intval($yearStartList[$x]);
                $yearEnd = intval($yearEndList[$x]);
                $entitle = intval($entitleList[$x]);
                $startSession[] = $yearStart;
                $endSession[] = $yearEnd;
                $entitleSession[] = $entitle;
                if($yearEnd == 0 || $entitle == 0 || $yearEnd < $yearStart) {
                    continue;
                }
                $insert = $leaveTypeObj->insertLeaveTypeRecord($leaveType, $description, $yearStart, $yearEnd, $entitle);
                if(!$insert) {
                    echo "fail";
                    break;
                }
            }
            $_SESSION['yearStart'] = $startSession;
            $_SESSION['yearEnd'] = $endSession;
            $_SESSION['entitle'] = $entitleSession;
            $_SESSION['description'] = $description;
        }
        
		header('Location: EditLeaveType.php');
    } else if($action === "delete") {
        $leaveType = $_SESSION["leaveTypeCode"];
        $delete = $leaveTypeObj->deleteLeaveTypeRecord($leaveType);
        if($delete) {
            unset($_SESSION['leaveTypeCode']);
            unset($_SESSION['yearStart']);
            unset($_SESSION['yearEnd']);
            unset($_SESSION['entitle']);
            unset($_SESSION['description']);
    
            echo "ok";
        } else {
            echo "fail";
        }
    }
?>