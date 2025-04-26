<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Debugging: Check if session is destroyed
echo "Session destroyed!";
header("Location: index.php");
exit();
?>
