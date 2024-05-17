<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$class1 = "0000";
$class2 = "0000";
$class3 = "0000";

include("includes/connection.php");

// last modification time count
$last_log = "UPDATE `admin` SET `Last_login` = NOW() WHERE `ID` = {$_SESSION['ID']}";
$last_log_result = mysqli_query($connection, $last_log);

// latest classes
$latest_classes = "SELECT * FROM `class` ORDER BY `Year` DESC";
$latest_classes_result = mysqli_query($connection, $latest_classes);

if (mysqli_num_rows($latest_classes_result) > 0) {
    $classFetch = mysqli_fetch_assoc($latest_classes_result);

    if (mysqli_num_rows($latest_classes_result) == 1) {
        $class1 = $classFetch['Year'];
    } else {
        $class1 = $classFetch['Year'];
        $classFetch2 = mysqli_fetch_assoc($latest_classes_result);
        $class2 = $classFetch2['Year'];
    }
}

// branch 
$branch = "SELECT * FROM `location`";
$branch_result = mysqli_query($connection, $branch);

// add branch 
if (isset($_POST['add_branch'])) {
    $new_branch = ucfirst(mysqli_real_escape_string($connection, $_POST['location']));
    $new_code = strtoupper(mysqli_real_escape_string($connection, $_POST['code']));

    $add_new_branch = "INSERT INTO `location` (`location`, `UID`) VALUES ('{$new_branch}', '{$new_code}')";
    $add_new_branch_result = mysqli_query($connection, $add_new_branch);
    if ($add_new_branch_result) {
        header("location: index.php");
    }
}

// notes
$notes = "SELECT * FROM `attendance` WHERE `Note_status` = 1 OR `Note_status` = 2 ORDER BY `ID` DESC";
$notes_result = mysqli_query($connection, $notes);

