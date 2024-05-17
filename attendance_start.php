<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

include("includes/connection.php");

if (!isset($_GET['start'])) {
    header("location: attendance.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance start</title>
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
            <h3 style="text-align: center;"> The attendance form is ready. </h3>
            <br>
            <p style="text-align: center;"> <a href="attendance.php"> OK </a> </p>
            <br>
        </div>
    </section>
</body>

</html>