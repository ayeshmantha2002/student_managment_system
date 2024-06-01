<?php
session_start();
include("includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// download proccess
if ($_POST['download']) {
    $class_ID = mysqli_real_escape_string($connection, $_POST['view_class']);

    // fetch class details 
    $class_details = "SELECT * FROM `class_date` WHERE `ID` = {$class_ID}";
    $class_details_result = mysqli_query($connection, $class_details);
    if (mysqli_num_rows($class_details_result)) {
        $class_details_fetch = mysqli_fetch_assoc($class_details_result);
        $Location = $class_details_fetch['Location'];
        $Class = $class_details_fetch['Class'];
        $Type = $class_details_fetch['Type'];
        $Date = $class_details_fetch['Date'];

        if ($Type == "T") {
            $classType = "Theory";
        } elseif ($Type == "R") {
            $classType = "Revision";
        } elseif ($Type == "P") {
            $classType = "Paper";
        }

        // location & class code 
        $location_list = "SELECT * FROM `location` WHERE `location` = '{$Location}'";
        $location_list_result = mysqli_query($connection, $location_list);
        if (mysqli_num_rows($location_list_result) > 0) {
            $location_fetch = mysqli_fetch_assoc($location_list_result);
            $class_code = $location_fetch['UID'];
        }
    }

    // attendance list 
    $st_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}'";
    $st_list_result = mysqli_query($connection, $st_list);

    // total student list 
    $count_st_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}'";
    $count_st_list_result = mysqli_query($connection, $count_st_list);
    if ($count_st_list_result) {
        $total_st = mysqli_num_rows($count_st_list_result);
    }

    // count today attendance
    $count_attendance = "SELECT * FROM `attendance` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}' AND `Date` = '{$Date}' AND `Type` = '{$Type}'";
    $count_attendance_result = mysqli_query($connection, $count_attendance);
    if ($count_attendance_result) {
        $total_attendance = mysqli_num_rows($count_attendance_result);
    }

    // count tutes
    $count_tutes = "SELECT * FROM `deliverd_tute` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}' AND `Date` = '{$Date}'";
    $count_tutes_result = mysqli_query($connection, $count_tutes);
    if ($count_tutes_result) {
        $total_tutes = mysqli_num_rows($count_tutes_result);
    }

    // count Fees
    $count_fees = "SELECT * FROM `class_fees` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}' AND `Date` = '{$Date}'";
    $count_fees_result = mysqli_query($connection, $count_fees);
    if ($count_fees_result) {
        $total_fees = mysqli_num_rows($count_fees_result);
    }

    $absent = $total_st - $total_attendance;

    echo "<table>
                <tr>
                    <th colspan='5'> {$Date}  </th>
                </tr>
                <tr>
                    <th> Today attendance : </th>
                    <th> $total_attendance </th>
                </tr>        
                <tr>
                    <th> Today absent : </th>
                    <th> $absent </th>
                </tr>        
                <tr>
                    <th> Tute delivery today : </th>
                    <th> $total_tutes </th>
                </tr>        
                <tr>
                    <th> Number of cards today : </th>
                    <th> $total_fees </th>
                </tr>        
            </table>";

    echo "<br><br>";

    if (mysqli_num_rows($st_list_result) > 0) {
        $output = "
            <table>
                <tr>
                    <th> Student ID </th>
                    <th> Student Name </th>
                    <th> Fees </th>
                    <th> Tute </th>
                    <th> Arrival </th>
                </tr>
            ";
        while ($st_det = mysqli_fetch_assoc($st_list_result)) {
            $StudentID = $st_det['Student_ID'];
            $StudentFullName = $st_det['First_name'] . " " . $st_det['Last_name'];

            // present list
            $attendance_list = "SELECT * FROM `attendance` WHERE `Student_ID` = '{$StudentID}' AND `Class` = '{$Class}' AND `Date` = '{$Date}' AND `Type` = '{$Type}'";
            $attendance_list_result = mysqli_query($connection, $attendance_list);

            // tutes
            $delivery_tutes = "SELECT * FROM `deliverd_tute` WHERE `Student_ID` = '{$StudentID}' AND `Class` = '{$Class}' AND `Date` = '{$Date}'";
            $delivery_tutes_result = mysqli_query($connection, $delivery_tutes);
            if (mysqli_num_rows($delivery_tutes_result)) {
                $take_tute = "TAKE";
            } else {
                $take_tute = "-";
            }

            // Fees
            $paid_fees = "SELECT * FROM `class_fees` WHERE `Student_ID` = '{$StudentID}' AND `Class` = '{$Class}' AND `Date` = '{$Date}'";
            $paid_fees_result = mysqli_query($connection, $paid_fees);
            if (mysqli_num_rows($paid_fees_result)) {
                $paid = "PAID";
            } else {
                $paid = "-";
            }

            if (mysqli_num_rows($attendance_list_result) == 1) {
                $output .= "
                    <tr>
                        <td> {$StudentID} </td>
                        <td> {$StudentFullName} </td>
                        <td> <p class='paid'>{$paid}</p> </td>
                        <td> {$take_tute} </td>
                        <td> <p> Present </p> </td>
                    </tr>
                    ";
            } else {
                // absent list 
                $output .= "
                    <tr>
                        <td> {$StudentID} </td>
                        <td> {$StudentFullName} </td>
                        <td> <p> {$paid} </p> </td>
                        <td> {$take_tute} </td>
                        <td> <p> Absent </td>
                    </tr>
                    ";
            }
        }
        $output .= "</table>";

        header("Content-Type:application/xls");
        header("Content-Disposition:attachment;filename={$Date}_reports.xls");

        echo $output;
    } else {
        echo "No data found";
    }
}
