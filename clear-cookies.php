<?php
// clear cookies 
setcookie('cookieClass', NULL, -time() + 60 * 60 * 12);
setcookie('cookieLocation', NULL, -time() + 60 * 60 * 12);
setcookie('cookieType', NULL, -time() + 60 * 60 * 12);
setcookie('cookieTute', NULL, -time() + 60 * 60 * 12);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Clear </title>
    <link rel="stylesheet" href="assect/css/style.css">
    <?php
    if (isset($_COOKIE['dark'])) {
        echo " <link rel='stylesheet' href='assect/css/dark.css'> ";
    }
    ?>
</head>

<body>
    <!-- clear cookies message  -->
    <section class="popup_forms" style="z-index: 1; opacity: 1;">
        <div class="pop_form">
            <p style="text-align: center;"> <img width="100px" src="assect/img/imgs/done.png" alt="done"> </p>
            <h3 style="text-align: center;"> The attendance form was redesigned. </h3>
            <br>
            <p style="text-align: center;"> <a href="attendance.php"> OK </a> </p>
            <br>
        </div>
    </section>
</body>

</html>