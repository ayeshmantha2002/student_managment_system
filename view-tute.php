<?php
session_start();
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

if (!isset($_GET['tute_id'])) {
    header("location: tutes.php");
}

include("includes/connection.php");

// list tutes 
$tutes_list = "SELECT * FROM `tutes` ORDER BY `Class` ASC, `ID` DESC ";
$tutes_list_result = mysqli_query($connection, $tutes_list);

// select tutes 
$select_tute = "SELECT * FROM `tutes` WHERE `ID` = {$_GET['tute_id']}";
$select_tute_result = mysqli_query($connection, $select_tute);

if (mysqli_num_rows($select_tute_result) > 0) {
    $tuteDETAILS = mysqli_fetch_assoc($select_tute_result);
    $Tute_name = $tuteDETAILS['Tute_name'];
    $Counte = $tuteDETAILS['Counte'];
    $Delivered = $tuteDETAILS['Delivered'];
    $Class = $tuteDETAILS['Class'];
    $remind = $Counte - $Delivered;
}

// tute details
$tutes = "SELECT * FROM `deliverd_tute` WHERE `Tute_ID` = {$_GET['tute_id']} ORDER BY `Student_ID`";
$tutes_result = mysqli_query($connection, $tutes);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW TUTE DETAILS</title>
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
                <h1> TUTES DETAILS </h1>
                <h1> <?php echo date("Y / M / d"); ?> </h1>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <div>
                        <ul>
                            <li> <a href='tutes.php'> BACK </a> </li>
                        </ul>
                    </div>

                    <div>
                        <h2> Tute Details </h2>
                        <br>
                        <form style="color: var(--text); text-align: center;">
                            <p> <input type="text" value="<?= $Tute_name . " | " . $Class ?>" readonly> </p>
                            <br>
                            <h3> Total : <?= $Counte; ?> </h3>
                            <h3> Delivered : <?= $Delivered; ?> </h3>
                            <br>
                            <h3> Remaining : <?= $remind; ?> </h3>
                        </form>
                    </div>

                    <div class="tb_alin">
                        <table>

                            <?php
                            if (mysqli_num_rows($tutes_list_result) > 0) {
                                echo "
                                    <tr>
                                        <th> Tute Name </th>
                                        <th> Class </th>
                                        <th> Total Tutes </th>
                                        <th> Remaining </th>
                                        <th style='text-align: center;'> Action </th>
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
                                            <td> {$tutes_details['Tute_name']} </td>
                                            <td> {$tutes_details['Class']} </td>
                                            <td> {$tutes_details['Delivered']} / {$tutes_details['Counte']} </td>
                                            <td> {$b} </td>
                                            <td> <span class='view'> <a href='view-tute.php?tute_id={$tutes_details['ID']}'>VIEW</a> </span> </td>
                                        </tr>
                                    ";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="students">
                    <table>
                        <?php
                        if (mysqli_num_rows($tutes_result) > 0) {
                            echo "
                            <tr>
                                <th> Student ID </th>
                                <th> Name </th>
                                <th> Tute Name </th>
                                <th> Delivered date </th>
                            </tr>
                            ";
                            while ($tuteFetch = mysqli_fetch_assoc($tutes_result)) {
                                $Student_ID = $tuteFetch['Student_ID'];
                                $ST_name = $tuteFetch['ST_name'];
                                $Date = $tuteFetch['Date'];

                                // check double tutes 
                                $chech_tutes_list = "SELECT * FROM `deliverd_tute` WHERE `Student_ID` = '{$Student_ID}' AND `Tute_ID` = {$_GET['tute_id']} AND `Class` = '{$Class}'";
                                $chech_tutes_list_result = mysqli_query($connection, $chech_tutes_list);
                                if (mysqli_num_rows($chech_tutes_list_result) > 1) {
                                    echo "
                                    <tr style='background-color: #ff63477a;'>
                                        <td> {$Student_ID} </td>
                                        <td> {$ST_name} </td>
                                        <td> {$Tute_name} </td>
                                        <td> {$Date} </td>
                                    </tr>
                                    ";
                                } else {
                                    echo "
                                    <tr>
                                        <td> {$Student_ID} </td>
                                        <td> {$ST_name} </td>
                                        <td> {$Tute_name} </td>
                                        <td> {$Date} </td>
                                    </tr>
                                    ";
                                }
                            }
                        }
                        ?>

                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/secu.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>