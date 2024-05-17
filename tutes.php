<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$tname = "";
$num_tutes = "";
$year = "";
$date = "";
$errors = array();

include("includes/connection.php");

// classes
$classes = "SELECT * FROM `class`";
$classes_result = mysqli_query($connection, $classes);

// classes select option
$classes_select = "SELECT * FROM `class`";
$classes_select_result = mysqli_query($connection, $classes_select);


// inser tutes 
if (isset($_POST['add_tutes'])) {
    $tname = ucfirst(mysqli_real_escape_string($connection, $_POST['tname']));
    $num_tutes = mysqli_real_escape_string($connection, $_POST['num_tutes']);
    $year = mysqli_real_escape_string($connection, $_POST['year']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);

    $check_tutes = "SELECT * FROM `tutes` WHERE `Tute_name` = '{$tname}' AND `Class` = '{$year}'";
    $check_tutes_result = mysqli_query($connection, $check_tutes);
    if (mysqli_num_rows($check_tutes_result) > 0) {
        $errors[] = "This tute is already exists.";
    } else {
        $insert_tute = "INSERT INTO `tutes` (`Tute_name`, `Class`, `Start_date`, `Counte`, `Delivered`, `Action`) VALUES ('{$tname}', '{$year}', '{$date}', {$num_tutes}, 0, 1)";
        $insert_tute_result = mysqli_query($connection, $insert_tute);
        if ($insert_tute_result) {
            header("location: tutes.php");
        }
    }
}

// delete tutes
if (isset($_GET['delete_tute_id'])) {
    $delete_id = mysqli_real_escape_string($connection, $_GET['delete_tute_id']);
    $delete_tute = "DELETE FROM `tutes` WHERE `ID` = {$delete_id}";
    $delete_tute_result = mysqli_query($connection, $delete_tute);
    if ($delete_tute_result) {
        header("location: tutes.php");
    }
}

// list students 
if (isset($_GET['filter_class'])) {
    $filter_class = mysqli_real_escape_string($connection, $_GET['filter_class']);
    $tutes_list = "SELECT * FROM `tutes` WHERE `Class` = '{$filter_class}' ORDER BY `Class` ASC ";
} elseif (isset($_POST['search'])) {
    $filter_tutes = mysqli_real_escape_string($connection, $_POST['search']);
    $tutes_list = "SELECT * FROM `tutes` WHERE (`Tute_name` LIKE '%{$filter_tutes}%') ORDER BY `Class` ASC ";
} else {
    $tutes_list = "SELECT * FROM `tutes` ORDER BY `Class` ASC, `ID` DESC ";
}
$tutes_list_result = mysqli_query($connection, $tutes_list);