// delete notes 
if (isset($_GET['delete_note'])) {
    $delete_note = "UPDATE `attendance` SET `Note_status` = 2 WHERE `ID` = {$_GET['delete_note']}";
    $delete_note_result = mysqli_query($connection, $delete_note);
    if ($delete_note_result) {
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DASHBOARD </title>
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
                <h1> DASHBOARD </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>
            <br>
            <div class="indicators_dash">
                <div class="lg_box">
                    <div class="box">
                        <div class="detalis">
                            <div>
                                <h2> <?php echo $class1; ?> </h2>
                                <hr>
                            </div>
                            <div>
                                <?php
                                // fetch locations 
                                $branchLocations = "SELECT * FROM `location`";
                                $branchLocations_result = mysqli_query($connection, $branchLocations);
                                if (mysqli_num_rows($branchLocations_result) > 0) {
                                    $total = 0;
                                    while ($fetch_branchLocations = mysqli_fetch_assoc($branchLocations_result)) {
                                        $UID = $fetch_branchLocations['UID'];
                                        // total admin count
                                        $classOne_Query = "SELECT `Student_ID` FROM `student` WHERE (`Student_ID` LIKE '{$UID}%') AND `Class` = '{$class1}'";
                                        $classOne_Query_result = mysqli_query($connection, $classOne_Query);

                                        $student_count = mysqli_num_rows($classOne_Query_result);
                                        if ($student_count > 0) {
                                            echo "
                                                <p> {$fetch_branchLocations['location']} - {$student_count} </p>
                                                ";
                                        } else {
                                            echo "
                                                <p> {$fetch_branchLocations['location']} - 0 </p>
                                                ";
                                        }
                                        $total += $student_count;
                                    }
                                    echo "
                                    </div>
                                    <div>
                                        <h3> Total - {$total} </h3>
                                    </div>
                                    ";
                                } else {
                                    echo " </div>";
                                    echo "No result found";
                                }
                                ?>
                            </div>
                            <div class="img">
                                <img src="assect/img/imgs/user.png" alt="user">
                            </div>
                        </div>
                        <div class="box">
                            <div class="detalis">
                                <div>
                                    <h2> <?php echo $class2; ?> </h2>
                                    <hr>
                                </div>
                                <div>
                                    <?php
                                    // fetch locations 
                                    $branchLocations = "SELECT * FROM `location`";
                                    $branchLocations_result = mysqli_query($connection, $branchLocations);
                                    if (mysqli_num_rows($branchLocations_result) > 0) {
                                        $total = 0;
                                        while ($fetch_branchLocations = mysqli_fetch_assoc($branchLocations_result)) {
                                            // total admin count
                                            $classOne_Query = "SELECT `Student_ID` FROM `student` WHERE (`Student_ID` LIKE '{$UID}%') AND `Class` = '{$class2}'";
                                            $classOne_Query_result = mysqli_query($connection, $classOne_Query);

                                            $student_count = mysqli_num_rows($classOne_Query_result);
                                            if ($student_count > 0) {
                                                echo "
                                                <p> {$fetch_branchLocations['location']} - {$student_count} </p>
                                                ";
                                            } else {
                                                echo "
                                                <p> {$fetch_branchLocations['location']} - 0 </p>
                                                ";
                                            }
                                            $total += $student_count;
                                        }
                                        echo "
                                    </div>
                                    <div>
                                        <h3> Total - {$total} </h3>
                                    </div>
                                    ";
                                    } else {
                                        echo " </div>";
                                        echo "No result found";
                                    }
                                    ?>
                                </div>
                                <div class="img">
                                    <img src="assect/img/imgs/user.png" alt="user">
                                </div>
                            </div>
                        </div>
                        <div class="lg_box">
                            <div class="box">
                                <div class="detalis">
                                    <div>
                                        <h2> ADMIN </h2>
                                        <hr>
                                    </div>
                                    <div>
                                        <?php
                                        // fetch locations 
                                        $branchLocations = "SELECT * FROM `location`";
                                        $branchLocations_result = mysqli_query($connection, $branchLocations);
                                        if (mysqli_num_rows($branchLocations_result) > 0) {
                                            $total = 0;
                                            while ($fetch_branchLocations = mysqli_fetch_assoc($branchLocations_result)) {
                                                $B_location = $fetch_branchLocations['location'];
                                                // total admin count
                                                $adminsQuery = "SELECT `Location` FROM `admin` WHERE `Location` = '{$B_location}'";
                                                $adminsQuery_result = mysqli_query($connection, $adminsQuery);

                                                $admin_count = mysqli_num_rows($adminsQuery_result);
                                                if ($admin_count > 0) {
                                                    echo "
                                                        <p> {$B_location} - {$admin_count} </p>
                                                        ";
                                                }
                                                $total += $admin_count;
                                            }
                                            echo "
                                    </div>
                                            <div>
                                                <h3> Total - {$total} </h3>
                                            </div>
                                            ";
                                        } else {
                                            echo " </div>";
                                            echo "No result found";
                                        }
                                        ?>
                                    </div>
                                    <div class="img">
                                        <img src="assect/img/imgs/admin.png" alt="user">
                                    </div>
                                </div>
                                <div class="box"></div>
                            </div>
                        </div>
                        <br>
                        <div class="indicators_dash" style="align-items: start;">
                            <div class="lg_box">
                                <div class="box" style="box-shadow: none;">
                                    <div class="notes">
                                        <h2 style="text-align: center;"> NOTES </h2>
                                        <div class="note">
                                            <ul>
                                                <?php
                                                if (mysqli_num_rows($notes_result) > 0) {
                                                    while ($fetch_notes = mysqli_fetch_assoc($notes_result)) {
                                                        $n_ID = $fetch_notes['ID'];
                                                        $ST_ID = $fetch_notes['Student_ID'];
                                                        $Name = $fetch_notes['Name'];
                                                        $n_Class = $fetch_notes['Class'];
                                                        $n_Date = $fetch_notes['Date'];
                                                        $n_Note = $fetch_notes['Note'];
                                                        $n_Note_status = $fetch_notes['Note_status'];

                                                        echo "
                                            <li>
                                            <div class='st_id'>
                                                <p> {$ST_ID} </p>
                                                <p> {$Name} </p>
                                                <p> {$n_Class} </p>
                                                <p> {$n_Date} </p>
                                            </div>
                                            <div class='note_details'>
                                                {$n_Note}
                                            </div>
                                            ";

                                                        if ($n_Note_status == 1) {
                                                            echo "
                                                <div class='del'>
                                                    <a href='index.php?delete_note={$n_ID}'>
                                                        <div class='create_button'></div>
                                                    </a>
                                                </div>
                                            </li>
                                              ";
                                                        } else {
                                                            echo "
                                                <div class='del'> </div>
                                            </li>
                                              ";
                                                        }
                                                    }
                                                } else {
                                                    echo "
                                        <li>
                                            <div></div>
                                            <div style='text-align: center;'> No notes found </div>
                                            <div></div>
                                        </li>
                                        ";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lg_box" style="align-items: start;">
                                <div class="box" style="display: block;">
                                    <h2 style="text-align: center;"> Branch </h2>
                                    <br>
                                    <ol style="margin-left: 30px;">
                                        <?php
                                        $number = 1;
                                        if (mysqli_num_rows($branch_result) > 0) {
                                            while ($fetch_location = mysqli_fetch_assoc($branch_result)) {
                                                $branch_location = $fetch_location['location'];
                                                $branch_code = $fetch_location['UID'];

                                                echo "
                                    <li style='display: flex; justify-content: space-between; margin-right: 50px; margin-bottom: 10px;'>
                                        <h4> {$number} . {$branch_location} </h4>
                                        <h4> {$branch_code} </h4>
                                    </li>
                                    ";
                                                $number++;
                                            }
                                        } else {
                                            echo "No branch found";
                                        }
                                        ?>
                                    </ol>
                                </div>
                                <div class="box location_form" style="display: block;">
                                    <h2 style="text-align: center;"> Add Branch </h2>
                                    <form method="post">
                                        <p>
                                            <label for="location"> Branch Location : </label>
                                            <input type="text" placeholder="Branch Location" name="location" id="location">
                                        </p>
                                        <br>
                                        <p>
                                            <label for="code"> Class Code : </label>
                                            <input type="text" placeholder="Class Code" name="code" id="code">
                                        </p>
                                        <br>
                                        <p>
                                            <input type="submit" value="ADD" name="add_branch">
                                        </p>
                                    </form>
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