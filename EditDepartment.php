<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Department Maintenance</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#Edit").submit(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        var description = $('#description').val();
        
        $.ajax({
          url: 'DepartmentProcess.php',
          type: 'post',
          data: {'description': description, 'action': 'edit'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record updated.");
            } else {
                alert("Update fail.");
				location.reload();
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
          url: 'DepartmentProcess.php',
          type: 'post',
          data: {'action': 'delete'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record deleted.");
                location.href = "DepartmentList.php";
            } else {
                alert("Delete fail.");
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
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <h1>Department Maintenance</h1>
                </div>
                <form id="Edit" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Department Code:</label>
                        <div class="col-sm-8">
                            <?= $_SESSION["departmentCode"] ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Description:</label>
                        <div class="col-sm-8">
                            <input id="description" type="text" class="form-condivol" name="description" maxlength="30" size="30" value="<?= $_SESSION["description"] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
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
    </div>
</body>

</html>
