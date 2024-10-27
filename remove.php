<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

include("includes/connection.php");
$today = date("Y-m-d");

if (isset($_POST['delete_ID'])) {
    $delete_attendance = "DELETE FROM `attendance` WHERE `ID` = {$_POST['delete_ID']}";
    $delete_attendance_result = mysqli_query($connection, $delete_attendance);

    // tutes
    $check_tutes = "DELETE FROM `deliverd_tute` WHERE `ST_ID` = {$_POST['ST_ID']} AND `Class` = '{$_COOKIE['cookieClass']}' AND `Date` = '{$today}'";
    $check_tutes_result = mysqli_query($connection, $check_tutes);

    // tutes
    $check_tutes = "DELETE FROM `class_fees` WHERE `ST_ID` = {$_POST['ST_ID']} AND `Class` = '{$_COOKIE['cookieClass']}' AND `Date` = '{$today}'";
    $check_tutes_result = mysqli_query($connection, $check_tutes);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Removed</title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo " <link rel='stylesheet' href='assect/css/dark.css'> ";
    }
    ?>
</head>

<body>
    <!-- start_attendance cookies message  -->
    <section class="popup_forms" style="z-index: 1; opacity: 1;">
        <div class="pop_form">
            <p style="text-align: center;"> <img width="100px" src="assect/img/imgs/done.png" alt="done"> </p>
            <h3 style="text-align: center;"> Removed. </h3>
            <br>
            <p style="text-align: center;"> <a href="attendance.php"> OK </a> </p>
            <br>
        </div>
    </section>
</body>

</html>