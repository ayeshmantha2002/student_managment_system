<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$st_id = "";
$fname = "";
$Lname = "";
$year = "";
$pnumber = "";
$today = date("Y-m-d");

$errors = array();

include("includes/connection.php");


// add new student 
if (isset($_POST['add_student'])) {
    $st_id = strtoupper(mysqli_real_escape_string($connection, $_POST['st_id']));
    setcookie('st_id', $st_id, time() + 60 * 60 * 24 * 20);
    $fname = ucfirst(mysqli_real_escape_string($connection, $_POST['fname']));
    $Lname = ucfirst(mysqli_real_escape_string($connection, $_POST['Lname']));
    $year = mysqli_real_escape_string($connection, $_POST['year']);
    $fees = mysqli_real_escape_string($connection, $_POST['fees']);
    $pnumber = mysqli_real_escape_string($connection, $_POST['pnumber']);

    $check_student = "SELECT * FROM `student` WHERE `Student_ID` = '{$st_id}' AND `Class` = '{$year}'";
    $check_student_result = mysqli_query($connection, $check_student);

    if (mysqli_num_rows($check_student_result) > 0) {
        $errors[] = " This student ID already exists ";
    } else {
        $insert_student = "INSERT INTO `student` (`Student_ID`, `First_name`, `Last_name`, `Class`, `Card`, `Phone_number`, `Register_date`, `Status`) VALUES ('{$st_id}', '{$fname}', '{$Lname}', '{$year}', '{$fees}', '{$pnumber}', '{$today}', 1)";
        $insert_student_result = mysqli_query($connection, $insert_student);
        if ($insert_student_result) {
            header("location: user-list.php");
        }
    }
}

// edit student
$old_St_number = "";
$old_St_fname = "";
$old_St_lname = "";
$old_St_class = "";
$old_St_phone_number = "";
if (isset($_GET['edit_student_id'])) {
    $edit_st_id = mysqli_real_escape_string($connection, $_GET['edit_student_id']);
    $up_student = "SELECT * FROM `student` WHERE `ID` = {$edit_st_id}";
    $up_student_result = mysqli_query($connection, $up_student);
    if (mysqli_num_rows($up_student_result) > 0) {
        $old_st_details = mysqli_fetch_assoc($up_student_result);
        $old_St_number = $old_st_details['Student_ID'];
        $old_St_fname = $old_st_details['First_name'];
        $old_St_lname = $old_st_details['Last_name'];
        $old_St_class = $old_st_details['Class'];
        $old_St_Card = $old_st_details['Card'];
        $old_St_phone_number = $old_st_details['Phone_number'];
    }

    if (isset($_POST['up_submit'])) {
        $up_stID = mysqli_real_escape_string($connection, $_POST['up_stID']);
        $up_first = mysqli_real_escape_string($connection, $_POST['up_first']);
        $up_last = mysqli_real_escape_string($connection, $_POST['up_last']);
        $up_class = mysqli_real_escape_string($connection, $_POST['up_class']);
        $up_card = ucfirst(mysqli_real_escape_string($connection, $_POST['up_card']));
        $up_pnumber = mysqli_real_escape_string($connection, $_POST['up_pnumber']);

        $update_st = "UPDATE `student` SET `Student_ID` = '{$up_stID}', `First_name` = '{$up_first}', `Last_name` = '{$up_last}', `Class` = '{$up_class}', `Card` = '{$up_card}', `Phone_number` = '{$up_pnumber}' WHERE `ID` = {$edit_st_id}";
        $update_st_result = mysqli_query($connection, $update_st);

        if ($update_st_result) {
            header("location: user-list.php?update=done");
        } else {
            header("location: user-list.php?update=error");
        }
    }

    $edit_form = "flex";
} else {
    $edit_form = "none";
}

// classes
$classes = "SELECT * FROM `class`";
$classes_result = mysqli_query($connection, $classes);

// Locations
$Locations = "SELECT * FROM `location`";
$Locations_result = mysqli_query($connection, $Locations);

