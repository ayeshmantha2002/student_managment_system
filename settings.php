<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$errors = array();

$today = date("Y-m-d");

include("includes/connection.php");

if (isset($_POST['dark'])) {
    setcookie('dark', $_POST['dark'], time() + 60 * 60 * 24 * 20);
    header("location: settings.php");
} elseif (isset($_POST['light'])) {
    setcookie('dark', '', -time() + 60 * 60 * 24 * 20);
    header("location: settings.php");
}

// admin list
$admin_list = "SELECT * FROM `admin` WHERE `Position` != 'OWNER'";
$admin_list_result = mysqli_query($connection, $admin_list);

// fetch admin personal details 
$my_details = "SELECT * FROM `admin` WHERE `ID` = {$_SESSION['ID']} AND (`Position` = 'OWNER' OR `Position` = 'ADMIN')";
$my_details_result = mysqli_query($connection, $my_details);
if (mysqli_num_rows($my_details_result) == 1) {
    $fetchMyDetails = mysqli_fetch_assoc($my_details_result);
    $fname = $fetchMyDetails['First_name'];
    $lname = $fetchMyDetails['Last_name'];
    $uname = $fetchMyDetails['Username'];
    $Position = $fetchMyDetails['Position'];

    if ($Position == "OWNER") {
        $hidden = "";
    } else {
        $hidden = "hidden";
    }
}

// update admin personal details 
if (isset($_POST['update_details'])) {

    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $uname = mysqli_real_escape_string($connection, $_POST['uname']);

    // chech user name
    $check_my_details = "SELECT * FROM `admin` WHERE `ID` != {$_SESSION['ID']} AND `Username` = '{$uname}'";
    $check_my_details_result = mysqli_query($connection, $check_my_details);

    if (mysqli_num_rows($check_my_details_result) == 1) {
        $errors[] = "Username already exists";
    } else {
        $up_my_details = "UPDATE `admin` SET `First_name` = '{$fname}', `Last_name` = '{$lname}', `Username` = '{$uname}' WHERE `ID` = {$_SESSION['ID']}";
        $up_my_details_result = mysqli_query($connection, $up_my_details);
        if ($up_my_details_result) {
            header("location: settings.php");
        }
    }
}

// update admin password
if (isset($_POST['update_pass'])) {
    $Cpass = mysqli_real_escape_string($connection, $_POST['Cpass']);
    $Npass = mysqli_real_escape_string($connection, $_POST['Npass']);
    $CNpass = mysqli_real_escape_string($connection, $_POST['CNpass']);

    $hash_Cpass = sha1($Cpass);
    $hash_Npass = sha1($Npass);

    $check_my_pass = "SELECT `ID`,`Password` FROM `admin` WHERE `ID` = {$_SESSION['ID']} AND `Password` = '{$hash_Cpass}'";
    $check_my_pass_result = mysqli_query($connection, $check_my_pass);
    if (mysqli_num_rows($check_my_pass_result) == 1) {
        if ($Npass == $CNpass) {
            $up_my_pass = "UPDATE `admin` SET `Password` = '{$hash_Npass}' WHERE `ID` = {$_SESSION['ID']}";
            $up_my_pass_result = mysqli_query($connection, $up_my_pass);
            if ($up_my_pass_result) {
                header("location: settings.php");
            }
        } else {
            $errors[] = "The new password and the confirmation password do not match";
        }
    } else {
        $errors[] = "The current password does not match";
    }
} else {
    $Cpass = "";
    $Npass = "";
    $CNpass = "";
}

// location fetch
$branch = "SELECT * FROM `location`";
$branch_result = mysqli_query($connection, $branch);

// add new admin 
if (isset($_POST['add_admin'])) {
    $fnameA = ucfirst(mysqli_real_escape_string($connection, $_POST['fnameA']));
    $lnameA = ucfirst(mysqli_real_escape_string($connection, $_POST['lnameA']));
    $unameA = mysqli_real_escape_string($connection, $_POST['unameA']);
    $pwordA = mysqli_real_escape_string($connection, $_POST['pwordA']);
    $branchA = mysqli_real_escape_string($connection, $_POST['branchA']);

    $hash_pwordA = sha1($pwordA);

    // check user name
    $check_admin = "SELECT * FROM `admin` WHERE `Username` = '{$unameA}'";
    $check_admin_result = mysqli_query($connection, $check_admin);

    if (mysqli_num_rows($check_admin_result) == 1) {
        $errors[] = "Username already exists";
    } else {
        $Add_admin = "INSERT INTO `admin` (`First_name`, `Last_name`, `Username`, `Position`, `Location`, `Password`) VALUES ('{$fnameA}', '{$lnameA}', '{$unameA}', 'ADMIN', '{$branchA}', '{$hash_pwordA}')";
        $Add_admin_result = mysqli_query($connection, $Add_admin);
        if ($Add_admin_result) {
            header("location: settings.php");
        }
    }
} else {
    $fnameA  = "";
    $lnameA  = "";
    $unameA  = "";
    $pwordA  = "";
    $branchA = "";
}

// delete admin
if (isset($_POST['del_id'])) {
    $delete_admin = "DELETE FROM `admin` WHERE `ID` = {$_POST['del_id']}";
    $delete_admin_result = mysqli_query($connection, $delete_admin);
    if ($delete_admin_result) {
        header("location: settings.php");
    }
}

