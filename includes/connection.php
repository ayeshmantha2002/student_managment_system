<?php
$dbhost      =   "localhost";
$dbuser      =   "ayeshmantha";
$dbpassword  =   "111111";
$dbname      =   "student_management";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}
