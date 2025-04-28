<?php
include("../db/dbconnect.php");

// Check for database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch product data
$sqlRoom = "SELECT * FROM tblrooms";
$resultRoom = $connection->query($sqlRoom);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../assets/logo/s-solid.svg">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Serenity</title>
  </head>
  <body class="bg-body">

<!-- ========== Navbar Section ========== -->
<section id="navbar">
  <nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
    <a class="navbar-brand" href="#">Serenity</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link" href="#homeSection">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./aboutUs.php">About Us</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contactUs.php">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="./search.php" method="GET">
  <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
  <button class="btn btn-success my-2 my-sm-0 mr-2" type="submit">Search</button>
     </form>

      <div class="auth-bg">
        <a href="../user/login.php"><button type="button" class="btn btn-dark">Login</button></a>
        <a href="../user/userRegistrstion.php"><button type="button" class="btn btn-dark">Registration</button></a>
      </div>
    </div>
  </nav>
</section>

<div class="servives">
  <!-- ========== Services Section ========== -->
<section class="container my-5" id="servicesSection">
  <h2 class="text-center mb-5">Our Services</h2>

  <div class="row text-center">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-bed fa-3x icon-services mb-3 "></i>
          <h5 class="card-title">Luxury Accommodation</h5>
          <p class="card-text">Spacious and stylish rooms designed to offer maximum comfort during your stay.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-utensils fa-3x icon-services mb-3"></i>
          <h5 class="card-title">Fine Dining</h5>
          <p class="card-text">Enjoy delicious local and international cuisine prepared by top chefs.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-spa fa-3x icon-services mb-3"></i>
          <h5 class="card-title">Spa & Wellness</h5>
          <p class="card-text">Relax with our exclusive spa treatments, massages, and wellness therapies.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-swimming-pool fa-3x icon-services mb-3"></i>
          <h5 class="card-title">Outdoor Swimming Pool</h5>
          <p class="card-text">Take a refreshing dip in our clean and well-maintained outdoor pool area.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-shuttle-van fa-3x icon-services mb-3"></i>
          <h5 class="card-title">Airport Transfers</h5>
          <p class="card-text">Hassle-free transportation to and from the airport available on request.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <i class="fa-solid fa-mountain-sun fa-3x icon-services mb-3"></i>
          <h5 class="card-title">Tour Packages</h5>
          <p class="card-text">Explore Sri Lanka's beautiful sights with our customized tour packages.</p>
        </div>
      </div>
    </div>
  </div>
</section>

</div>


<!-- ========== Footer ========== -->
<footer id="footer" class="spacing text-center" style="margin-top: 115px;">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
  crossorigin="anonymous"></script>
<script src="../assets/js/app.js"></script>
</body>
</html>
