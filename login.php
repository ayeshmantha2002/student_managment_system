<?php
session_start();
include("includes/connection.php");
$errors = array();
$username = "";
$password = "";

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $hass_password = sha1($password);

    $login = "SELECT * FROM `users` WHERE (`Username` = '{$username}' AND `Password` = '{$hass_password}') AND (`Class` = 'ADMIN' OR `Class` = 'OWNER') LIMIT 1";
    $login_result = mysqli_query($connection, $login);
    if (mysqli_num_rows($login_result) == 1) {
        $fetch_details = mysqli_fetch_assoc($login_result);
        $_SESSION['ID'] = $fetch_details['ID'];

        if (isset($_POST['remember'])) {
            setcookie('ID', $_SESSION['ID'], time() + 60 * 60 * 24 * 20);
        }
        header("location: index.php");
    } else {
        $errors[] = 'Invalied Username or Password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LOGIN </title>
    <link rel="stylesheet" href="assect/css/style.css">
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
                <h3> LOGIN </h3>
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
                        <input type="checkbox" name="remember" id="remember"> <label for="remember">Remember me.</label>
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="LOGIN" name="submit">
                    </p>
                </form>
            </div>
        </section>
    </div>
    <script src="assect/js/secu.js"></script>
</body>

</html>