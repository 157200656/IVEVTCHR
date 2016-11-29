<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Leave Inquiry</title>
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
        <h1>Leave Inquiry</h1>
        <?php
            $leaveTaken = new LeaveTaken();
            
            $list = $leaveTaken->getOneStaffLeaveTakenRecord($_SESSION["staffID"]);
            if(sizeof($list) > 0) :
        ?>
        <table>
            <tr>
                <th>Leave Type</th>
                <th>Leave Start Date</th>
                <th>Leave End Date</th>
                <th>Taken</th>
                <th>Status</th>
                <th></th>
            </tr>
            <?php            
                foreach($list as $record) :
            ?>
            <tr>
                <form method="post" action="LeaveAppProcess.php">
                    <td><?= $record["leaveTypeCode"] ?></td>
                    <td><?= $record["startDate"] ?></td>
                    <td><?= $record["endDate"] ?></td>
                    <td><?= $record["taken"] ?></td>
                    <td>
                    <?php
                        $statusDesc = '';
                        switch($record["status"])
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
                    </td>
                    <input type="hidden" name="action" value="detail" />
                    <input type="hidden" name="leaveID" value="<?= $record["id"] ?>" />
                    <td><input type="submit" value="Detail" /></td>
                </form>
            </tr>
            <?php
                endforeach;
            ?>
        </table>
        <?php
            else :
                echo "No leave record.";
            endif;
        ?>
    </div>
</body>

</html>
