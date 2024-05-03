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
    <title> CLASS / DATE </title>
    <link rel="stylesheet" href="assect/css/style.css">
</head>

<body>
    <div class="webcontent">
        <?php
        include("includes/sidenav.php");
        ?>

        <section class="content">
            <div class="date">
                <h1> CLASS / DATE </h1>
                <h1> <?php echo date("Y-m-d"); ?> </h1>
            </div>
            <div class="indicators">
                <div class="box">
                    <h2> YEAR </h2>
                    <hr>
                    <div class="cl_list">
                        <h2> 2024 </h2>
                        <a href="#"> REMOVE </a>
                    </div>
                    <div class="cl_list">
                        <h2> 2025 </h2>
                        <a href="#"> REMOVE </a>
                    </div>
                    <div class="cl_list">
                        <h2> 2026 </h2>
                        <a href="#"> REMOVE </a>
                    </div>
                    <br>
                    <div class="box_link">
                        <p> <a href="#"> ADD YEAR </a> </p>
                    </div>
                </div>
                <div class="box">
                    <h2> CLASS DATES </h2>
                    <hr>
                    <div class="cl_list">
                        <p> 2024-04-30 </p>
                        <p> Bandarawela </p>
                        <p> 2024 </p>
                        <a href="#"> REMOVE </a>
                    </div>
                    <div class="cl_list">
                        <p> 2024-05-01 </p>
                        <p> Badulla </p>
                        <p> 2024 </p>
                        <a href="#"> REMOVE </a>
                    </div>
                    <div class="cl_list">
                        <p> 2024-05-02 </p>
                        <p> Badulla </p>
                        <p> 2024 </p>
                        <a href="#"> REMOVE </a>
                    </div>
                    <br>
                    <div class="box_link">
                        <p> <a href="#"> ADD CLASS DATE </a> </p>
                    </div>
                </div>
                <div class="box">
                    <h2> DATE DETAILS </h2>
                    <hr>
                    <div class="cl_list view">
                        <p> 2024-04-30 </p>
                        <p> Badulla </p>
                        <p> 2024 </p>
                        <a href="#"> VIEW </a>
                    </div>
                    <div class="cl_list view">
                        <p> 2024-04-30 </p>
                        <p> Bandarawela </p>
                        <p> 2024 </p>
                        <a href="#"> VIEW </a>
                    </div>
                    <div class="cl_list view">
                        <p> 2024-04-30 </p>
                        <p> Badulla </p>
                        <p> 2024 </p>
                        <a href="#"> VIEW </a>
                    </div>
                    <br>
                    <div class="box_link">
                        <p> <a href="#"> VIEW MORE </a> </p>
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