<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> DASHBOARD </title>
    <link rel="stylesheet" href="assect/css/style.css">
</head>

<body>
    <div class="webcontent">
        <?php
        include("includes/sidenav.php");
        ?>

        <section class="content">
            <div class="date">
                <h1> DASHBOARD </h1>
                <h1> <?php echo date("Y-m-d"); ?> </h1>
            </div>
            <br>
            <div class="indicators_dash">
                <div class="lg_box">
                    <div class="box">
                        <div class="detalis">
                            <div>
                                <h2> 2024 </h2>
                                <hr>
                            </div>
                            <div>
                                <p> Badulla - 250 </p>
                                <p> Bandarawela - 150 </p>
                            </div>
                            <div>
                                <h3> Total - 400 </h3>
                            </div>
                        </div>
                        <div class="img">
                            <img src="assect/img/imgs/user.png" alt="user">
                        </div>
                    </div>
                    <div class="box">
                        <div class="detalis">
                            <div>
                                <h2> 2025 </h2>
                                <hr>
                            </div>
                            <div>
                                <p> Badulla - 300 </p>
                                <p> Bandarawela - 150 </p>
                            </div>
                            <div>
                                <h3> Total - 450 </h3>
                            </div>
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
                                <p> Badulla - 2 </p>
                                <p> Bandarawela - 1 </p>
                            </div>
                            <div>
                                <h3> Total - 3 </h3>
                            </div>
                        </div>
                        <div class="img">
                            <img src="assect/img/imgs/admin.png" alt="user">
                        </div>
                    </div>
                    <div class="box"></div>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>