// edit tutes details 
if (isset($_GET['edit_tute_id'])) {
    $display = "flex";
    $tute_id = mysqli_real_escape_string($connection, $_GET['edit_tute_id']);
    $tute_det = "SELECT * FROM `tutes` WHERE `ID` = {$tute_id}";
    $tute_det_result = mysqli_query($connection, $tute_det);
    if (mysqli_num_rows($tute_det_result) > 0) {
        $details = mysqli_fetch_assoc($tute_det_result);
        $old_t_name = $details['Tute_name'];
        $old_t_number = $details['Counte'];
        $old_c_year = $details['Class'];
        $old_up_date = $details['Start_date'];
        $Action = $details['Action'];

        if ($Action == 0) {
            $open_display = "none";
            $closed_display = "block";
        } elseif ($Action = 1) {
            $open_display = "block";
            $closed_display = "none";
        }
    }

    if (isset($_POST['up_submit'])) {
        $t_name = mysqli_real_escape_string($connection, $_POST['t_name']);
        $t_number = mysqli_real_escape_string($connection, $_POST['t_number']);
        $c_year = mysqli_real_escape_string($connection, $_POST['c_year']);
        $up_date = mysqli_real_escape_string($connection, $_POST['up_date']);

        $upadate_tute = "UPDATE `tutes` SET `Tute_name` = '{$t_name}', `Class` = '{$c_year}', `Counte` = {$t_number}, `Start_date` = '{$up_date}' WHERE `ID` = {$tute_id}";
        $upadate_tute_result = mysqli_query($connection, $upadate_tute);
        if ($upadate_tute_result) {
            header("location: tutes.php");
        }
    }

    // cosed 
    if (isset($_POST['closed'])) {
        $closed = "UPDATE `tutes` SET `Action` = 0 WHERE `ID` = {$tute_id}";
        $closed_result = mysqli_query($connection, $closed);
        if ($closed_result) {
            header("location: tutes.php");
        }
    }

    // open 
    if (isset($_POST['open'])) {
        $open = "UPDATE `tutes` SET `Action` = 1 WHERE `ID` = {$tute_id}";
        $open_result = mysqli_query($connection, $open);
        if ($open_result) {
            header("location: tutes.php");
        }
    }
} else {
    $display = "none";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TUTES </title>
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
                <h1> TUTES </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>
            <br>
            <div class="search">
                <form method="post">
                    <p> <input type="search" name="search" placeholder="Search tute number or name."> </p>
                </form>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <div>
                        <h2> Filter Option </h2>
                        <br>
                        <ul>
                            <?php
                            if (mysqli_num_rows($classes_result) > 0) {
                                while ($class_fetch = mysqli_fetch_assoc($classes_result)) {
                                    echo " <li> <a href='tutes.php?filter_class={$class_fetch['Year']}'> {$class_fetch['Year']} </a> </li> ";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div>
                        <h2> Add Tutes </h2>
                        <p style="text-align: center; font-weight: bold; color: red;">
                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $errors) {
                                    echo $errors;
                                }
                            }
                            ?>
                        </p>
                        <br>
                        <form method="post">
                            <p>
                                <label for="tname"> Tute Name : </label>
                                <input type="text" name="tname" id="tname" placeholder="Tute Name" required value="<?= $tname; ?>">
                            </p>
                            <br>
                            <p>
                                <label for="num_tutes"> Number of tute : </label>
                                <input type="number" name="num_tutes" id="num_tutes" placeholder="Number of tute" min="1" value="<?= $num_tutes; ?>" required>
                            </p>
                            <br>
                            <p>
                                <label for="year"> Chooce Year : </label>
                                <select name="year" required>
                                    <option value=""> Chooce Year </option>
                                    <?php
                                    if (mysqli_num_rows($classes_select_result) > 0) {
                                        while ($classes_select_fetch = mysqli_fetch_assoc($classes_select_result)) {
                                            echo " <option value='{$classes_select_fetch['Year']}'> {$classes_select_fetch['Year']} </option> ";
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <br>
                            <p>
                                <label for="date"> Delivery start date : </label>
                                <input type="date" name="date" id="date" min="<?= date("Y-m-d") ?>" value="<?= $date; ?>" required>
                            </p>
                            <br>
                            <p>
                                <input type="submit" name="add_tutes" value="Add Student">
                            </p>
                        </form>
                    </div>
                </div>
                <div class="students">
                    <table>

                        <?php
                        if (mysqli_num_rows($tutes_list_result) > 0) {
                            echo "
                            <tr>
                                <th> Tute Number </th>
                                <th> Tute Name </th>
                                <th> Class </th>
                                <th> Total Tutes </th>
                                <th> Remaining </th>
                                <th> Delivery start date </th>
                                <th colspan='3' style='text-align: center;'> Action </th>
                            </tr>
                            ";
                            while ($tutes_details = mysqli_fetch_assoc($tutes_list_result)) {
                                $t = $tutes_details['Counte'];
                                $d = $tutes_details['Delivered'];
                                $b = $t - $d;

                                if ($b < 0) {
                                    $red = "style='background-color: #ff63477a;'";
                                } else {
                                    $red = "";
                                }

                                echo "
                                <tr {$red}>
                                    <td> {$tutes_details['ID']} </td>
                                    <td> {$tutes_details['Tute_name']} </td>
                                    <td> {$tutes_details['Class']} </td>
                                    <td> {$tutes_details['Delivered']} / {$tutes_details['Counte']} </td>
                                    <td> $b </td>
                                    <td> {$tutes_details['Start_date']} </td>

                                    <td> <span class='view'> <a href='view-tute.php?tute_id={$tutes_details['ID']}'>VIEW</a> </span> </td>

                                    <td> <a href='tutes.php?edit_tute_id={$tutes_details['ID']}'>Edit</a> </td>
                                    
                                    <td> <span class='delete'> <a href='tutes.php?delete_tute_id={$tutes_details['ID']}'>Delete</a> </ span> </td>
                                </tr>
                                ";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>

            <section class="update_students" style="z-index: 1; opacity: 1; display: <?= $display; ?>;">
                <form method="post" enctype="multipart/form-data">
                    <p class="close_btn"><img src="assect/img/icons/x-circle-solid-24.png" alt="close"></p>
                    <h2> Update details </h2>
                    <br>
                    <p>
                        <label for="t_name"> Tute Name :</label>
                        <input type="text" name="t_name" id="t_name" value="<?= $old_t_name; ?>" placeholder="Tute Name" required>
                    </p>
                    <br>
                    <p>
                        <label for="t_number"> Number of tute :</label>
                        <input type="number" name="t_number" id="t_number" value="<?= $old_t_number; ?>" placeholder="Number of tute" required>
                    </p>
                    <br>
                    <p>
                        <label for="c_year"> Class Year :</label>
                        <input type="number" name="c_year" id="c_year" min="2024" value="<?= $old_c_year; ?>" placeholder="Class Year" required>
                    </p>
                    <br>
                    <p>
                        <label for="up_date"> Delivery start date : </label>
                        <input type="text" name="up_date" id="up_date" min="2024" value="<?= $old_up_date; ?>" placeholder="Delivery start date" required>
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="Update" name="up_submit">
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="CLOSED" name="closed" style="background-color: tomato; display: <?= $open_display; ?>;">
                    </p>
                    <p>
                        <input type="submit" value="OPEN" name="open" style="background-color: blue; display: <?= $closed_display; ?>;">
                    </p>
                </form>
            </section>

        </section>
    </div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/secu.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>