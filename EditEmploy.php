<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employment Information Maintenance</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#Edit").submit(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        var staffType = $("input[name=staffType]:checked").val();
        var eName = $('#eName').val();
        var cName = $('#cName').val();
        var gender = $("input[name=gender]:checked").val();
        var HKID = $('#HKID').val();
        var birthday = $('#birthday').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var address = $('#address').val()
        var employDate = $('#employDate').val();
        var departCode = $("select[name=departCode]").val();
        var position = $('#position').val();
        var leaveTemplate = $("select[name=leaveTemplate]").val();
        var accountNo = $('#accountNo').val();
        var accountName = $('#accountName').val();
        var bankName = $('#bankName').val();
        var branch = $('#branch').val();
        
        $.ajax({
          url: 'EmployProcess.php',
          type: 'post',
          data: {'staffType': staffType, 'eName': eName, 'cName': cName, 'gender': gender, 'HKID': HKID, 
          'birthday': birthday, 'phone': phone, 'email': email, 'address': address, 'employDate': employDate, 
          'departCode': departCode, 'position': position, 'leaveTemplate': leaveTemplate, 'accountNo': accountNo, 
          'accountName': accountName, 'bankName': bankName, 'branch': branch, 'action': 'edit'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record updated.");
            } else if(data == "bankFail") {
                alert("Update bank detail fail.");
				location.reload();
            } else if(data == "employFail") {
                alert("Update employ detail fail.");
				location.reload();
            } else {
                alert(data);
            }
          },
          error: function(xhr, desc, err) {
            aler(err);
          }
        }) // end ajax call
    });
    $("#delete").click(function(){        
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        $.ajax({
          url: 'EmployProcess.php',
          type: 'post',
          data: {'action': 'delete'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record deleted.");
                location.href = "EmployList.php";
            } else if(data == "bankFail") {
                alert("Delete bank detail fail.");
				location.reload();
            } else if(data == "employFail") {
                alert("Delete employ detail fail.");
				location.reload();
            }
          },
          error: function(xhr, desc, err) {
            aler(err);
          }
        }) // end ajax call
    });
});
</script>
<style>
td {
    padding: 5px;
}
</style>
</head>

