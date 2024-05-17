<?php
session_start();
include("includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$errors = array();

// insert new class year 
if (isset($_POST['add_submit'])) {
    $new_year = mysqli_real_escape_string($connection, $_POST['add_year']);

    $check_class = "SELECT `Year` FROM `class` WHERE `Year` = {$new_year}";
    $check_class_result = mysqli_query($connection, $check_class);

    if (mysqli_num_rows($check_class_result) == 1) {
        header("location: add-class.php?class_add=already_exist");
    } else {

        $check_max_class = "SELECT * FROM `class`";
        $check_max_class_result = mysqli_query($connection, $check_max_class);

        if (mysqli_num_rows($check_max_class_result) >= 3) {
            header("location: add-class.php?max_class=full");
        } else {
            $add_year = "INSERT INTO `class` (`Year`) VALUE ({$new_year})";
            $add_year_result = mysqli_query($connection, $add_year);
        }

        if ($add_year_result) {
            header("location: add-class.php?class_add=done");
        }
    }
}

// insert new class time
if (isset($_POST['set_submit'])) {
    $set_time_class = mysqli_real_escape_string($connection, $_POST['set_time_class']);
    $set_type_class = mysqli_real_escape_string($connection, $_POST['set_type_class']);
    $set_location = mysqli_real_escape_string($connection, $_POST['set_location']);
    $set_date = mysqli_real_escape_string($connection, $_POST['set_date']);

    $check_class_time = "SELECT * FROM `class_date` WHERE `Location` = '{$set_location}' AND `Class` = '{$set_time_class}' AND `Type` = '{$set_type_class}' AND `Date` = '{$set_date}'";
    $check_class_time_result = mysqli_query($connection, $check_class_time);

    if (mysqli_num_rows($check_class_time_result) > 0) {
        $errors[] = "This class already exists";
    } else {
        $insert_class = "INSERT INTO `class_date` (`Location`, `Class`, `Type`, `Date`) VALUES ('{$set_location}', '{$set_time_class}', '{$set_type_class}', '{$set_date}')";
        $insert_class_result = mysqli_query($connection, $insert_class);

        if ($insert_class_result) {
            header("location: add-class.php?new_record=added");
        } else {
            $errors[] = "Query failed";
        }
    }
}

// Set classes details 
$today = date("Y-m-d");
$set_classes = "SELECT * FROM `class_date` WHERE `Date` >= '{$today}' ORDER BY `Date` LIMIT 3";
$set_classes_result = mysqli_query($connection, $set_classes);

// class details
$class_details = "SELECT * FROM `class_date` WHERE `Date` <= '{$today}' ORDER BY `Date` DESC LIMIT 3";
$class_details_result = mysqli_query($connection, $class_details);

// class List
$class_list = "SELECT * FROM `class_date` WHERE `Date` <= '{$today}' ORDER BY `Date` DESC";
$class_list_result = mysqli_query($connection, $class_list);

// Location list 
$location_form = "SELECT `Location` FROM `location`";
$location_form_result = mysqli_query($connection, $location_form);

// class list main
$list_class = "SELECT * FROM `class` ORDER BY `Year` DESC LIMIT 3";
$list_class_result = mysqli_query($connection, $list_class);

// class list set classes
$list_class_set = "SELECT `Year` FROM `class` ORDER BY `Year`";
$list_class_set_result = mysqli_query($connection, $list_class_set);

// delete class list 
if (isset($_GET['remove_class'])) {
    $delete_class_ID = mysqli_real_escape_string($connection, $_GET['remove_class']);
    $delete_class = "DELETE FROM `class` WHERE `ID` = $delete_class_ID;";
    $delete_class_result = mysqli_query($connection, $delete_class);
    if ($delete_class_result) {
        header("location: add-class.php");
    }
}

// delete new class 
if (isset($_GET['remove_new_class'])) {
    $delete_new_class_ID = mysqli_real_escape_string($connection, $_GET['remove_new_class']);
    $delete_class = "DELETE FROM `class_date` WHERE `ID` = $delete_new_class_ID;";
    $delete_new_class_ID_result = mysqli_query($connection, $delete_class);
    if ($delete_new_class_ID_result) {
        header("location: add-class.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CLASS / DATE </title>
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
                <h1> CLASS / DATE </h1>
                <p style="color: red; font-weight: bold;">
                    <?php
                    if (!empty($errors)) {
                        foreach ($errors as $errors) {
                            echo $errors;
                        }
                    }
                    ?>
                </p>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>

            <div class="indicators">

                <!-- classes  -->
                <div class="box">
                    <h2> YEAR </h2>
                    <hr>
                    <?php
                    if (mysqli_num_rows($list_class_result) > 0) {
                        while ($list_Year = mysqli_fetch_assoc($list_class_result)) {
                            echo "
                            <div class='cl_list'>
                                <h2> {$list_Year['Year']} </h2>
                                <a href='add-class.php?remove_class={$list_Year['ID']}'> REMOVE </a>
                            </div>
                            ";
                        }
                    }
                    ?>
                    <br>
                    <div class="box_link">
                        <p> <a href="#" id="add_year"> ADD YEAR </a> </p>
                    </div>
                </div>

                <!-- classes details  -->
                <div class="box">
                    <h2> CLASS DATES </h2>
                    <hr>
                    <?php
                    if (mysqli_num_rows($set_classes_result) > 0) {
                        while ($new_class = mysqli_fetch_assoc($set_classes_result)) {
                            echo "
                            <div class='cl_list'>
                                <p> {$new_class['Date']} </p>
                                <p> {$new_class['Location']} </p>
                                <p> {$new_class['Class']} / {$new_class['Type']} </p>
                                <a href='add-class.php?remove_new_class={$new_class['ID']}'> REMOVE </a>
                            </div>
                            ";
                        }
                    }
                    ?>
                    <br>
                    <div class="box_link">
                        <p> <a href="#" id="add_class"> ADD CLASS DATE </a> </p>
                    </div>
                </div>
                <div class="box">
                    <h2> DATE DETAILS </h2>
                    <hr>
                    <?php
                    if (mysqli_num_rows($class_details_result) > 0) {
                        while ($view_class = mysqli_fetch_assoc($class_details_result)) {
                            echo "
                            <div class='cl_list view'>
                                <p> {$view_class['Date']} </p>
                                <p> {$view_class['Location']} </p>
                                <p> {$view_class['Class']} / {$view_class['Type']} </p>
                                <a href='view-class-details.php?view_class={$view_class['ID']}'> VIEW </a>
                            </div>
                            ";
                        }
                    }
                    ?>
                    <br>
                    <div class="box_link">
                        <p> <a href="#" id="view_more"> VIEW MORE </a> </p>
                    </div>
                </div>
            </div>

            <!-- add year form  -->
            <section class="popup_forms add_class_page">
                <div class="pop_form">
                    <form method="post">
                        <p class="close_btn"><img src="assect/img/icons/x-circle-solid-24.png" alt="close"></p>
                        <h2 style="text-align: center;"> Add New Class Year </h2>
                        <br>
                        <p>
                            <label for="add_year"> Year : </label>
                            <input type="number" name="add_year" id="add_year" min="2024" placeholder="Enter New Year" required>
                        </p>
                        <br>
                        <p>
                            <input type="submit" value="Add New Year" name="add_submit">
                        </p>
                    </form>
                </div>
            </section>

            <!-- Class view more  -->
            <section class="popup_forms view_more">
                <div class="pop_form">
                    <div class="box">
                        <p class="close_btn"><img src="assect/img/icons/x-circle-solid-24.png" alt="close"></p>
                        <h2 style="text-align: center;"> Filter Class </h2>
                        <br>
                        <?php
                        if (mysqli_num_rows($class_list_result) > 0) {
                            while ($list_clz = mysqli_fetch_assoc($class_list_result)) {
                                echo "
                            <div class='cl_list view'>
                                <p> {$list_clz['Date']} </p>
                                <p> {$list_clz['Location']} </p>
                                <p> {$list_clz['Class']} / {$list_clz['Type']} </p>
                                <a href='view-class-details.php?view_class={$list_clz['ID']}'> VIEW </a>
                            </div>
                            ";
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!-- class date & time set form  -->
            <section class="popup_forms add_class_time">
                <div class="pop_form">
                    <form method="post">
                        <p class="close_btn"><img src="assect/img/icons/x-circle-solid-24.png" alt="close"></p>
                        <h2 style="text-align: center;"> Add New Class </h2>
                        <br>
                        <p>
                            <label for="add_class_year"> Year : </label>
                            <select name="set_time_class" id="add_class_year" required>
                                <option value=""> Chooce class </option>
                                <?php
                                if (mysqli_num_rows($list_class_set_result) > 0) {
                                    while ($classes = mysqli_fetch_assoc($list_class_set_result)) {
                                        echo " <option value='{$classes['Year']}'> {$classes['Year']} </option> ";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label for="class_type"> Type : </label>
                            <select name="set_type_class" id="class_type" required>
                                <option value=""> Chooce class type </option>
                                <option value="T"> Theory </option>
                                <option value="R"> Revition </option>
                                <option value="P"> Paper </option>
                            </select>
                        </p>
                        <p>
                            <label for="set_location"> Location : </label>
                            <select name="set_location" id="set_location" required>
                                <option value=""> Chooce Location </option>
                                <?php
                                if (mysqli_num_rows($location_form_result) > 0) {
                                    while ($locations = mysqli_fetch_assoc($location_form_result)) {
                                        echo " <option value='{$locations['Location']}'> {$locations['Location']} </option> ";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label for="set_date"> Date : </label>
                            <input type="date" id="set_date" name="set_date" min="<?php echo date("Y-m-d"); ?>" required>
                        </p>
                        <br>
                        <p>
                            <input type="submit" value="Add New Class" name="set_submit">
                        </p>
                    </form>
                </div>
            </section>
        </section>
    </div>

    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>