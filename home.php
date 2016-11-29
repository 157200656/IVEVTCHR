<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
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
    
    unset($_SESSION['d_staffID']);
    unset($_SESSION['d_staffType']);
    unset($_SESSION['d_eName']);
    unset($_SESSION['d_cName']);
    unset($_SESSION['d_gender']);
    unset($_SESSION['d_HKID']);
    unset($_SESSION['d_birthday']);
    unset($_SESSION['d_employDate']);
    unset($_SESSION['d_departCode']);
    unset($_SESSION['d_leaveTemplate']);
    
    unset($_SESSION['departmentCode']);
    unset($_SESSION['description']);
    
    unset($_SESSION['leaveTypeCode']);
    unset($_SESSION['yearStart']);
    unset($_SESSION['yearEnd']);
    unset($_SESSION['entitle']);
    
    unset($_SESSION['leaveTemplateCode']);
    unset($_SESSION['annualLeave']);
    unset($_SESSION['sickLeave']);
    unset($_SESSION['maternityLeave']);
    unset($_SESSION['paternityLeave']);
    unset($_SESSION['speacialLeave']);
?>

</body>

</html>
