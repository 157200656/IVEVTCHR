<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Type List</title>
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
            <div class="page-header">
                <h1>Leave Type List</h1>
            </div>
            <?php
                unset($_SESSION['leaveTypeCode']);
                unset($_SESSION['description']);
                unset($_SESSION['yearStart']);
                unset($_SESSION['yearEnd']);
                unset($_SESSION['entitle']);
                
                $leaveTypeObj = new LeaveType();
                
                $list = $leaveTypeObj->getAllLeaveType();
                if(sizeof($list) > 0) :
            ?>
            <table class="table table-hover">
                <thead class="thead-default">
                    <tr>
                        <th>Leave Type Code</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($list as $record) :
                    ?>
                    <tr>
                        <form method="post" action="LeaveTypeProcess.php">
                            <td><input type="text" class="form-control" name="leaveType" value="<?= $record["leaveTypeCode"] ?>" readonly/></td>                            
                            <td><input type="text" class="form-control" name="description" value="<?= $record["description"] ?>" readonly/></td>                            
                            <input type="hidden" name="action" value="detail" />
                            <td>
                                <button type="submit" class="btn btn-info" value="Detail">
                                    <span class="glyphicon glyphicon-info-sign"></span> Detail
                                </button>
                            </td>
                        </form>
                    </tr>
                    <?php
                      endforeach;
                    ?>
                </tbody>
            </table>
            <?php
                else :
                    echo "No Leave Type record.";
                endif;
            ?>
        </div>
    </div>
</body>

</html>
