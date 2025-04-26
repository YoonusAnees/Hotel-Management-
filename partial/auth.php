<?php
// auth.php
session_start();
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}
$email = $_SESSION['email'];
include('../db/dbconnect.php');

$userQuery = "SELECT * FROM user WHERE email='$email'";
$userResult = mysqli_query($connection, $userQuery);
if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);
    $_SESSION['Full_Name'] = $userRow['Full_Name'];
    $_SESSION['id'] = $userRow['id'];
} else {
    echo "User not found.";
    exit();
}



?>