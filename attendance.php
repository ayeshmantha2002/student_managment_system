<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$last_month = date("m") - 1;
$this_month = date("m");
$next_month = date("m") + 1;
$last_year = date("Y");
$this_year = date("Y");
$next_year = date("Y");

if ($last_month == 0) {
    $last_year = date("Y") - 1;
    $last_month_name = "December";
} elseif ($last_month == 1) {
    $last_month_name = "January";
} elseif ($last_month == 2) {
    $last_month_name = "February";
} elseif ($last_month == 3) {
    $last_month_name = "March";
} elseif ($last_month == 4) {
    $last_month_name = "April";
} elseif ($last_month == 5) {
    $last_month_name = "May";
} elseif ($last_month == 6) {
    $last_month_name = "June";
} elseif ($last_month == 7) {
    $last_month_name = "July";
} elseif ($last_month == 8) {
    $last_month_name = "August";
} elseif ($last_month == 9) {
    $last_month_name = "September";
} elseif ($last_month == 10) {
    $last_month_name = "October";
} elseif ($last_month == 11) {
    $last_month_name = "November";
}


if ($this_month == 1) {
    $this_month_name = "January";
} elseif ($this_month == 2) {
    $this_month_name = "February";
} elseif ($this_month == 3) {
    $this_month_name = "March";
} elseif ($this_month == 4) {
    $this_month_name = "April";
} elseif ($this_month == 5) {
    $this_month_name = "May";
} elseif ($this_month == 6) {
    $this_month_name = "June";
} elseif ($this_month == 7) {
    $this_month_name = "July";
} elseif ($this_month == 8) {
    $this_month_name = "August";
} elseif ($this_month == 9) {
    $this_month_name = "September";
} elseif ($this_month == 10) {
    $this_month_name = "October";
} elseif ($this_month == 11) {
    $this_month_name = "November";
} elseif ($this_month == 12) {
    $this_month_name = "December";
}


if ($next_month == 2) {
    $next_month_name = "February";
} elseif ($next_month == 3) {
    $next_month_name = "March";
} elseif ($next_month == 4) {
    $next_month_name = "April";
} elseif ($next_month == 5) {
    $next_month_name = "May";
} elseif ($next_month == 6) {
    $next_month_name = "June";
} elseif ($next_month == 7) {
    $next_month_name = "July";
} elseif ($next_month == 8) {
    $next_month_name = "August";
} elseif ($next_month == 9) {
    $next_month_name = "September";
} elseif ($next_month == 10) {
    $next_month_name = "October";
} elseif ($next_month == 11) {
    $next_month_name = "November";
} elseif ($next_month == 12) {
    $next_month_name = "December";
} elseif ($next_month == 13) {
    $next_month_name = "January";
    $next_year = date("Y") + 1;
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
        // if (isset($_GET['tnamecoocie']) && !empty($_GET['tnamecoocie'])) {
        //     setcookie('cookieTuteName', $_GET['tnamecoocie'], time() + 60 * 60 * 12);
        // }

        if (isset($_GET['enable_tutes'])) {
            if ($_GET['enable_tutes'] == 'true') {
                setcookie('cookieTute', 'true', time() + 60 * 60 * 12);
                setcookie('cookieTuteName', $_GET['tnamecoocie'], time() + 60 * 60 * 12);
            } else {
                setcookie('cookieTute', NULL, -time() + 60 * 60 * 12);
                setcookie('cookieTuteName', NULL, -time() + 60 * 60 * 12);
            }
        }
        header("location: attendance_start.php?start");
    }
} else {
    $classID = "";
}

