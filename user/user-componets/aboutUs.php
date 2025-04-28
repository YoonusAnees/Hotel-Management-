<?php
include("../../db/dbconnect.php");
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../../assets/logo/s-solid.svg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Serenity Auth About Us</title>
</head>
<body class="bg-body">

<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
  <a class="navbar-brand" href="main.php">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../main.php">Home</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="./rooms.php">Rooms</a></li>
      <li class="nav-item active"><a class="nav-link" href="./aboutUs.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="./services.php">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="./contactUs.php">Contact Us</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="./search.php" method="GET">
      <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0 mr-2" type="submit">Search</button>
    </form>
    <div class="user-info">
      Welcome, <?php echo $_SESSION['Full_Name']; ?>!
      <div class="user-info-icon">
        <a href="../bookingInformation.php"><i class="user-info-icon-color fas fa-info-circle"></i></a>
      </div>
    </div>
    <div class="auth">
      <button class="btn btn-dark" id="logoutBtn">Log out</button>
    </div>
  </div>
</nav>
</section>





<section id="aboutSection" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="../../assets/image/villa.jpg" alt="Serenity Villa" class="img-fluidd">
      </div>
      <div class="col-md-6">
        <h2 class="mb-4">Welcome to <span class="text-color-about">Serenity Villa</span></h2>
        <p class="lead">Your perfect getaway to relaxation, comfort, and unforgettable memories.</p>
        <p>Founded in 2025, Serenity was created with a passion to blend nature's calmness with luxurious hospitality. Every space is crafted to make you feel at home while you enjoy beautiful surroundings and premium services.</p>
        <ul class="list-unstyled mt-4">
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Stylish and spacious rooms</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Friendly and professional service</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Close to top attractions and nature</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Affordable luxury for all travelers</li>
        </ul>
        <a href="./rooms.php" class="btn btn-primary mt-3">Explore Our Rooms</a>
      </div>
    </div>

    <div class="row mt-5 text-center">
      <div class="col-md-3 mb-4">
        <i class="fa-solid fa-bed fa-3x text-icon mb-2"></i>
        <h5>Comfortable Rooms</h5>
        <p class="text-muted-color small ">Designed for ultimate relaxation and luxury.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="fa-solid fa-swimming-pool fa-3x text-icon mb-2"></i>
        <h5>Outdoor Pool</h5>
        <p class="text-muted-color small">Dive into relaxation and sunshine.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="fa-solid fa-wifi fa-3x text-icon mb-2"></i>
        <h5>Free Wi-Fi</h5>
        <p class="text-muted-color small">Stay connected during your stay.</p>
      </div>
      <div class="col-md-3 mb-4">
        <i class="fa-solid fa-concierge-bell fa-3x text-icon mb-2"></i>
        <h5>24/7 Service</h5>
        <p class="text-muted-color small">Always here to help and serve you better.</p>
      </div>
    </div>
  </div>
</section>


<footer id="footer" class="spacing text-center ">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
