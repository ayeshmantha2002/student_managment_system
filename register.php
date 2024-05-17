<?php
session_start();
include("includes/connection.php");
$errors = array();
$username = "";
$password = "";
$cpassword = "";
$Frist_name = "";
$Last_name = "";
$location = "";

$owner = "SELECT * FROM `admin`";
$owner_result = mysqli_query($connection, $owner);
if (mysqli_num_rows($owner_result) > 0) {
    header("location: login.php");
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $hass_password = sha1($password);
    $Frist_name = ucfirst(mysqli_real_escape_string($connection, $_POST['Frist_name']));
    $Last_name = ucfirst(mysqli_real_escape_string($connection, $_POST['Last_name']));
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $location = ucfirst(mysqli_real_escape_string($connection, $_POST['location']));

    if ($password == $cpassword) {
        $register = "INSERT INTO `admin` (`First_name`, `Last_name`, `Username`, `Position`, `Location`, `Password`) VALUES ('{$Frist_name}', '{$Last_name}', '{$username}', 'OWNER', '{$location}', '{$hass_password}')";
        $register_result = mysqli_query($connection, $register);
        if ($register_result) {
            header("location: login.php");
        }
    } else {
        $errors[] = "The password and the confirmation password do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> REGISTER </title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo " <link rel='stylesheet' href='assect/css/dark.css'> ";
    }
    ?>
</head>

<body>
    <div class="login_content">
        <section class="form_page">
            <div class="details">
                <img src="assect/img/imgs/logosq.png" alt="logo">
                <br><br>
                <h1> Mr.ChemistrY </h1>
                <p> STUDENT MANAGMENT SYSTEM </p>
            </div>
            <div class="form">
                <h3> REGISTER </h3>
                <br>
                <div style="color: red;">
                    <?php
                    if (!empty($errors)) {
                        foreach ($errors as $errors) {
                            echo $errors;
                        }
                    }
                    ?>
                </div>
                <br>
                <form method="post">
                    <p>
                        <label for="Frist_name"> Frist name : </label>
                        <input type="text" placeholder="Frist name" id="Frist_name" name="Frist_name" value="<?php echo $Frist_name ?>">
                    </p>
                    <br>
                    <p>
                        <label for="Last_name"> Last name : </label>
                        <input type="text" placeholder="Last name" id="Last_name" name="Last_name" value="<?php echo $Last_name ?>">
                    </p>
                    <br>
                    <p>
                        <label for="username"> Username : </label>
                        <input type="text" placeholder="Username" id="username" name="username" value="<?php echo $username ?>">
                    </p>
                    <br>
                    <p>
                        <label for="password"> Password : </label>
                        <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $password ?>">
                    </p>
                    <br>
                    <p>
                        <label for="cpassword"> Confirm Password : </label>
                        <input type="password" placeholder="cPassword" id="cpassword" name="cpassword" value="<?php echo $cpassword ?>">
                    </p>
                    <br>
                    <p>
                        <label for="location"> Branch location : </label>
                        <input type="location" placeholder="Branch Location" id="location" name="location" value="<?php echo $location ?>">
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="REGISTER" name="submit">
                    </p>
                </form>
            </div>
        </section>
    </div>
    <script src="assect/js/secu.js"></script>
</body>

</html>