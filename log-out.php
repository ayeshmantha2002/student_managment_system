<?php
session_start();

$_SESSION   =   array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
}

setcookie('ID', NULL, -time() + 60 * 60 * 24 * 20);
setcookie('cookieClass', NULL, -time() + 60 * 60 * 12);
setcookie('cookieLocation', NULL, -time() + 60 * 60 * 12);
setcookie('cookieLocation', NULL, -time() + 60 * 60 * 12);
// setcookie('userName', NULL, -time() + 60 * 60 * 24 * 20);

session_destroy();

$val    = "successful";
$success = sha1($val);

header("location:login.php?Logout=$success");