// delete branch
if (isset($_POST['branch_delete_id'])) {
    $del_branch_id = mysqli_real_escape_string($connection, $_POST['branch_delete_id']);
    $delete_branch = "DELETE FROM `location` WHERE `ID` = {$del_branch_id}";
    $delete_branch_result = mysqli_query($connection, $delete_branch);
    if ($delete_branch_result) {
        header("location: settings.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SETTINGS </title>
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="assect/css/settings.css">
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
                <h1> SETTINGS </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <h2> ADMINS </h2>
                    <div class="adminslist">
                        <ul>
                            <!-- Admin delete form -->
                            <?php
                            if (mysqli_num_rows($admin_list_result) > 0) {
                                while ($fetch_admins = mysqli_fetch_assoc($admin_list_result)) {
                                    echo "
                                        <form method='post' onsubmit='return confirmDelete();'>
                                            <input type='hidden' name='del_id' value='{$fetch_admins['ID']}'>
                                            <li> <span> {$fetch_admins['First_name']} {$fetch_admins['Last_name']} </span> 
                                                <span> {$fetch_admins['Location']} </span> 
                                                <span {$hidden}> 
                                                    <button type='submit'>Delete</button> 
                                                </span> 
                                            </li>
                                        </form>
                                        ";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="adminslist">
                        <h2> Branch Management </h2>
                        <br>
                        <ul>
                            <!-- Branch delete form -->
                            <?php
                            $branch_list = "SELECT * FROM `location`";
                            $branch_list_result = mysqli_query($connection, $branch_list);
                            if (mysqli_num_rows($branch_list_result) > 0) {
                                while ($branches = mysqli_fetch_assoc($branch_list_result)) {
                                    echo "
                                    <form method='post' onsubmit='return confirmDelete();'>
                                        <input type='hidden' name='branch_delete_id' value='{$branches['ID']}'>
                                        <li> <span> {$branches['location']} </span> 
                                            <span> {$branches['UID']} </span> 
                                            <button type='submit' {$hidden}>Delete</button>
                                        </li>
                                    </form>
                                    ";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div>
                        <h2> MODE </h2>
                        <br>
                        <form method="post">
                            <p>
                                <input type="submit" value="Light" name="light" style="background-color: white; color: black; box-shadow: 0 0 10px var(--shadow);">
                            </p>
                            <br>
                            <p>
                                <input type="submit" value="Dark" name="dark" style="background-color: black; box-shadow: 0 0 10px var(--shadow)">
                            </p>
                        </form>
                    </div>
                </div>
                <div class="students">
                    <div style="color: red; text-align: center;">
                        <?php
                        if (!empty($errors)) {
                            foreach ($errors as $errors) {
                                echo $errors;
                            }
                        }
                        ?>
                    </div>
                    <div class="settings">

                        <!-- Admin personal details form  -->
                        <h2> Change My details </h2>
                        <br>
                        <form method="post">
                            <p>
                                First Name :
                                <input type="text" placeholder="First Name" value="<?= $fname; ?>" name="fname" required>
                            </p>
                            <br>
                            <p>
                                Last Name :
                                <input type="text" placeholder="Last Name" value="<?= $lname; ?>" name="lname" required>
                            </p>
                            <br>
                            <p>
                                Username :
                                <input type="text" placeholder="Username" value="<?= $uname; ?>" name="uname" required>
                            </p>
                            <br>
                            <p>
                                <input type="submit" value="Update Details" name="update_details">
                            </p>
                        </form>
                        <br><br><br>

                        <!-- admin password change form  -->
                        <h2> Change Password </h2>
                        <br>
                        <form method="post">
                            <p>
                                Current Password :
                                <input type="password" placeholder="Current Password" value="<?= $Cpass; ?>" name="Cpass" required>
                            </p>
                            <br>
                            <p>
                                New Password :
                                <input type="password" placeholder="New Password" value="<?= $Npass; ?>" name="Npass" required minlength="6">
                            </p>
                            <br>
                            <p>
                                Confirm New Password :
                                <input type="password" placeholder="Confirm New Password" value="<?= $CNpass; ?>" name="CNpass" required minlength="6">
                            </p>
                            <br>
                            <p>
                                <input type="submit" value="Update Password" name="update_pass">
                            </p>
                        </form>
                        <br><br><br>

                        <!-- add new admin form  -->
                        <div class="addmin" <?= $hidden; ?>>
                            <h2> ADD ADMIN </h2>
                            <br>
                            <form method="post">
                                <p>
                                    First Name :
                                    <input type="text" placeholder="First Name" value="<?= $fnameA; ?>" name="fnameA" required>
                                </p>
                                <br>
                                <p>
                                    Last Name :
                                    <input type="text" placeholder="Last Name" value="<?= $lnameA; ?>" name="lnameA" required>
                                </p>
                                <br>
                                <p>
                                    Username :
                                    <input type="text" placeholder="Username" value="<?= $unameA; ?>" name="unameA" required>
                                </p>
                                <br>
                                <p>
                                    Password :
                                    <input type="text" placeholder="Password" value="<?= $pwordA; ?>" name="pwordA" required>
                                </p>
                                <br>
                                <p>
                                    Choose branch :
                                    <select name="branchA" required>
                                        <option value=""> Choose branch </option>
                                        <?php
                                        if (mysqli_num_rows($branch_result) > 0) {
                                            while ($fetchLocation = mysqli_fetch_assoc($branch_result)) {
                                                echo "
                                                <option value='{$fetchLocation['location']}'> {$fetchLocation['location']} </option>
                                                ";
                                            }
                                        }
                                        ?>
                                    </select>
                                </p>
                                <br>
                                <p>
                                    <input type="submit" value="ADD ADMIN" name="add_admin">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</body>

</html>