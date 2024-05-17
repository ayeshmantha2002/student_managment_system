<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

include("includes/connection.php");

//set cookie
if (isset($_GET['start_attendance'])) {
    $classID = mysqli_real_escape_string($connection, $_GET['class']);

    $classDetails = "SELECT * FROM `class_date` WHERE `ID` = '{$classID}'";
    $classDetails_result = mysqli_query($connection, $classDetails);

    if (mysqli_num_rows($classDetails_result) > 0) {
        $fetch_class_details = mysqli_fetch_assoc($classDetails_result);
        $cookieClass = $fetch_class_details['Class'];
        $cookieLocation = $fetch_class_details['Location'];
        $cookieType = $fetch_class_details['Type'];

        setcookie('cookieClass', $cookieClass, time() + 60 * 60 * 12);
        setcookie('cookieLocation', $cookieLocation, time() + 60 * 60 * 12);
        setcookie('cookieType', $cookieType, time() + 60 * 60 * 12);

        if (isset($_GET['enable_tutes'])) {
            if ($_GET['enable_tutes'] == 'true') {
                setcookie('cookieTute', 'true', time() + 60 * 60 * 12);
            } else {
                setcookie('cookieTute', NULL, -time() + 60 * 60 * 12);
            }
        }
        header("location: attendance_start.php?start");
    }
}

// give a tute 
if (isset($_COOKIE['cookieTute'])) {
    $tute = "";
    $tuteValue = " Giving today ";
} else {
    $tute = "display: none;";
    $tuteValue = " Not today's delivery ";
}

// clear cookies 
if (isset($_GET['clear'])) {
    setcookie('cookieClass', NULL, -time() + 60 * 60 * 12);
    setcookie('cookieLocation', NULL, -time() + 60 * 60 * 12);
    setcookie('cookieType', NULL, -time() + 60 * 60 * 12);
    setcookie('cookieTute', NULL, -time() + 60 * 60 * 12);
}


// check today class
$today_date = date("Y-m-d");
$today_class = "SELECT * FROM `class_date` WHERE `Date` = '{$today_date}'";
$today_class_result = mysqli_query($connection, $today_class);

