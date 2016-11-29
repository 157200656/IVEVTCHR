<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Type Maintenance</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){    
    $("#delete").click(function(){        
        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();
        
        $.ajax({
          url: 'LeaveTypeProcess.php',
          type: 'post',
          data: {'action': 'delete'},
          success: function(data, status) {
            if(data == "ok") {
				alert("Record deleted.");
                location.href = "LeaveTypeList.php";
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
.thead-default th{
    color:#55595c;
    background-color:#eceeef
}
</style>
</head>

<body>

    <?php
        include 'Header.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>.
            <div class="col-sm-6">
                <div class="page-header">
                    <h1>Leave Type Maintenance</h1>
                </div>
                <form class="form-horizontal" method="post" action="LeaveTypeProcess.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Leave Type Code:</label>
                        <div class="col-sm-8">
                            <?= $_SESSION['leaveTypeCode'] ?>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-sm-4">Description:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="description" maxlength="30" value="<?= $_SESSION["description"] ?>" />
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-default">
                            <tr>
                                <th>Start year</th>
                                <th>End year</th>
                                <th>Entitle Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($x = 0; $x < 10; $x++) :
                            ?>
                                <tr>
                                    <?php
                                        $start = "";
                                        $end = "";
                                        $entitle = "";
                                        if(!empty($_SESSION['yearStart'][$x])) {
                                            $start = $_SESSION['yearStart'][$x];
                                        }
                                        if(!empty($_SESSION['yearEnd'][$x])) {
                                            $end = $_SESSION['yearEnd'][$x];
                                        }
                                        if(!empty($_SESSION['entitle'][$x])) {
                                            $entitle = $_SESSION['entitle'][$x];
                                        }
                                    ?>
                                    <td><input type="number" class="form-control" name="yearStart[]" min="1" max="999" value="<?= $start ?>" /></td>
                                    <td><input type="number" class="form-control" name="yearEnd[]" min="1" max="999" value="<?= $end ?>" /></td>
                                    <td><input type="number" class="form-control" name="entitle[]" min="1" max="99" value="<?= $entitle ?>" /></td>
                                </tr>
                            <?php
                                endfor;
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="action" value="edit" />
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
