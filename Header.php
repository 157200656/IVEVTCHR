<?php

    include 'sql.php';
    
	session_start();
	
	if (!(isset($_SESSION["staffID"]) && isset($_SESSION["staffType"])))
	{
		header("Location: Login.html");
	}
    
    $staffType = $_SESSION["staffType"];
    
    if($staffType === "h" ||
        $staffType === "b") {
        $menuList = array(
                        "Department" => array(
                                        "Create Department" => "CreateDepartment.php",
                                        "Department List" => "DepartmentList.php"
                                        ),
                        "Employ" => array(
                                        "Create Employment" => "CreateEmploy.php",
                                        "Employment List" => "EmployList.php"
                                        ),
                        "Leave" => array(
                                        "Create Leave Type" => "CreateLeaveType.php",
                                        "Leave Type List" => "LeaveTypeList.php",
                                        "Create Leave Template" => "CreateLeaveTemplate.php",
                                        "Leave Template List" => "LeaveTemplateList.php"
                                        ),
                        "Attendance" => array(
                                        "Attendance Inquiry" => "AttendInquiry.php"
                                        )
                        );
    } else if($staffType === "a") {
        $menuList = array(
                        "Employ" => array(
                                        "Employment List" => "EmployList.php",
                                        "Employment Maintenance" => "EditEmploy.php"
                                        ),
                        "Leave" => array(
                                        "Leave Approval" => "LeaveApproval.php"
                                        ),
                        "Attendance" => array(
                                        "Attendance Inquiry" => "AttendInquiry.php"
                                        )
                        );
    } else if($staffType === "e") {
        $menuList = array(
                        "Employ" => array(
                                        "Employment Maintenance" => "EditEmploy.php"
                                        ),
                        "Leave" => array(
                                        "Create Leave Application" => "CreateLeaveApp.php",
                                        "Leave Inquiry" => "LeaveInquiry.php"
                                        ),
                        "Attendance" => array(
                                        "Attendance Inquiry" => "AttendInquiry.php"
                                        )
                        );
    }    
?>

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">HRMS</a>
        </div>
        <ul class="nav navbar-nav">
            <li>
                <a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a>
            </li>
            <?php
            foreach ($menuList as $group => $submenu) :
            ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $group ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                    foreach ($submenu as $menuName => $link) :
                ?>
                <li><a href="<?= $link ?>"><?= $menuName ?></a></li>
                <?php
                    endforeach;
                ?>
            </ul>
            </li>
            <?php
            endforeach;
            ?>
        </ul>
        <form class="navbar-form navbar-right" method="post" action="LoginProcess.php">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span> Logout</button>
        </form>
    </div><!-- /.container-fluid -->
</nav>