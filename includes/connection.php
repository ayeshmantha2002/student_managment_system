<?php
$dbhost      =   "localhost";
$dbuser      =   "root";
$dbpassword  =   "";
$dbname      =   "student_management";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}
