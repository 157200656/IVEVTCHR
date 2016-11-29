<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Application Maintenance</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#delete").click(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
                
        $.ajax({
          url: 'LeaveAppProcess.php',
          type: 'post',
          data: {'action': 'delete'},
          success: function(data, status) {
            if(data == "ok") {
                alert("Success.");
                location.href = "LeaveInquiry.php";
			} else if(data == "reAddBalfail") {
				alert("Re-add balance fail.");
            } else if(data == "fail"){
                alert("Delete fail.");
            } else {
                alert(data);
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
    ?>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Leave Application Maintenance</h1>
            </div>
            <form id="Edit" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Staff ID:</label>
                    <div class="col-sm-6">
                        <?= $_SESSION["staffID"] ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Leave Type Code:</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="leaveTypeCode">
                            <?php
                                $leaveTemplateObj = new LeaveTemplate();
                                
                                $leaveTypelist = $leaveTemplateObj->getStaffLeaveTypeRecord($_SESSION["staffID"]);
                                foreach($leaveTypelist as $leaveType => $leaveTypeCode) :
                            ?>
                                <option value="<?= $leaveTypeCode ?>" <?php if($_SESSION["leaveTypeCode"]==$leaveTypeCode) echo "selected" ?>>
                                    <?= $leaveType ?>
                                </option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Leave Start Date:</label>
                    <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        <input id="startDate" class="form-control" type="date" name="startDate" min="1900-01-01" max="2100-12-31" value="<?= $_SESSION["startDate"] ?>" required />
                        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        <select class="form-control" name="startTakenUnit">
                            <option value="am" <?php if($_SESSION["startTakenUnit"]=="am") echo "selected" ?>>AM</option>
                            <option value="pm" <?php if($_SESSION["startTakenUnit"]=="pm") echo "selected" ?>>PM</option>
                            <option value="wd" <?php if($_SESSION["startTakenUnit"]=="wd") echo "selected" ?>>Whole day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Leave End Date:</label>
                    <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        <input id="endDate" class="form-control" type="date" name="endDate" min="1900-01-01" max="2100-12-31" value="<?= $_SESSION["endDate"] ?>" required />
                        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        <select class="form-control" name="endTakenUnit">
                            <option value="am" <?php if($_SESSION["endTakenUnit"]=="am") echo "selected" ?>>AM</option>
                            <option value="pm" <?php if($_SESSION["endTakenUnit"]=="pm") echo "selected" ?>>PM</option>
                            <option value="wd" <?php if($_SESSION["endTakenUnit"]=="wd") echo "selected" ?>>Whole day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Status:</label>
                    <div class="col-sm-6">
                        <?php
                            $statusDesc = '';
                            switch($_SESSION["status"])
                            {
                                case "PEN":
                                    $statusDesc .= "Pending";
                                    break;
                                case "WFA":
                                    $statusDesc .= "Waiting For Approve";
                                    break;
                                case "APV":
                                    $statusDesc .= "Approved";
                                    break;
                                case "REJ":
                                    $statusDesc .= "Rejected";
                                    break;
                            }
                            echo $statusDesc;
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <button id="delete" type="button" class="btn btn-danger" <?php if ($_SESSION["status"] !== "PEN") echo 'disabled'; ?>>
                            <span class="glyphicon glyphicon-remove"></span> Delete
                        </button>
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
