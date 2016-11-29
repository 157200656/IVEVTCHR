<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Application Creation</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#Create").submit(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        var leaveTypeCode = $('select[name=leaveTypeCode]').val();
        var startDate = $('#startDate').val();
        var startTakenUnit = $("select[name=startTakenUnit]").val();
        var endDate = $('#endDate').val();
        var endTakenUnit = $("select[name=endTakenUnit]").val();
        
        if (startDate > endDate) {
            alert("Invalid start end date.");
        } else if(startDate != endDate &&
            (startTakenUnit == 'am' || endTakenUnit = 'pm'))
        {
            var invalidTakenUnit = '';
            if(startTakenUnit == 'am')
                invalidTakenUnit = 'Invalid start date unit.';
            else
                invalidTakenUnit = 'Invalid end date unit.';
            alert(invalidTakenUnit);
        }
        else {
            $.ajax({
              url: 'LeaveAppProcess.php',
              type: 'post',
              data: {'leaveTypeCode': leaveTypeCode, 'startDate': startDate, 'startTakenUnit': startTakenUnit, 
              'endDate': endDate, 'endTakenUnit': endTakenUnit, 'action': 'create'},
              success: function(data, status) {
                if(data == "ok") {
                    alert("Record inserted.");
                    location.reload();
                } else if(data == "balUpdateFail") {
                    alert("Deduct balance fail.");
                } else if(data == "overtaken") {
                    alert("Overtaken.");
                } else if(data == "noBalRecord") {
                    alert("No balance record.");
                } else if(data == "overBalance") {
                    alert("Take over than balance.");
                } else if(data == "fail") {
                    alert("Insert fail.");
                } else {
                    alert(data);
                }
              },
              error: function(xhr, desc, err) {
                aler(err);
              }
            }) // end ajax call            
        }
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
                <h1>Leave Application Creation</h1>
            </div>
            <form id="Create" class="form-horizontal">
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
                                <option value="<?= $leaveTypeCode ?>"><?= $leaveType ?></option>
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
                        <input id="startDate" class="form-control" type="date" name="startDate" min="1900-01-01" max="2100-12-31" required />
                        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        <select class="form-control" name="startTakenUnit">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                            <option value="wd" selected>Whole day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <label class="control-label col-sm-2">Leave End Date:</label>
                    <div class="col-sm-6 input-group">
                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        <input id="endDate" class="form-control" type="date" name="endDate" min="1900-01-01" max="2100-12-31" required />
                        <span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span>
                        <select class="form-control" name="endTakenUnit">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                            <option value="wd" selected>Whole day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success" value="Create">
                            <span class="glyphicon glyphicon-plus"></span> Create
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
