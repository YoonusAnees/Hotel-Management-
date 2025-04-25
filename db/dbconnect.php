<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "hotelmanagemnet"; // typo? should be 'hotelmanagement'
$connection = mysqli_connect($serverName, $username, $password, $dbName);

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    // echo "Connected successfully";
}


?>