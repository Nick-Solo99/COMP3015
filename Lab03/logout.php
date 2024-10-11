<?php
session_start();
unset($_SESSION['validated']);
session_destroy();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600);
}
header('location: login.php');
?>
