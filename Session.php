<?php

include 'admin/db_connect.php';
session_start();

$user_check = $_SESSION['email'];

$ses_sql = mysqli_query($connection, "select email from users where email = '$user_check' ");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['email'];

if (!isset ($_SESSION['email'])) {
    header("location:index.php");
    die();
}