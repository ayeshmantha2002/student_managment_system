<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

if (!isset($_GET['view_class'])) {
    header("location: add-class.php?select_class");
}

$today = date("Y-m-d");

include("includes/connection.php");

// classes
$classes = "SELECT * FROM `class`";
$classes_result = mysqli_query($connection, $classes);

// Locations
$Locations = "SELECT * FROM `location`";
$Locations_result = mysqli_query($connection, $Locations);

if (isset($_GET['view_class'])) {
    $class_ID = mysqli_real_escape_string($connection, $_GET['view_class']);

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
}

// class List
$class_list = "SELECT * FROM `class_date` WHERE `Date` <= '{$today}' ORDER BY `Date` DESC";
$class_list_result = mysqli_query($connection, $class_list);

// attendance list 
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $st_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '{$class_code}{$search}%') AND `Class` = '{$Class}'";
} else {
    $st_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '{$class_code}%') AND `Class` = '{$Class}'";
}
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

// filter option 
if (isset($_POST['present'])) {
    $absent = "none";
} else {
    $absent = "";
}

if (isset($_POST['absent'])) {
    $present = "none";
} else {
    $present = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> VIEW DETAILS </title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo " <link rel='stylesheet' href='assect/css/dark.css'> ";
    }
    ?>
</head>

<body>
    <div class="webcontent">
        <?php
        include("includes/sidenav.php");
        ?>

        <section class="content">
            <div class="date">
                <h1> VIEW CLASS DETAILS </h1>
                <h1> <?php echo date("Y-M-d"); ?> </h1>
            </div>
            <br>
            <div class="search">
                <form method="post">
                    <p> <input type="search" name="search" placeholder="Search student number or name." autofocus> </p>
                </form>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <div>
                        <h2> Class Details </h2>
                        <br>
                        <form>
                            <p>
                                <label for="class"> Class : </label>
                                <input type="text" value="<?= $Class . " | " . $classType . " | " . $Location . " | " . $Date; ?>" readonly>
                            </p>
                        </form>
                    </div>
                    <div id="class_list">
                        <h2> Class List </h2>
                        <br>
                        <?php
                        if (mysqli_num_rows($class_list_result) > 0) {
                            while ($view_class = mysqli_fetch_assoc($class_list_result)) {
                                echo "
                            <div class='class_list'>
                                <p> {$view_class['Date']} </p>
                                <p> {$view_class['Location']} </p>
                                <p> {$view_class['Class']} / {$view_class['Type']} </p>
                                <a href='view-class-details.php?view_class={$view_class['ID']}'> VIEW </a>
                            </div>
                            ";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="students">
                    <div class="details">
                        <div class="table">
                            <table>
                                <tr>
                                    <th> Student ID </th>
                                    <th> Student Name </th>
                                    <th> Fees </th>
                                    <th> Tute </th>
                                    <th> Arrival </th>
                                </tr>
                                <?php
                                if (mysqli_num_rows($st_list_result) > 0) {
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
                                            $take_tute = "";
                                        }

                                        // Fees
                                        $paid_fees = "SELECT * FROM `class_fees` WHERE `Student_ID` = '{$StudentID}' AND `Class` = '{$Class}' AND `Date` = '{$Date}'";
                                        $paid_fees_result = mysqli_query($connection, $paid_fees);
                                        if (mysqli_num_rows($paid_fees_result)) {
                                            $paid = "PAID";
                                        } else {
                                            $paid = "";
                                        }

                                        if (mysqli_num_rows($attendance_list_result) == 1) {
                                            echo "
                                                <tr style='display: {$present};'>
                                                    <td> {$StudentID} </td>
                                                    <td> {$StudentFullName} </td>
                                                    <td> <p class='paid'>{$paid}</p> </td>
                                                    <td> {$take_tute} </td>
                                                    <td> <p> <img width='20px' src='assect/img/imgs/done.png' alt='x'> </p> </td>
                                                </tr>
                                                ";
                                        } else {
                                            // absent list 
                                            echo "
                                                <tr style='background-color: lightpink; display: {$absent}; color: #000;'>
                                                    <td> {$StudentID} </td>
                                                    <td> {$StudentFullName} </td>
                                                    <td> <p> {$paid} </p> </td>
                                                    <td> {$take_tute} </td>
                                                    <td> <p> <img width='20px' src='assect/img/imgs/x-png.png' alt='x'> </p> </td>
                                                </tr>
                                                ";
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div id="attendance_details">
                            <div class="attendance_details">
                                <h2 style="text-align: center;"> TODAY RESULT </h2>
                                <br><br>
                                <h3> Today attendance : <?= $total_attendance; ?> </h3>
                                <br>
                                <h3> Today absent : <?= $total_st - $total_attendance; ?> </h3>
                                <br>
                                <h3> Tute delivery today : <?= $total_tutes; ?> </h3>
                            </div>
                            <div class="attendance_filter">
                                <h2> Filter Option </h2>
                                <br>
                                <form method="post">
                                    <p> <input type="submit" name="present" value="Present"> </p>
                                    <br>
                                    <p> <input type="submit" name="absent" value="Absent" style="background-color: tomato;"> </p>
                                </form>
                            </div>
                            <div class="attendance_filter">
                                <form action="download.php" method="post">
                                    <h2> Download Report </h2>
                                    <br>
                                    <p> <input type="text" name="view_class" value="<?= $class_ID; ?>" readonly hidden> </p>
                                    <p> <input type="submit" name="download" value="DOWNLOAD"> </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
    <script src="assect/js/secu.js"></script>
</body>

</html>