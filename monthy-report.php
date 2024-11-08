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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo '<link rel="stylesheet" href="assect/css/dark.css">';
    }
    ?>
    <style>
        .students {
            width: 100%;
            height: calc(100vh - 80px);
            overflow: scroll;
            border-left: 1px solid var(--shadow);
            padding: 0 30px;
            box-sizing: border-box;
        }
    </style>

</head>

<body>
    <div class="webcontent">
        <?php include("includes/sidenav.php"); ?>

        <section class="content">
            <div class="date">
                <h1>MONTHLY REPORT</h1>
                <p style="color: red; font-weight: bold;">
                    <?php
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo $error . '<br>';
                        }
                    }
                    ?>
                </p>
                <h1><?php echo date("Y / M / d"); ?></h1>
            </div>
            <br>
            <div class="students">
                <div class="details">
                    <div class="table">
                        <table>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Attendance</th>
                                <th>Fees</th>
                                <th>Monthly Attendance</th>
                                <th>Annual Attendance</th>
                            </tr>
                            <?php
                            if (isset($_POST['monthly_submit'])) {
                                $date_class = mysqli_real_escape_string($connection, $_POST['date_class']);
                                $class_type = mysqli_real_escape_string($connection, $_POST['class_type']);
                                $class_location = mysqli_real_escape_string($connection, $_POST['class_location']);
                                $yr = mysqli_real_escape_string($connection, $_POST['yr']);
                                $month_date = mysqli_real_escape_string($connection, $_POST['month_date']);
                                $month = $yr . "-" . $month_date;

                                $months = [
                                    "01" => "January",
                                    "02" => "February",
                                    "03" => "March",
                                    "04" => "April",
                                    "05" => "May",
                                    "06" => "June",
                                    "07" => "July",
                                    "08" => "August",
                                    "09" => "September",
                                    "10" => "October",
                                    "11" => "November",
                                    "12" => "December"
                                ];

                                if (array_key_exists($month_date, $months)) {
                                    $filter_month = $months[$month_date];
                                } else {
                                    $filter_month = "Invalid Month";
                                }

                                $month_fees = $yr . " " . $filter_month;

                                $student_query = "SELECT * FROM `student` WHERE `Class` = '$date_class' AND `Student_ID` LIKE '%$class_location%'";
                                $student_result = mysqli_query($connection, $student_query);

                                $date_list = "SELECT DISTINCT `Date` FROM `attendance` WHERE `Class` = '$date_class' AND `Type` = '{$class_type}' AND `Date` LIKE '%$month%'";
                                $date_list_result = mysqli_query($connection, $date_list);

                                if ($date_list_result->num_rows > 0) {
                                    $data = array();

                                    while ($row = $date_list_result->fetch_assoc()) {
                                        $data[] = $row['Date'];
                                    }
                                } else {
                                    $data = array();
                                }

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

                                        $fees_query = "SELECT * FROM `class_fees` WHERE `Year_month` = ' $month_fees ' AND `Student_ID` = '$Student_ID' AND `Class` = '$date_class' LIMIT 3";
                                        $fees_result = mysqli_query($connection, $fees_query);

                                        $paid = "-"; // Default value if no payment is found
                                        if (mysqli_num_rows($fees_result) > 0) {
                                            $row = mysqli_fetch_assoc($fees_result);
                                            $paid = $row['Date']; // Assign the date of payment
                                        }

                                        $row_class = $annual_attendance_percentage < 80 ? 'low-attendance' : '';
                                        $row_class .= $paid === "-" ? ' low-fees' : '';


                                        echo "<tr class='$row_class'>
                                            <td>" . $students_list['Student_ID'] . "</td>
                                            <td>" . $students_list['First_name'] . " " . $students_list['Last_name'] . "</td>
                                            <td style='font-weight: bold;'>" . trim($attendance_data) . "</td>
                                            <td style='color: green;'>$paid</td>
                                            <td>" . number_format($monthly_attendance_percentage, 2) . "%</td>
                                            <td style='text-align: center; font-size: 20px;'>" . number_format($annual_attendance_percentage, 2) . "%</td>
                                        </tr>";
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div id="attendance_details">
                        <div class="attendance_details">
                            <h2 style="text-align: center;">MONTHLY REPORT</h2>
                            <br><br>
                            <h3 style="text-align: center;">The days of classes:</h3>
                            <br>
                            <?php
                            if (!empty($data)) {
                                foreach ($data as $date) {
                                    echo "<h4>$date</h4>";
                                }
                            }
                            ?>
                            <br><br>

                            <!-- Card Details Section -->
                            <div class="card-details">
                                <h3 style="text-align: center;">Card Details:</h3>
                                <br>
                                <?php
                                // Query to get card details
                                $full_card_query = "SELECT COUNT(*) as full_card_count FROM `class_fees` WHERE `ST_name` = 'full' AND `Date` LIKE '%$month%' AND `Class` = '$date_class'";
                                $half_card_query = "SELECT COUNT(*) as half_card_count FROM `class_fees` WHERE `ST_name` = 'half' AND `Date` LIKE '%$month%' AND `Class` = '$date_class'";
                                $free_card_query = "SELECT COUNT(*) as free_card_count FROM `class_fees` WHERE `ST_name` = 'free' AND `Date` LIKE '%$month%' AND `Class` = '$date_class'";

                                $full_card_result = mysqli_query($connection, $full_card_query);
                                $half_card_result = mysqli_query($connection, $half_card_query);
                                $free_card_result = mysqli_query($connection, $free_card_query);

                                $full_card_count = mysqli_fetch_assoc($full_card_result)['full_card_count'];
                                $half_card_count = mysqli_fetch_assoc($half_card_result)['half_card_count'];
                                $free_card_count = mysqli_fetch_assoc($free_card_result)['free_card_count'];

                                echo "<h4>Full Cards: $full_card_count</h4>";
                                echo "<h4>Half Cards: $half_card_count</h4>";
                                echo "<h4>Free Cards: $free_card_count</h4>";
                                ?>
                            </div>
                        </div>

                        <div class="attendance_filter">
                            <form action="download_report.php" method="post">
                                <h2>Download Report</h2>
                                <input type="hidden" name="date_class" value="<?php echo htmlspecialchars($date_class); ?>">
                                <input type="hidden" name="class_type" value="<?php echo htmlspecialchars($class_type); ?>">
                                <input type="hidden" name="class_location" value="<?php echo htmlspecialchars($class_location); ?>">
                                <input type="hidden" name="yr" value="<?php echo htmlspecialchars($yr); ?>">
                                <input type="hidden" name="month_date" value="<?php echo htmlspecialchars($month_date); ?>">
                                <br>
                                <p><input type="submit" name="monthly_submit" value="DOWNLOAD"></p>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>