// list students 
if (isset($_GET['filter_class'])) {
    $filter_class = mysqli_real_escape_string($connection, $_GET['filter_class']);
    $location = mysqli_real_escape_string($connection, $_GET['location']);
    $student_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '{$location}%') AND `Class` = '{$filter_class}' ORDER BY `Class` DESC, `Student_ID` DESC ";
} elseif (isset($_POST['search'])) {
    $filter_user = mysqli_real_escape_string($connection, $_POST['search']);
    $student_list = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '%{$filter_user}%' OR `First_name` LIKE '%{$filter_user}%' OR `Last_name` LIKE '%{$filter_user}%') ORDER BY `Class` DESC, `Student_ID` DESC ";
} else {
    $student_list = "SELECT * FROM `student` ORDER BY `Class` DESC, `Student_ID` DESC ";
}
$student_list_result = mysqli_query($connection, $student_list);


// delete user
if (isset($_GET['remove_student_id'])) {
    $delete_ID = mysqli_real_escape_string($connection, $_GET['remove_student_id']);
    $delete_user = "DELETE FROM `student` WHERE `ID` = {$delete_ID}";
    $delete_user_result = mysqli_query($connection, $delete_user);
    if ($delete_user_result) {
        $del_msg = "flex";
    } else {
        $del_msg = "none";
    }
} else {
    $del_msg = "none";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> STUDENTS LIST </title>
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
                <h1> STUDENTS LIST </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
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
                        <h2> Filter Option </h2>
                        <br>
                        <form method="get">
                            <p>
                                <label for="class"> Class : </label>
                                <select name="filter_class" id="class" required>
                                    <option value=""> Chooce class </option>
                                    <?php
                                    if (mysqli_num_rows($classes_result) > 0) {
                                        while ($class_fetch = mysqli_fetch_assoc($classes_result)) {
                                            echo " <option value='{$class_fetch['Year']}'> {$class_fetch['Year']} </option> ";
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <br>
                            <p>
                                <label for="location"> Location : </label>
                                <select name="location" id="location" required>
                                    <option value=""> Chooce location </option>
                                    <?php
                                    if (mysqli_num_rows($Locations_result) > 0) {
                                        while ($location_fetch = mysqli_fetch_assoc($Locations_result)) {
                                            echo " <option value='{$location_fetch['UID']}'> {$location_fetch['location']} </option> ";
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <br>
                            <p>
                                <input type="submit" value="FILTER" name="filter">
                            </p>
                        </form>
                    </div>
                    <div>
                        <h2> Add Student </h2>
                        <br>
                        <p style="text-align: center; color: red; font-weight: bold;">
                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $errors) {
                                    echo $errors;
                                }
                            }
                            ?>
                        </p>
                        <form method="post">
                            <p>
                                <label for="st_id"> Student ID : </label>
                                <input type="text" name="st_id" id="st_id" placeholder="Student ID" value="<?php
                                                                                                            if (isset($_COOKIE['st_id'])) {
                                                                                                                $numberPart = (int) filter_var($_COOKIE['st_id'], FILTER_SANITIZE_NUMBER_INT);
                                                                                                                $numberPart++;
                                                                                                                $newValue = 'BW' . str_pad($numberPart, 3, '0', STR_PAD_LEFT);
                                                                                                                echo $newValue;
                                                                                                            } else {
                                                                                                                echo $st_id;
                                                                                                            }
                                                                                                            ?>" required>
                            </p>
                            <br>
                            <div class="double">
                                <p>
                                    <label for="fname"> First name : </label>
                                    <input type="text" name="fname" id="fname" placeholder="First name" value="<?php echo $fname; ?>" required>
                                </p>
                                <p>
                                    <label for="Lname"> Last name : </label>
                                    <input type="text" name="Lname" id="Lname" placeholder="Last name" value="<?php echo $Lname; ?>" required>
                                </p>
                            </div>
                            <br>
                            <p>
                                <label for="fees"> Fees : </label>
                                <select name="fees" id="fees">
                                    <option value="Full"> Full Card </option>
                                    <option value="Half"> Half Card </option>
                                    <option value="Free"> Free Card </option>
                                </select>
                            </p>
                            <br>
                            <p>
                                <label for="year"> Chooce Year : </label>
                                <select name="year" required>
                                    <option value="<?php echo $year; ?>"> Chooce Year </option>
                                    <?php
                                    // classes
                                    $classes = "SELECT * FROM `class`";
                                    $classes_result = mysqli_query($connection, $classes);

                                    if (mysqli_num_rows($classes_result) > 0) {
                                        while ($class_fetch = mysqli_fetch_assoc($classes_result)) {
                                            echo " <option value='{$class_fetch['Year']}'> {$class_fetch['Year']} </option> ";
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <br>
                            <p>
                                <label for="pnumber"> Phone number : </label>
                                <input type="number" name="pnumber" id="pnumber" placeholder="Phone Number" value="<?php echo $pnumber; ?>">
                            </p>
                            <br>
                            <p>
                                <input type="submit" name="add_student" value="Add Student">
                            </p>
                        </form>
                    </div>
                </div>
                <div class="students">
                    <table>
                        <?php
                        if (mysqli_num_rows($student_list_result) > 0) {
                            echo "
                            <tr>
                                <th> ID </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Class </th>
                                <th colspan='3' style='text-align: center;'> Action </th>
                            </tr>
                            ";
                            while ($student_details = mysqli_fetch_assoc($student_list_result)) {
                                echo "
                                <tr>
                                    <td> {$student_details['Student_ID']} </td>
                                    <td> {$student_details['First_name']} </td>
                                    <td> {$student_details['Last_name']} </td>
                                    <td> {$student_details['Class']} </td>

                                    <td style='display: none;'> <span class='view'> <a href='view-details.php?student_id={$student_details['ID']}'>View</a> </span> </td>
                                    
                                    <td> <a href='user-list.php?edit_student_id={$student_details['ID']}'>Edit</a> </td>

                                    <td> <span class='delete'> <a href='user-list.php?remove_student_id={$student_details['ID']}' class='delete' onclick='return confirmRemoval();'>Delete</a> </span> </td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>

            <section class="update_students" style="z-index: 1; opacity: 1; display: <?= $edit_form; ?>;">
                <form method="post" enctype="multipart/form-data">
                    <p class="close_btn"><img src="assect/img/icons/x-circle-solid-24.png" alt="close"></p>
                    <h2> Update details </h2>
                    <br>
                    <p>
                        <label for="up_stID"> Student Number :</label>
                        <input type="text" name="up_stID" id="up_stID" value="<?= $old_St_number; ?>" placeholder="Student Number" required>
                    </p>
                    <br>
                    <div class="double">
                        <p>
                            <label for="up_first"> First Name :</label>
                            <input type="text" name="up_first" id="up_first" value="<?= $old_St_fname; ?>" placeholder="First Name" required>
                        </p>
                        <p>
                            <label for="up_last"> Last Name :</label>
                            <input type="text" name="up_last" id="up_last" value="<?= $old_St_lname; ?>" placeholder="Last Name" required>
                        </p>
                    </div>
                    <br>
                    <p>
                        <label for="up_class"> Class :</label>
                        <input type="number" name="up_class" id="up_class" value="<?= $old_St_class; ?>" placeholder="Class" required>
                    </p>
                    <br>
                    <p>
                        <label for="up_card"> Fees :</label>
                        <input type="text" name="up_card" id="up_card" value="<?= $old_St_Card; ?>" placeholder="Fees" required>
                    </p>
                    <br>
                    <p>
                        <label for="up_pnumber"> Phone Number :</label>
                        <input type="text" name="up_pnumber" id="up_pnumber" value="<?= $old_St_phone_number; ?>" placeholder="Phone Number">
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="Update" name="up_submit">
                    </p>
                </form>
            </section>

            <!-- delete message -->
            <section class="popup_forms" style="z-index: 1; opacity: 1; display: <?= $del_msg; ?>;">
                <div class="pop_form">
                    <p style="text-align: center;"> <img width="100px" src="assect/img/imgs/done.png" alt="done"> </p>
                    <h3 style="text-align: center;"> This student was deleted. </h3>
                    <br>
                    <p style="text-align: center;"> <a href="user-list.php"> OK </a> </p>
                    <br>
                </div>
            </section>

        </section>
    </div>

    <script>
        function confirmRemoval() {
            return confirm("Are you sure you want to delete this student?");
        }
    </script>
    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>