// give a tute 
if (isset($_COOKIE['cookieTute'])) {
    $tute = "";
    $tuteName = "SELECT * FROM `tutes` WHERE `ID` = {$_COOKIE['cookieTuteName']}";
    $tuteName_result = mysqli_query($connection, $tuteName);

    if (mysqli_num_rows($tuteName_result) == 1) {
        $fetch_name = mysqli_fetch_assoc($tuteName_result);
        $tute_name_is = $fetch_name['Tute_name'];
        $tute_year_is = $fetch_name['Class'];
    }
    $tuteValue = $tute_year_is . " | " . $tute_name_is;
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
    setcookie('cookieTuteName', NULL, -time() + 60 * 60 * 12);
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
            $student_Card = $student_details['Card'];
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
        $st_id = 0;
    }


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

            // last month fees update
            if (!isset($_POST['fees_last']) || strlen(trim($_POST['fees_last'])) < 1) {
            } else {
                $fees_last = mysqli_real_escape_string($connection, $_POST['fees_last']);
                $fees_last_insert = "INSERT INTO `class_fees` (`ST_ID`, `Student_ID`, `Class`, `Year_month`, `Date`) VALUES ('{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$fees_last}', '{$today_date}')";
                $fees_last_insert_result = mysqli_query($connection, $fees_last_insert);
            }
            //this month fees update
            if (!isset($_POST['fees_this']) || strlen(trim($_POST['fees_this'])) < 1) {
            } else {
                $fees_this = mysqli_real_escape_string($connection, $_POST['fees_this']);
                $fees_this_insert = "INSERT INTO `class_fees` (`ST_ID`, `Student_ID`, `Class`, `Year_month`, `Date`) VALUES ('{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$fees_this}', '{$today_date}')";
                $fees_this_insert_result = mysqli_query($connection, $fees_this_insert);
            }
            // next month fees update
            if (!isset($_POST['fees_next']) || strlen(trim($_POST['fees_next'])) < 1) {
            } else {
                $fees_next = mysqli_real_escape_string($connection, $_POST['fees_next']);
                $fees_next_insert = "INSERT INTO `class_fees` (`ST_ID`, `Student_ID`, `Class`, `Year_month`, `Date`) VALUES ('{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$fees_next}', '{$today_date}')";
                $fees_next_insert_result = mysqli_query($connection, $fees_next_insert);
            }

            // today tute
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

            // last tute
            if (!isset($_POST['oldtname']) || strlen(trim($_POST['oldtname'])) < 1) {
            } else {
                $oldtname = mysqli_real_escape_string($connection, $_POST['oldtname']);
                $oldtname_insert = "INSERT INTO `deliverd_tute` (`Tute_ID`, `ST_ID`, `Student_ID`, `Class`, `ST_name`, `Date`) VALUES ('{$oldtname}', '{$_COOKIE['ST_ID']}', '{$_COOKIE['student_ID']}', '{$_COOKIE['cookieClass']}', '{$_COOKIE['full_name']}', '{$today_date}')";
                $oldtname_insert_result = mysqli_query($connection, $oldtname_insert);

                // tutes deliverd count
                $tutes_deliverd_count = "SELECT `Delivered` FROM `tutes` WHERE `ID` = {$oldtname}";
                $tutes_deliverd_count_result = mysqli_query($connection, $tutes_deliverd_count);
                if (mysqli_num_rows($tutes_deliverd_count_result) == 1) {
                    $deliverd = mysqli_fetch_assoc($tutes_deliverd_count_result);
                    $deli = $deliverd['Delivered'];

                    $update_count = $deli + 1;
                }

                // update count
                $count_tutes = "UPDATE `tutes` SET `Delivered` = {$update_count} WHERE `ID` = {$oldtname}";
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

    // last tute details fetch
    $last_tute = "SELECT * FROM `deliverd_tute` WHERE `Class` = '{$_COOKIE['cookieClass']}' AND `Date` != '{$today_date}' ORDER BY `Tute_ID` DESC LIMIT 1";
    $last_tute_result = mysqli_query($connection, $last_tute);
    if (mysqli_num_rows($last_tute_result) == 1) {
        $last_tute_fetch = mysqli_fetch_assoc($last_tute_result);
        $last_tute_ID = $last_tute_fetch['Tute_ID'];

        $ttt = "SELECT `Tute_name` FROM `tutes` WHERE `ID` = {$last_tute_ID}";
        $ttt_result = mysqli_query($connection, $ttt);

        // check tute
        $check_tute_user = "SELECT * FROM `deliverd_tute` WHERE `Student_ID` = '{$class_code}{$st_id}' AND `Tute_ID` = {$last_tute_ID}";
        $check_tute_user_result = mysqli_query($connection, $check_tute_user);
        if (mysqli_num_rows($check_tute_user_result) == 1) {
            $display_input = "none";
        } else {
            $display_input = "block";
        }

        if (mysqli_num_rows($ttt_result) == 1) {
            $ttt_fetch = mysqli_fetch_assoc($ttt_result);
            $ttt_name = $ttt_fetch['Tute_name'];
        }
    } else {
        $last_tute_ID = 0;
        $display_input = "none";
    }
} else {
    // last 3 month fees 
    $check_fees = "SELECT * FROM `class_fees` WHERE `Student_ID` = '1'";
    $check_fees_result = mysqli_query($connection, $check_fees);

    // last 3 tutes
    $check_tutes = "SELECT * FROM `deliverd_tute` WHERE `Student_ID` = '1'";
    $check_tutes_result = mysqli_query($connection, $check_tutes);
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
                        <p class="view_tute">
                            <select class="view_tute" name="tnamecoocie" id="tnamecoocie">
                                <?php
                                // tutes li
                                $li_tute = "SELECT * FROM `tutes` WHERE `Action` = 1 AND `Start_date` <= '{$today_date}'";
                                $li_tute_result = mysqli_query($connection, $li_tute);

                                if (mysqli_num_rows($li_tute_result) > 0) {
                                    while ($tute_li = mysqli_fetch_assoc($li_tute_result)) {
                                        $id = $tute_li['ID'];
                                        $Tute_name = $tute_li['Tute_name'];
                                        $Delivered = $tute_li['Delivered'];
                                        $t_class = $tute_li['Class'];

                                        echo "<option value='{$id}'> {$t_class} | {$Tute_name} </option>";
                                    }
                                }
                                ?>
                            </select>
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
                                <h2> Student ID : <?= $student_ID; ?> </h2>
                                <h2> Student Name : <?= $student_fname . " " . $student_lname; ?> </h2>
                                <h2> Student Class : <?= $_COOKIE['cookieClass'] ?> </h2>
                                <h2> Student Tel : <?= $student_pnumber; ?> </h2>
                                <br>
                                <h2> <span style="color: var(--primary);"> <?= $student_Card; ?> Card </span></h2>
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
                                    <br>
                                    <label for="fees"> Fees :</label>
                                    <br><br>
                                    <div class="fees_month">
                                        <p>
                                            <input type="checkbox" name="fees_last" id="fees_last" value=" <?= $last_year . " " . $last_month_name ?> ">
                                            <label for="fees_last"> : <?= $last_month_name; ?> </label>
                                        </p>
                                        <p>
                                            <input type="checkbox" name="fees_this" id="fees_this" value=" <?= $this_year . " " . $this_month_name ?> ">
                                            <label for="fees_this"> : <?= $this_month_name; ?> </label>
                                        </p>
                                        <p>
                                            <input type="checkbox" name="fees_next" id="fees_next" value=" <?= $next_year . " " . $next_month_name ?> ">
                                            <label for="fees_next"> : <?= $next_month_name; ?> </label>
                                        </p>
                                    </div>
                                    <p style="<?= $tute; ?>">
                                        <label for="tname"> Tute :</label>
                                        <input type="text" value="<?= $tute_name_is; ?>" readonly>
                                        <input type="text" value="<?= $_COOKIE['cookieTuteName']; ?>" name="tname" readonly hidden>
                                    </p>
                                    <br>
                                    <p style="display: <?= $display_input; ?>;">
                                        <input type="checkbox" name="oldtname" id="befor_tute" value="<?= $last_tute_ID ?>">
                                        <label for="befor_tute" style="cursor: pointer;"> : <?= $ttt_name; ?> </label>
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

    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>