// check student
$user = "";
if (isset($_COOKIE['cookieClass'])) {

    // location & class code 
    $location_list = "SELECT * FROM `location` WHERE `location` = '{$_COOKIE['cookieLocation']}'";
    $location_list_result = mysqli_query($connection, $location_list);
    if (mysqli_num_rows($location_list_result) > 0) {
        $location_fetch = mysqli_fetch_assoc($location_list_result);
        $class_code = $location_fetch['UID'];
    }

    // search student 
    if (isset($_POST['search'])) {
        $st_id = mysqli_real_escape_string($connection, $_POST['search']);
        $check_student = "SELECT * FROM `student` WHERE `Student_ID` = '{$class_code}{$st_id}' AND `Class` = '{$_COOKIE['cookieClass']}'";
        $check_student_result = mysqli_query($connection, $check_student);

        // today recode 
        $check_tody = "SELECT * FROM `attendance` WHERE `Student_ID` = '{$class_code}{$st_id}' AND `Class` = '{$_COOKIE['cookieClass']}' AND `Date` = '{$today_date}'";
        $check_tody_result = mysqli_query($connection, $check_tody);

        if (mysqli_num_rows($check_tody_result) > 0) {
            $check_tody_result_fetch = mysqli_fetch_assoc($check_tody_result);
            $recode_ID = $check_tody_result_fetch['ID'];
            $recode_display = "hidden";
            $recode_display_form2 = "";
        } else {
            $recode_display = "";
            $recode_display_form2 = "hidden";
        }

        // last 3 month fees 
        $check_fees = "SELECT * FROM `class_fees` WHERE `Student_ID` = '{$class_code}{$st_id}' AND `Class` = '{$_COOKIE['cookieClass']}' ORDER BY `ID` DESC LIMIT 4";
        $check_fees_result = mysqli_query($connection, $check_fees);

        // last 3 tutes
        $check_tutes = "SELECT * FROM `deliverd_tute` WHERE `Student_ID` = '{$class_code}{$st_id}' AND `Class` = '{$_COOKIE['cookieClass']}' ORDER BY `ID` DESC LIMIT 4";
        $check_tutes_result = mysqli_query($connection, $check_tutes);


        if (mysqli_num_rows($check_student_result) > 0) {
            $student_details = mysqli_fetch_assoc($check_student_result);
            $ST_ID = $student_details['ID'];
            $student_ID = $student_details['Student_ID'];
            $student_fname = $student_details['First_name'];
            $student_lname = $student_details['Last_name'];
            $student_pnumber = $student_details['Phone_number'];

            $full_name = $student_fname . " " . $student_lname;

            setcookie('full_name', $full_name, time() + 60 * 60);
            setcookie('ST_ID', $ST_ID, time() + 60 * 60);
            setcookie('student_ID', $student_ID, time() + 60 * 60);
            setcookie('student_pnumber', $student_pnumber, time() + 60 * 60);
        } else {
            $user = "style='display: none;'";
        }
    } else {
        $user = "style='display: none;'";
    }

    // tutes li
    $li_tute = "SELECT * FROM `tutes` WHERE `Class` = '{$_COOKIE['cookieClass']}' AND `Action` = 1 AND `Start_date` <= '{$today_date}'";
    $li_tute_result = mysqli_query($connection, $li_tute);


    // insert_attendance 
    if (isset($_POST['insert_attendance'])) {

        if (!isset($_POST['note']) || strlen(trim($_POST['note'])) < 1) {
            $note_status = 0;
            $note = mysqli_real_escape_string($connection, $_POST['note']);
        } else {
            $note = mysqli_real_escape_string($connection, $_POST['note']);
            $note_status = 1;
        }

        $chech_attendance = "SELECT * FROM `attendance` WHERE `Date` = '{$today_date}' AND `Student_ID` = '{$_COOKIE['student_ID']}' AND `Class` = '{$_COOKIE['cookieClass']}'";
        $chech_attendance_result = mysqli_query($connection, $chech_attendance);

        if (mysqli_num_rows($chech_attendance_result) > 0) {
            header("location: already_exist.php");
        } else {
            $insert_attendance = "INSERT INTO `attendance` (`Student_ID`, `Name`, `Class`, `Type`, `Location`, `Date`, `Note`, `Note_status`) VALUES ('{$_COOKIE['student_ID']}', '{$_COOKIE['full_name']}', '{$_COOKIE['cookieClass']}', '{$_COOKIE['cookieType']}', '{$_COOKIE['cookieLocation']}', '{$today_date}', '{$note}', {$note_status})";
            $insert_attendance_result = mysqli_query($connection, $insert_attendance);

            if (!isset($_POST['fees']) || strlen(trim($_POST['fees'])) < 1) {
            } else {
                $fees = mysqli_real_escape_string($connection, $_POST['fees']);
                $fees_insert = "INSERT INTO `class_fees` (`ST_ID`, `Student_ID`, `Class`, `Year_month`, `Date`) VALUES ('{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$fees}', '{$today_date}')";
                $fees_insert_result = mysqli_query($connection, $fees_insert);
            }

            if (!isset($_POST['tname']) || strlen(trim($_POST['tname'])) < 1) {
            } else {
                $tname = mysqli_real_escape_string($connection, $_POST['tname']);
                $tname_insert = "INSERT INTO `deliverd_tute` (`Tute_ID`, `ST_ID`, `Student_ID`, `Class`, `ST_name`, `Date`) VALUES ('{$tname}', '{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$_COOKIE['full_name']}', '{$today_date}')";
                $tname_insert_result = mysqli_query($connection, $tname_insert);

                // tutes deliverd count
                $tutes_deliverd_count = "SELECT `Delivered` FROM `tutes` WHERE `ID` = {$tname}";
                $tutes_deliverd_count_result = mysqli_query($connection, $tutes_deliverd_count);
                if (mysqli_num_rows($tutes_deliverd_count_result) == 1) {
                    $deliverd = mysqli_fetch_assoc($tutes_deliverd_count_result);
                    $deli = $deliverd['Delivered'];

                    $update_count = $deli + 1;
                }

                // update count
                $count_tutes = "UPDATE `tutes` SET `Delivered` = {$update_count} WHERE `ID` = {$tname}";
                $count_tutes_result = mysqli_query($connection, $count_tutes);
            }

            if ($insert_attendance_result) {
                header("location: attendance.php");

                setcookie('full_name', NULL, -time() + 60 * 60);
                setcookie('ST_ID', NULL, -time() + 60 * 60);
                setcookie('student_ID', NULL, -time() + 60 * 60);
                setcookie('student_pnumber', NULL, -time() + 60 * 60);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ATTENDANCE </title>
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
                <h1> ATTENDANCE </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <?php
                    if (isset($_COOKIE['cookieClass'])) {
                        $display2 = "block";
                        $display = "none";
                    } else {
                        $display2 = "none";
                        $display = "block";
                    }
                    ?>
                    <form method="get" style="display: <?= $display; ?>;">
                        <h2> Set Attendance </h2>
                        <p>
                            <label for="class"> Class : </label>
                            <select name="class" id="class" required>
                                <option value=""> Choose Class </option>
                                <?php
                                if (mysqli_num_rows($today_class_result) > 0) {
                                    while ($list_class = mysqli_fetch_assoc($today_class_result)) {
                                        echo " <option value='{$list_class['ID']}'> {$list_class['Date']} | {$list_class['Location']} | {$list_class['Class']} / {$list_class['Type']} </option> ";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <br>
                        <p>
                            <input type="checkbox" value="true" name="enable_tutes" id="enable_tutes">
                            <label for="enable_tutes"> : Enable Tutes </label>
                        </p>
                        <br>
                        <p>
                            <input type="submit" id="start_attendance" name="start_attendance" value="START ATTENDANCE">
                        </p>
                    </form>
                    <form action="clear-cookies.php" method="get" style="display: <?= $display2; ?>;">
                        <p>
                            <label> Class : </label>
                            <input type="text" value="<?= $_COOKIE['cookieClass'] . ' / ' . $_COOKIE['cookieType']; ?>" readonly>
                        </p>
                        <br>
                        <p>
                            <label> Location : </label>
                            <input type="text" value="<?= $_COOKIE['cookieLocation']; ?>" readonly>
                        </p>
                        <br>
                        <p>
                            <label> Tute : </label>
                            <input type="text" value="<?= $tuteValue; ?>" readonly>
                        </p>
                        <br>
                        <p>
                            <input type="submit" value="Clear" name="clear">
                        </p>
                    </form>
                </div>
                <div class="students" style="display: <?= $display2; ?>;">
                    <div class="search">
                        <form method="post">
                            <p> <input type="search" name="search" placeholder="Search student number or name." autofocus> </p>
                        </form>
                        <br>
                        <div class="student_details" <?= $user; ?>>
                            <div>
                                <img src="assect/img/imgs/student.png" alt="user">
                            </div>
                            <div class="st_details">
                                <p> <span> Student ID :</span> <?= $student_ID; ?> </p>
                                <p> <span> Student Name :</span> <?= $student_fname . " " . $student_lname; ?> </p>
                                <p> <span> Student Class :</span> <?= $_COOKIE['cookieClass'] ?> </p>
                                <p> <span> Student Tel :</span> <?= $student_pnumber; ?> </p>
                            </div>
                        </div>
                        <br>
                        <div class="old_update" <?= $user; ?>>
                            <div class="old_details">
                                <div class="fees">
                                    <h2> Fee payments for the last 4 months </h2>
                                    <br>
                                    <ul>
                                        <?php
                                        if (mysqli_num_rows($check_fees_result) > 0) {
                                            while ($fees_details = mysqli_fetch_assoc($check_fees_result)) {
                                                echo "<li>
                                                 <span style='font-weight: bold;'> {$fees_details['Year_month']} </span>
                                                 <span> {$fees_details['Date']} </span> <span class='paid'> PAID </span>
                                             </li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="fees">
                                    <h2> Last four tutes </h2>
                                    <br>
                                    <ul>
                                        <?php
                                        if (mysqli_num_rows($check_tutes_result) > 0) {
                                            while ($fees_details = mysqli_fetch_assoc($check_tutes_result)) {
                                                $tuteID = $fees_details['Tute_ID'];
                                                $tute_name = "SELECT `Tute_name` FROM `tutes` WHERE `ID` = {$tuteID}";
                                                $tute_name_result = mysqli_query($connection, $tute_name);

                                                if (mysqli_num_rows($tute_name_result) > 0) {
                                                    $t_name = mysqli_fetch_assoc($tute_name_result);
                                                    $tute_n = $t_name['Tute_name'];
                                                }

                                                echo "<li>
                                                        <span style='font-weight: bold;'> {$tute_n} </span>
                                                        <span> {$fees_details['Date']} </span>
                                                    </li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- update attendance  -->
                            <div class="updates">
                                <form method="post" <?= $recode_display ?>>
                                    <p style="background-color: var(--primary-light); padding: 10px; box-sizing: border-box; border-radius: 5px;">
                                        <input type="checkbox" id="present" required style="cursor: pointer;">
                                        <label for="present" style="cursor: pointer;"> : Present </label>
                                    </p>
                                    <br>
                                    <p>
                                        <label for="fees"> Fees :</label>
                                        <select name="fees" id="fees">
                                            <option value=""> Select month for charges </option>
                                            <option value="<?= date("Y") . " " . "January" ?>"> January </option>
                                            <option value="<?= date("Y") . " " . "February" ?>"> February </option>
                                            <option value="<?= date("Y") . " " . "March" ?>"> March </option>
                                            <option value="<?= date("Y") . " " . "April" ?>"> April </option>
                                            <option value="<?= date("Y") . " " . "May" ?>"> May </option>
                                            <option value="<?= date("Y") . " " . "June" ?>"> June </option>
                                            <option value="<?= date("Y") . " " . "July" ?>"> July </option>
                                            <option value="<?= date("Y") . " " . "August" ?>"> August </option>
                                            <option value="<?= date("Y") . " " . "September" ?>"> September </option>
                                            <option value="<?= date("Y") . " " . "October" ?>"> October </option>
                                            <option value="<?= date("Y") . " " . "November" ?>"> November </option>
                                            <option value="<?= date("Y") . " " . "December" ?>"> December </option>
                                        </select>
                                    </p>
                                    <br>
                                    <p style="<?= $tute; ?>">
                                        <label for="tname"> Tute :</label>
                                        <select name="tname" id="tname">
                                            <option value=""> Choose tute </option>
                                            <?php
                                            if (mysqli_num_rows($li_tute_result) > 0) {
                                                while ($tute_li = mysqli_fetch_assoc($li_tute_result)) {
                                                    $id = $tute_li['ID'];
                                                    $Tute_name = $tute_li['Tute_name'];
                                                    $Delivered = $tute_li['Delivered'];

                                                    echo "<option value='{$id}'> {$Tute_name} </option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </p>
                                    <br>
                                    <p>
                                        <label for="note">Note :</label>
                                        <input type="text" name="note" placeholder="Note">
                                    </p>
                                    <br>
                                    <p>
                                        <input type="submit" name="insert_attendance" value="SUBMIT">
                                    </p>
                                </form>

                                <!-- change attendance recode  -->
                                <form action="remove.php" method="post" <?= $recode_display_form2 ?>>
                                    <p style="background-color: lightgreen; padding: 10px; font-weight: bold; box-sizing: border-box; border-radius: 5px; text-align: center;">
                                        came today
                                    </p>
                                    <br>
                                    <p>
                                        <input type="text" name="delete_ID" value="<?= $recode_ID; ?>" hidden>
                                    </p>
                                    <br>
                                    <p>
                                        <input type="number" name="ST_ID" value="<?= $ST_ID; ?>" hidden>
                                    </p>
                                    <p>
                                        <input type="submit" name="remove_attendance" value="REMOVE" style="background-color: tomato;">
                                    </p>
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