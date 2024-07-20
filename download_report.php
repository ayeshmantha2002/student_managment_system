<?php
session_start();
include("includes/connection.php");

// Session and cookie handling
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("Location: login.php?login_first");
    exit();
}

// Prepare the headers for the download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Monthly_reports.xls");
header("Pragma: no-cache");
header("Expires: 0");

$data = array(); // Initialize the $data array

if (isset($_POST['monthly_submit'])) {
    $date_class = mysqli_real_escape_string($connection, $_POST['date_class']);
    $class_type = mysqli_real_escape_string($connection, $_POST['class_type']);
    $class_location = mysqli_real_escape_string($connection, $_POST['class_location']);
    $yr = mysqli_real_escape_string($connection, $_POST['yr']);
    $month_date = mysqli_real_escape_string($connection, $_POST['month_date']);
    $month = $yr . "-" . $month_date;

    $student_query = "SELECT * FROM `student` WHERE `Class` = '$date_class' AND `Student_ID` LIKE '%$class_location%'";
    $student_result = mysqli_query($connection, $student_query);

    $date_list = "SELECT DISTINCT `Date` FROM `attendance` WHERE `Class` = '$date_class' AND `Date` LIKE '%$month%'";
    $date_list_result = mysqli_query($connection, $date_list);

    if ($date_list_result->num_rows > 0) {
        while ($row = $date_list_result->fetch_assoc()) {
            $data[] = $row['Date'];
        }
    }

    echo "<table border='1'>
        <tr>
            <td colspan='6'>
                <h1 style='font-size: 16px; margin: 0; padding: 5px 0;'>The days of classes:</h1>
                <div style='padding: 5px 0;'>";
    if (!empty($data)) {
        foreach ($data as $date) {
            echo $date . "<br>";
        }
    }
    echo "      </div>
            </td>
        </tr>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Attendance</th>
            <th>Fees</th>
            <th>Monthly Attendance</th>
            <th>Annual Attendance</th>
        </tr>";

    if (mysqli_num_rows($student_result) > 0) {
        while ($students_list = mysqli_fetch_assoc($student_result)) {
            $Student_ID = $students_list['Student_ID'];

            // Initialize attendance data
            $attendance_data = '';
            $attendance_count = 0;

            $specific_dates = $data;

            foreach ($specific_dates as $current_date) {
                $attendance_query = "SELECT * FROM `attendance` WHERE `Date` = '$current_date' AND `Class` = '$date_class' AND `Type` = '$class_type' AND `Student_ID` = '$Student_ID'";
                $attendance_result = mysqli_query($connection, $attendance_query);

                if (mysqli_num_rows($attendance_result) > 0) {
                    $attendance_data .= '<span style="color: green;">1</span> ';
                    $attendance_count++;
                } else {
                    $attendance_data .= '<span style="color: red;">0</span> ';
                }
            }

            $total_days = count($specific_dates);
            $monthly_attendance_percentage = ($total_days > 0) ? ($attendance_count / $total_days) * 100 : 0;

            // Annual attendance calculation
            $annual_query = "SELECT DISTINCT `Date` FROM `attendance` WHERE `Class` = '$date_class' AND `Type` = '$class_type'";
            $annual_result = mysqli_query($connection, $annual_query);

            $annual_total_days = 0;
            $annual_attendance_count = 0;

            if ($annual_result->num_rows > 0) {
                $annual_data = array();

                while ($row = $annual_result->fetch_assoc()) {
                    $annual_data[] = $row['Date'];
                }

                $annual_total_days = count($annual_data);

                foreach ($annual_data as $current_date) {
                    $annual_attendance_query = "SELECT * FROM `attendance` WHERE `Student_ID` = '$Student_ID' AND `Type` = '$class_type' AND `Date` = '$current_date'";
                    $annual_attendance_result = mysqli_query($connection, $annual_attendance_query);

                    if (mysqli_num_rows($annual_attendance_result) > 0) {
                        $annual_attendance_count++;
                    }
                }
            }

            $annual_attendance_percentage = ($annual_total_days > 0) ? ($annual_attendance_count / $annual_total_days) * 100 : 0;

            $fees_query = "SELECT * FROM `class_fees` WHERE `Date` LIKE '%$month%' AND `Student_ID` = '$Student_ID' LIMIT 1";
            $fees_result = mysqli_query($connection, $fees_query);

            $paid = (mysqli_num_rows($fees_result) > 0) ? "Paid" : "-";

            echo "<tr>
                    <td>" . $students_list['Student_ID'] . "</td>
                    <td>" . $students_list['First_name'] . " " . $students_list['Last_name'] . "</td>
                    <td style='font-weight: bold;'>" . trim($attendance_data) . "</td>
                    <td style='color: green;'>$paid</td>
                    <td>" . number_format($monthly_attendance_percentage, 2) . "%</td>
                    <td style='text-align: center; font-size: 20px;'>" . number_format($annual_attendance_percentage, 2) . "%</td>
                </tr>";
        }
    }

    echo "</table>";
}
