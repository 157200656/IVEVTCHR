<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Department Creation</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $("#Create").submit(function(event){
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        var departmentCode = $('#departmentCode').val();
        var description = $('#description').val();
        
        $.ajax({
          url: 'DepartmentProcess.php',
          type: 'post',
          data: {'departmentCode': departmentCode, 'description': description, 'action': 'create'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record inserted.");
				location.reload();
            } else {
                alert("Insert fail.");
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
                    <h1>Department Creation</h1>
                </div>
                <form id="Create" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Department Code:</label>
                        <div class="col-sm-8">
                            <input id="departmentCode" type="text" class="form-control" name="departmentCode" maxlength="10" size="10" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Description:</label>
                        <div class="col-sm-8">
                            <input id="description" type="text" class="form-control" name="description" maxlength="30" size="30" required />
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
    </div>
</body>

</html>
