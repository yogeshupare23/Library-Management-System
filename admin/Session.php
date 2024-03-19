<?php

include 'db_connect.php';
session_start();

$user_check = $_SESSION['email'];
$role_check = $_SESSION['role'];
if (isset ($_SESSION['role']) && isset ($_SESSION['email'])) {
    if ($_SESSION['role'] == "student") {
        $ses_sql = mysqli_query($connection, "select email from users where email = '$user_check' ");

    } else if ($_SESSION["role"] == "admin") {
        $ses_sql = mysqli_query($connection, "select email from admins where email = '$user_check' ");

    }
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    $login_session = $row['email'];
    if ($user_check != $login_session) {
        header("location:index.php");
        die();
    }
} else {
    header("location:index.php");
    die();
}