<body>
    <?php
        include 'Header.php';
        
        $employ = new Employ();
        $bankObj = new Bank();
        
        if(empty($_SESSION["d_staffID"])) {
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
            
            $detail = $employ->getEmployRecord($_SESSION["staffID"]);
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
                $_SESSION["d_departCode"] = $detail["departCode"];
                $_SESSION["d_position"] = $detail["position"];
                $_SESSION["d_leaveTemplate"] = $detail["leaveTemplateCode"];
                
                $bankDetail = $bankObj->getBankRecord($_SESSION["staffID"]);
                if(sizeof($bankDetail) > 0) {
                    $_SESSION["d_accountNo"] = $bankDetail["accountNo"];                
                    $_SESSION["d_accountName"] = $bankDetail["accountName"];                
                    $_SESSION["d_bankName"] = $bankDetail["bankName"];                
                    $_SESSION["d_branch"] = $bankDetail["branch"];                
                }
            } else {
                header('Location: home.php');
            }
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Employment Information Maintenance</h1>
            </div>
            <form id="Edit">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Employment Detail</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="">Staff ID:</label>
                                    <div class="">
                                        <input id="staffID" type="text" class="form-control" name="staffID" maxlength="10" value="<?= $_SESSION["d_staffID"] ?>" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Staff Type:</label>
                                    <div class="">
                                        <label class="radio-inline">
                                            <input type="radio" name="staffType" value="e" <?php if($_SESSION["d_staffType"] == "e") echo "checked" ?> />Employee
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="staffType" value="a" <?php if($_SESSION["d_staffType"] == "a") echo "checked" ?> />Supervisor
                                        </label>
                                        <?php
                                            if($_SESSION["staffType"] == "h" ||
                                                $_SESSION["staffType"] == "b") {
                                                    echo '<label class="radio-inline">';
                                                    if($_SESSION["d_staffType"] == "b") {
                                                        echo '<input type="radio" name="staffType" value="b" checked />Boss';
                                                    } else {
                                                        echo '<input type="radio" name="staffType" value="b" />Boss';
                                                    }
                                                    echo '</label>';
                                                }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">English name:</label>
                                    <div class="">
                                        <input id="eName" type="text" class="form-control" name="eName" maxlength="30" value="<?= $_SESSION["d_eName"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Chinese name:</label>
                                    <div class="">
                                        <input id="cName" type="text" class="form-control" name="cName" maxlength="30" value="<?= $_SESSION["d_cName"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Gender:</label>                    
                                    <div class="">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="m" <?php if($_SESSION["d_gender"] == "m") echo "checked" ?> />Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" value="f" <?php if($_SESSION["d_gender"] == "f") echo "checked" ?> />Female
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">HKID:</label>
                                    <div class="">
                                        <input id="HKID" pattern="[A-Z][0-9]{6}[A-Z0-9]" type="text" class="form-control" name="HKID" placeholder="Please exclude brackets" maxlength="8" value="<?= $_SESSION["d_HKID"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Birthday:</label>
                                    <div class="">
                                        <input id="birthday" type="date" class="form-control" name="birthday" min="1900-01-01" max="2100-12-31" value="<?= $_SESSION["d_birthday"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Phone:</label>
                                    <div class="">
                                        <input id="phone" pattern="[0-9]{8}" type="tel" class="form-control" name="phone" maxlength="8" value="<?= $_SESSION["d_phone"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=""> Email:</label>
                                    <div class="">
                                        <input id="email" type="email" class="form-control" name="email" maxlength="255" value="<?= $_SESSION["d_email"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Address:</label>
                                    <div class="">
                                        <textarea id="address" class="form-control" name="address" rows="5" maxlength="255"><?= $_SESSION["d_address"] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Employment Date:</label>
                                    <div class="">
                                        <input id="employDate" type="date" class="form-control" name="employDate" min="1900-01-01" max="2100-12-31" value="<?= $_SESSION["d_employDate"] ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Department Code:</label>
                                    <div class="">
                                        <select class="form-control" name="departCode">
                                            <option value="">NA</option>
                                            <?php
                                                $departObj = new Department();
                                                
                                                $departlist = $departObj->getAllDepartmentRecord();
                                                foreach($departlist as $record) :
                                            ?>
                                                <option value="<?= $record["departmentCode"] ?>" <?php if($_SESSION["d_departCode"] == $record["departmentCode"]) echo "selected" ?>>
                                                    <?= $record["description"] ?>
                                                </option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Position:</label>
                                    <div class="">
                                        <input id="position" type="text" class="form-control" name="position" maxlength="30" value="<?= $_SESSION["d_position"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Leave Template:</label>
                                    <div class="">
                                        <select class="form-control" name="leaveTemplate">
                                            <?php
                                                $leaveTemplateObj = new LeaveTemplate();
                                                
                                                $templatelist = $leaveTemplateObj->getAllLeaveTemplate();
                                                foreach($templatelist as $record) :
                                            ?>
                                                <option value="<?= $record["leaveTemplateCode"] ?>" <?php if($_SESSION["d_leaveTemplate"] == $record["leaveTemplateCode"]) echo "selected" ?>>
                                                    <?= $record["description"] ?>
                                                </option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4>Bank Detail</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="">Account Number:</label>
                                    <div class="">
                                        <input id="accountNo" pattern="[0-9]{8,}" type="text" class="form-control" name="accountNo" maxlength="30" value="<?= $_SESSION["d_accountNo"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Account name:</label>
                                    <div class="">
                                        <input id="accountName" type="text" class="form-control" name="accountName" maxlength="30" value="<?= $_SESSION["d_accountName"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Bank name:</label>
                                    <div class="">
                                        <input id="bankName" type="text" class="form-control" name="bankName" maxlength="30" value="<?= $_SESSION["d_bankName"] ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Branch:</label>
                                    <div class="">
                                        <input id="branch" type="text" class="form-control" name="branch" maxlength="30" value="<?= $_SESSION["d_branch"] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                            if ($_SESSION["staffType"] == "h" ||
                                $_SESSION["staffType"] == "b")
                            echo '<button id="delete" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Delete</button>';
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary" value="Modify">
                            <span class="glyphicon glyphicon-edit"></span> Modify
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button type="reset" class="btn btn-warning" value="Reset" />
                            <i class="fa fa-undo"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
