<?php
session_start();

// Check if session is set
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

// Fetch user details from the database using the email stored in the session
$email = $_SESSION['email'];




// Get user info
$userQuery = "SELECT * FROM user WHERE email='$email'";
$userResult = mysqli_query($connection, $userQuery);
$sqlRoom = "SELECT * FROM tblrooms";
$resultRoom = $connection->query($sqlRoom);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userRow = mysqli_fetch_assoc($userResult);
    // Set session variables
    $_SESSION['Full_Name'] = $userRow['Full_Name'];
    $_SESSION['id'] = $userRow['id'];
} else {
    echo "User not found.";
    exit();
}
?>