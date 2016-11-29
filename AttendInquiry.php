<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Attendance Inquiry</title>
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
        <h1>Attendance Inquiry</h1>        
        <?php
            $attendObj = new Attendance();
            
            $list = $attendObj->getAttendanceRecord($_SESSION["staffID"]);
            if(sizeof($list) > 0) :
        ?>
        <table>
            <tr>
                <th>Staff ID</th>
                <th>English name</th>
                <th>Date</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Site</th>
                <th>Leave Type</th>            
                <th>Taken</th>
            </tr>
            <?php
                foreach($list as $row) :
            ?>
            <tr>
                <td><?= $row["staffID"] ?></td>
                <td></td>
                <td></td>
                <td><?= $row["attendance"] ?></td>
                <td></td>
                <td><?= $row["site"] ?></td>
                <td></td>            
                <td></td>
            </tr>
            <?php
              endforeach;
            ?>
        </table>        
        <?php
            else :
                echo "No attendance record.";
            endif;
        ?>
    </div>
</body>

</html>
