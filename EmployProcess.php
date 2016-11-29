<?php
    
    include 'sql.php';
    
    session_start();
    
    $employObj = new Employ();
    $bankObj = new Bank();
    
    $action = $_POST["action"];
    
    if($action === "create") {
        $staffID = $_POST["staffID"];
        $staffType = $_POST["staffType"];
        $eName = $_POST["eName"];
        $cName = $_POST["cName"];
        $gender = $_POST["gender"];
        $HKID = $_POST["HKID"];
        $birthday = $_POST["birthday"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $employDate = $_POST["employDate"];
        $departCode = $_POST["departCode"];
        $position = $_POST["position"];
        $leaveTemplate = $_POST["leaveTemplate"];
        $accountNo = $_POST["accountNo"];
        $accountName = $_POST["accountName"];
        $bankName = $_POST["bankName"];
        $branch = $_POST["branch"];
        $insert = $employObj->insertEmployRecord($staffID, $staffType, $cName, $eName, $gender, $HKID, $birthday, $phone, $address, 
          $email, $employDate, $departCode, $position, $leaveTemplate);
        if($insert) {
            $insert = $bankObj->insertBankRecord($accountNo, $staffID, $bankName, $branch, $accountName);
            if($insert) {
                echo "ok";
            }
            else {
                $delete = $employObj->deleteEmployRecord($staffID);
                echo "bankFail";
            }
        } else {
            echo "employFail";
        }        
    } else if($action === "detail") {
		unset($_SESSION['d_staffID']);
		unset($_SESSION['d_staffType']);
		unset($_SESSION['d_eName']);
		unset($_SESSION['d_cName']);
		unset($_SESSION['d_gender']);
		unset($_SESSION['d_HKID']);
		unset($_SESSION['d_birthday']);
		unset($_SESSION['d_phone']);
		unset($_SESSION['d_email']);
		unset($_SESSION['d_address']);
		unset($_SESSION['d_employDate']);
		unset($_SESSION['d_departCode']);
		unset($_SESSION['d_position']);
		unset($_SESSION['d_leaveTemplate']);
		unset($_SESSION['d_accountNo']);
		unset($_SESSION['d_accountName']);
		unset($_SESSION['d_bankName']);
		unset($_SESSION['d_branch']);
        
        $staffID = $_POST["staffID"];        
        $detail = $employObj->getEmployRecord($staffID);
        if(sizeof($detail) > 0) {
            $_SESSION["d_staffID"] = $detail["staffID"];
            $_SESSION["d_staffType"] = $detail["staffType"];
            $_SESSION["d_eName"] = $detail["englishName"];
            $_SESSION["d_cName"] = $detail["chineseName"];
            $_SESSION["d_gender"] = $detail["gender"];
            $_SESSION["d_HKID"] = $detail["HKID"];
            $_SESSION["d_birthday"] = $detail["birthday"];
            $_SESSION["d_phone"] = $detail["phone"];
            $_SESSION["d_email"] = $detail["email"];
            $_SESSION["d_address"] = $detail["address"];
            $_SESSION["d_employDate"] = $detail["employmentDate"];
            $_SESSION["d_departCode"] = $detail["departmentCode"];
            $_SESSION["d_position"] = $detail["position"];
            $_SESSION["d_leaveTemplate"] = $detail["leaveTemplateCode"];
            
            $bankDetail = $bankObj->getBankRecord($staffID);
            if(sizeof($bankDetail) > 0) {
                $_SESSION["d_accountNo"] = $bankDetail["accountNo"];                
                $_SESSION["d_accountName"] = $bankDetail["accountName"];                
                $_SESSION["d_bankName"] = $bankDetail["bankName"];                
                $_SESSION["d_branch"] = $bankDetail["branch"];                
            }
            header('Location: EditEmploy.php');
        } else {
            header('Location: EmployList.php');
        }
    } else if($action === "edit") {
        $staffID = $_SESSION["d_staffID"];
        $staffType = $_POST["staffType"];
        $eName = $_POST["eName"];
        $cName = $_POST["cName"];
        $gender = $_POST["gender"];
        $HKID = $_POST["HKID"];
        $birthday = $_POST["birthday"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $employDate = $_POST["employDate"];
        $departCode = $_POST["departCode"];
        $position = $_POST["position"];
        $leaveTemplate = $_POST["leaveTemplate"];
        $accountNo = $_POST["accountNo"];
        $accountName = $_POST["accountName"];
        $bankName = $_POST["bankName"];
        $branch = $_POST["branch"];
        $update = $employObj->updateEmployRecord($staffID, $staffType, $cName, $eName, $gender, $HKID, $birthday, $phone, $address, 
          $email, $employDate, $departCode, $position, $leaveTemplate);        
        if($update) {
            $_SESSION["d_staffType"] = $staffType;
            $_SESSION["d_eName"] = $eName;
            $_SESSION["d_cName"] = $cName;
            $_SESSION["d_gender"] = $gender;
            $_SESSION["d_HKID"] = $HKID;
            $_SESSION["d_birthday"] = $birthday;
            $_SESSION["d_phone"] = $phone;
            $_SESSION["d_email"] = $email;
            $_SESSION["d_address"] = $address;
            $_SESSION["d_employDate"] = $employDate;
            $_SESSION["d_departCode"] = $departCode;
            $_SESSION["d_position"] = $position;
            $_SESSION["d_leaveTemplate"] = $leaveTemplate;
            
            $delete = $bankObj->deleteBankRecord($staffID);
            if($delete) {
                $insert = $bankObj->insertBankRecord($accountNo, $staffID, $bankName, $branch, $accountName);
                if($insert) {                    
                    $_SESSION["d_accountNo"] = $accountNo;
                    $_SESSION["d_accountName"] = $accountName;
                    $_SESSION["d_bankName"] = $bankName;
                    $_SESSION["d_branch"] = $branch;
                    echo "ok";
                }
                else {
                    echo "bankFail";
                }
            } else {
                echo "bankFail";
            }
        } else {
            echo "employFail";
        }
    } else if($action === "delete") {
        $staffID = $_SESSION["d_staffID"];
        $delete = $bankObj->deleteBankRecord($staffID);
        if($delete) {;
            unset($_SESSION['d_accountNo']);
            unset($_SESSION['d_accountName']);
            unset($_SESSION['d_bankName']);
            unset($_SESSION['d_branch']);
            
            $delete = $employObj->deleteEmployRecord($staffID);
            if($delete) {
                unset($_SESSION['d_staffID']);
                unset($_SESSION['d_staffType']);
                unset($_SESSION['d_eName']);
                unset($_SESSION['d_cName']);
                unset($_SESSION['d_gender']);
                unset($_SESSION['d_HKID']);
                unset($_SESSION['d_birthday']);
                unset($_SESSION['d_phone']);
                unset($_SESSION['d_email']);
                unset($_SESSION['d_address']);
                unset($_SESSION['d_employDate']);
                unset($_SESSION['d_departCode']);
                unset($_SESSION['d_position']);
                unset($_SESSION['d_leaveTemplate']);
                
                echo "ok";
            } else {
                echo "employFail";
            }
        } else {
            echo "bankFail";
        }
    }
?>