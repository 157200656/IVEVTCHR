<?php
    // Connect to the db
    function ConnectDB(){
        $hostname = 'mysql1.000webhost.com';
        $username = 'a7525437_hrms';
        $password = 'abc123';
        $database = 'a7525437_hrms';

        $mysqli = new mysqli("$hostname" , "$username" , "$password" , "$database") or die('Cannot connect to database server! Please check the connection.');
        return $mysqli;
    }
    
    Class Department {
        function getAllDepartmentRecord() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM Department";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getDepartmentRecord($departmentCode) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM Department WHERE departmentCode = '{$departmentCode}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;                    
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertDepartmentRecord($departmentCode, $description) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO Department VALUES('{$departmentCode}','{$description}')";
			$mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateDepartmentRecord($departmentCode, $description) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE Department SET Description = '{$description}' WHERE DepartmentCode = '{$departmentCode}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function deleteDepartmentRecord($departmentCode) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM Department WHERE DepartmentCode = '{$departmentCode}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class Employ {
        function getAllEmployRecord() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM Employ WHERE staffType <> 'h' ORDER BY staffID";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getEmployRecord($staffID) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM Employ WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getEmployRecordByDepart($staffID) {            
            $record = array();
            $mysqli = ConnectDB();
            $departCode = '';
            
            $query = "SELECT * FROM Employ WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                    $departCode = $row["departmentCode"];
                }
                
                $result->free_result();
            
                $query = "SELECT * FROM Employ WHERE staffType = 'e' AND departmentCode = '{$departCode}' ORDER BY staffID";
                $mysqli->set_charset('utf8');
                if ($result = $mysqli->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        $record[] = $row;
                    }
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertEmployRecord($staffID, $staffType, $cName, $eName, $gender, $HKID, $birthday, $phone, $address, 
          $email, $employDate, $departCode, $position, $leaveTemplate) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO Employ VALUES('{$staffID}','{$staffType}','{$cName}','{$eName}','{$gender}','{$HKID}',";
            $query .= "'{$birthday}','{$phone}','{$address}','{$email}','{$employDate}','{$departCode}','{$position}',";
            $query .= "'{$leaveTemplate}','')";
			$mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateEmployRecord($staffID, $staffType, $cName, $eName, $gender, $HKID, $birthday, $phone, $address, 
          $email, $employDate, $departCode, $position, $leaveTemplate) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE Employ SET staffType = '{$staffType}', chineseName = '{$cName}', englishName = '{$eName}', ";
            $query .= "gender = '{$gender}', HKID = '{$HKID}', birthday = '{$birthday}', phone = '{$phone}', ";
            $query .= "address = '{$address}', email = '{$email}', employmentDate = '{$employDate}', ";
            $query .= "departmentCode = '{$departCode}', position = '{$position}', leaveTemplateCode = '{$leaveTemplate}' ";
            $query .= "WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateEmployAttendID($staffID, $attendID) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE Employ SET attendanceID = '{$attendID}' WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function deleteEmployRecord($staffID) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM Employ WHERE staffID = '{$staffID}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    Class Bank {        
        function getBankRecord($staffID) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM Bank WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertBankRecord($accountNo, $staffID, $bankName, $branch, $accountName) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO Bank VALUES('{$accountNo}','{$staffID}','{$bankName}','{$branch}','{$accountName}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function deleteBankRecord($staffID) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM Bank WHERE staffID = '{$staffID}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class Login {        
        function getLoginRecord($accID, $password) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT o1.staffID, e1.staffType FROM Login AS o1 INNER JOIN Employ e1 ON o1.staffID = e1.staffID ";
            $query .= "WHERE o1.accID = '{$accID}' AND o1.password = '{$password}'";
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertLoginRecord($accID, $staffID, $password) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO Login VALUES('{$accID}','{$staffID}','{$password}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class LeaveType {
        
        function getAllLeaveType() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT leaveTypeCode, description FROM LeaveType GROUP BY leaveTypeCode";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getLeaveTypeRecord($leaveType) {
            $record = array();
            $mysqli = ConnectDB();
            
            $startList = array();
            $endList = array();
            $entitleList = array();
            $description = "";
            
            $query = "SELECT * FROM LeaveType WHERE leaveTypeCode = '{$leaveType}'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $startList[] = $row["yearStart"];
                    $endList[] = $row["yearEnd"];
                    $entitleList[] = $row["entitle"];
                    $description = $row["description"];
                }
                if(sizeof($startList) > 0 &&
                    sizeof($endList) > 0 &&
                    sizeof($entitleList) > 0) {
                    $record = array(
                        "yearStart" => $startList,
                        "yearEnd" => $endList,
                        "entitle" => $entitleList,
                        "description" => $description
                    );
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertLeaveTypeRecord($leaveType, $description, $yearStart, $yearEnd, $entitle) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO LeaveType VALUES('{$leaveType}',{$yearStart},{$yearEnd},{$entitle},'{$description}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
                
        function deleteLeaveTypeRecord($leaveType) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM LeaveType WHERE leaveTypeCode = '{$leaveType}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class LeaveTemplate {
        
        function getAllLeaveTemplate() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTemplate";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getLeaveTemplateRecord($leaveTemplate) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTemplate WHERE leaveTemplateCode = '{$leaveTemplate}'";
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getStaffLeaveTypeRecord($staffID) {
            $record = array();
            $mysqli = ConnectDB();
            
            $leaveTemplate = '';
            
            $query = "SELECT * FROM Employ WHERE staffID = '{$staffID}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                    $leaveTemplate = $row["leaveTemplateCode"];
                }
                
                $result->free_result();
            
                $query = "SELECT * FROM LeaveTemplate WHERE leaveTemplateCode = '{$leaveTemplate}'";
                if ($result = $mysqli->query($query)) {
                    if ($row = $result->fetch_assoc()) {
                        $record = array(
                                    "Annual Leave" => $row["annualLeave"],
                                    "Sick Leave" => $row["sickLeave"],
                                    "Maternity Leave" => $row["maternityLeave"],
                                    "Paternity Leave" => $row["paternityLeave"],
                                    "Speacial Leave" => $row["speacialLeave"]
                                    );
                    }
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertLeaveTemplateRecord($leaveTemplate, $description, $annualLeave, $sickLeave, $maternityLeave, $paternityLeave, $speacialLeave) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO LeaveTemplate VALUES('{$leaveTemplate}','{$description}','{$annualLeave}','{$sickLeave}','{$maternityLeave}','{$paternityLeave}','{$speacialLeave}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateLeaveTemplateRecord($leaveTemplate, $description, $annualLeave, $sickLeave, $maternityLeave, $paternityLeave, $speacialLeave) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE LeaveTemplate SET description = '{$description}', annualLeave = '{$annualLeave}', sickLeave = '{$sickLeave}', maternityLeave = '{$maternityLeave}', ";
            $query .= "paternityLeave = '{$paternityLeave}', speacialLeave = '{$speacialLeave}' WHERE leaveTemplateCode = '{$leaveTemplate}'";
            $mysqli->set_charset('utf8');
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
                
        function deleteLeaveTemplateRecord($leaveTemplate) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM LeaveTemplate WHERE leaveTemplateCode = '{$leaveTemplate}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class LeaveTaken {
        const status_pending = "PEN";
        const status_waitForApprove = "WFA";
        const status_approved = "APV";
        const status_rejected = "REJ";
        
        function getLeaveAllPendingRecord() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTaken WHERE status = '" . self::status_pending . "'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getLeaveAllWaitForApproveRecord() {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTaken WHERE status = '" . self::status_waitForApprove . "'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getLeaveTakenRecordById($id) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTaken WHERE id = '{$id}'";
            if ($result = $mysqli->query($query)) {
                if ($row = $result->fetch_assoc()) {
                    $record = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getOneStaffLeaveTakenRecord($staffID) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTaken WHERE staffID = '{$staffID}'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function getLeaveTakenRecord($staffID, $leaveType, $leaveDate) {
            $record = array();
            $mysqli = ConnectDB();
            
            $query = "SELECT * FROM LeaveTaken WHERE staffID = '{$staffID}' AND leaveTypeCode = '{$leaveType}' AND leaveDate = '{$leaveDate}' AND status <> '" . self::status_rejected . "'";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertLeaveTakenRecord($staffID, $staffType, $leaveTypeCode, $startDate, $startTakenUnit, $endDate, $endTakenUnit, $taken) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $status = self::status_pending;
            
            switch($staffType)
            {
                case "a":
                    $status = self::status_waitForApprove;
                    break;
                case "b":
                    $status = self::status_approved;
                    break;
            }
                        
            $query = "INSERT INTO LeaveTaken(staffID,leaveTypeCode,startDate,startTakingUnit,endDate,endTakingUnit,taken,status) ";
            $query .= "VALUES('{$staffID}','{$leaveTypeCode}','{$startDate}','{$startTakenUnit}','{$endDate}','{$endTakenUnit}',{$taken},'{$status}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateLeaveTakenRecord($staffID, $staffType, $leaveTypeCode, $startDate, $startTakenUnit, $endDate, $endTakenUnit, $taken) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE LeaveTaken SET taken = '{$taken}' WHERE id = '{$id}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function updateLeaveStatusRecord($id, $status) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "UPDATE LeaveTaken SET status = '{$status}' WHERE id = '{$id}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
        
        function deleteLeaveTakenRecord($id) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "DELETE FROM LeaveTaken WHERE id = '{$id}'";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
    
    Class Attendance {
        function getAttendanceRecord($staffID) {
            $record = array();
            $mysqli = ConnectDB();
            
            $mysqli->query("SET time_zone = '+8:00'");
            
            $query = "SELECT * FROM Attendance WHERE staffID = '{$staffID}' ORDER BY attendance DESC";
            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $record[] = $row;
                }
            }
            $mysqli->close();
            
            return $record;
        }
        
        function insertAttendanceRecord($staffID, $site) {
            $successful = FALSE;
            $mysqli = ConnectDB();
            
            $query = "INSERT INTO Attendance(staffID,site) VALUES('{$staffID}','{$site}')";
            if ($result = $mysqli->query($query)) {
                $successful = TRUE;
            }
            $mysqli->close();
            
            return $successful;
        }
    }
?>