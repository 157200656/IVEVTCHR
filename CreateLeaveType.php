<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Type Creation</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
                    <h1>Leave Type Creation</h1>
                </div>
                <form class="form-horizontal" method="post" action="LeaveTypeProcess.php">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Leave Type Code:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="leaveTypeCode" maxlength="30" required />
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-sm-4">Description:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="description" maxlength="30" />
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
                                    <td><input type="number" class="form-control" name="yearStart[]" min="1" max="999" /></td>
                                    <td><input type="number" class="form-control" name="yearEnd[]" min="1" max="999" /></td>
                                    <td><input type="number" class="form-control" name="entitle[]" min="1" max="99" /></td>
                                </tr>
                            <?php
                                endfor;
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="action" value="create" />
                    <div class="form-group">
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
