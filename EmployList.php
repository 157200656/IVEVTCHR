<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Employment List</title>
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
                <h1>Employment List</h1>
            </div>
            <?php
                unset($_SESSION['d_staffID']);
                unset($_SESSION['d_staffType']);
                unset($_SESSION['d_eName']);
                unset($_SESSION['d_cName']);
                unset($_SESSION['d_gender']);
                unset($_SESSION['d_HKID']);
                unset($_SESSION['d_birthday']);
                unset($_SESSION['d_phone']);
                unset($_SESSION['d_email']);
                unset($_SESSION['d_address']);
                unset($_SESSION['d_employDate']);
                unset($_SESSION['d_departCode']);
                unset($_SESSION['d_position']);
                unset($_SESSION['d_leaveTemplate']);
                unset($_SESSION['d_accountNo']);
                unset($_SESSION['d_accountName']);
                unset($_SESSION['d_bankName']);
                unset($_SESSION['d_branch']);
                
                $employObj = new Employ();
                
                if($_SESSION["staffType"] == "a") {
                    $list = $employObj->getEmployRecordByDepart($_SESSION["staffID"]);
                } else {
                    $list = $employObj->getAllEmployRecord();                
                }
                if(sizeof($list) > 0) :
            ?>
            <table class="table table-hover">
                <thead class="thead-default">
                    <tr>
                        <th>Staff ID</th>
                        <th>Staff Type</th>
                        <th>English name</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($list as $record) :
                    ?>
                    <tr>
                        <form method="post" action="EmployProcess.php">
                            <td> <input type="text" class="form-control" name="staffID" value="<?= $record["staffID"] ?>" readonly/></td>
                            <td>
                                <?php
                                    if($record["staffType"] == "e") {
                                        echo "Employee";
                                    } else if($record["staffType"] == "a") {
                                        echo "Supervisor";
                                    } else if($record["staffType"] == "b") {
                                        echo "Boss";
                                    }
                                ?>
                            </td>
                            <td><?= $record["englishName"] ?></td>
                            <td>
                                <?php
                                    $departObj = new Department();
                                    $detail = $departObj->getDepartmentRecord($record["departmentCode"]);
                                    if(sizeof($detail) > 0) {
                                        echo $detail["departmentCode"];
                                    }
                                ?>
                            </td>
                            <td><?= $record["position"] ?></td>
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
                    echo "No employment record.";
                endif;
            ?>
        </div>
    </div>
</body>

</html>
