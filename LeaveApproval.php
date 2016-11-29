<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Approval</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
        <h1>Leave Approval</h1>
        
        <?php
            $leaveTaken = new LeaveTaken();
            
            $list = $leaveTaken->getLeaveAllTakenRecord();
            $totalRecord = count($list);
            if($totalRecord > 0) :
        ?>
        <form method="post" action="LeaveAppProcess.php">
            <table>
                <tr>
                    <th>Staff ID</th>
                    <th>Leave Type</th>
                    <th>Leave Date</th>
                    <th>Approve</th>
                    <th>Reject</th>            
                </tr>
                <?php
                    for ($i = 0; $i < $totalRecord; $i++) :
                        $record = $list[$i];
                ?>
                <tr>
                    <td><?= $record["staffID"] ?></td>
                    <td><?= $record["leaveTypeCode"] ?></td>
                    <td><?= $record["leaveDate"] ?></td>
                    <td><input type="radio" name="approval[<?= $i ?>]" value="ap" checked /></td>
                    <td><input type="radio" name="approval[<?= $i ?>]" value="rj" /></td>
                    <input type="hidden" name="leaveID[<?= $i ?>]" value="<?= $record["id"] ?>" />
                </tr>
                <?php
                    endfor;
                ?>
            </table>
            <input type="hidden" name="action" value="approval" />
            <input type="submit" value="Confirm" />
        </form>
        <?php
            else :
                echo "No leave record to approve.";
            endif;
        ?>
    </div>
</body>

</html>
