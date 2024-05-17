<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>already_exist</title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo " <link rel='stylesheet' href='assect/css/dark.css'> ";
    }
    ?>
</head>

<body>
    <!-- already_exist  -->
    <section class="popup_forms" style="z-index: 1;  opacity: 1;">
        <div class="pop_form">
            <p style="text-align: center;"> <img width="100px" src="assect/img/imgs/x-png.png" alt="done"> </p>
            <h3 style="text-align: center;"> already exist. </h3>
            <br>
            <p style="text-align: center;"> <a href="attendance.php" style="background-color: red;"> OK </a> </p>
            <br>
        </div>
    </section>
</body>

</html>