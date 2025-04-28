<?php
include("../db/dbconnect.php");

// Check for database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch 3 popular rooms
$sqlRoom = "SELECT * FROM tblrooms LIMIT 3"; 
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
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
        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="./rooms.php">Rooms</a></li>
        <li class="nav-item active"><a class="nav-link" href="./aboutUs.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="./services.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="./contactUs.php">Contact Us</a></li>
      </ul>

      <form class="form-inline my-2 my-lg-0" action="./search.php" method="GET">
        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search">
        <button class="btn btn-success my-2 my-sm-0 mr-2" type="submit">Search</button>
      </form>

      <div class="auth-bg">
        <a href="../user/login.php"><button class="btn btn-dark">Login</button></a>
        <a href="../user/userRegistration.php"><button class="btn btn-dark">Registration</button></a>
      </div>
    </div>
  </nav>
</section>

<!-- ========== About Us Section ========== -->
<section id="aboutSection" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="../assets/image/villa.jpg" alt="Serenity Villa" class="img-fluidd">
      </div>
      <div class="col-md-6">
        <h2 class="mb-4">Welcome to <span class="text-color-about">Serenity Villa</span></h2>
        <p class="lead">Your perfect getaway to relaxation, comfort, and unforgettable memories.</p>
        <p>Founded in 2025, Serenity blends nature’s calmness with luxurious hospitality. Every space is crafted to feel like home while enjoying beautiful surroundings and premium services.</p>
        <ul class="list-unstyled mt-4">
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Stylish and spacious rooms</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Friendly and professional service</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Close to top attractions and nature</li>
          <li class="mb-2"><i class="fa-solid fa-check text-list-icon mr-2"></i> Affordable luxury for all travelers</li>
        </ul>
        <a href="./rooms.php" class="btn btn-primary mt-3">Explore Our Rooms</a>
      </div>
    </div>

    <!-- Popular Rooms Section -->
    <div class="row mt-5">
      <div class="col-12 text-center mb-4">
        <h3>Popular Rooms</h3>
      </div>

      <?php if ($resultRoom->num_rows > 0): ?>
        <?php while($room = $resultRoom->fetch_assoc()): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <img src="../admin/itemimages/<?php echo htmlspecialchars($room['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($room['image_path']); ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($room['category']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars(substr($room['description'], 0, 100)) . '...'; ?></p>
                <a href="./rooms.php" class="btn btn-sm btn-primary">View More</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p>No rooms available at the moment.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- Features Icons -->
    <div class="row mt-5 text-center">
      <div class="col-md-3 mb-4">
        <i class="fa-solid fa-bed fa-3x text-icon mb-2"></i>
        <h5>Comfortable Rooms</h5>
        <p class="text-muted-color small">Designed for ultimate relaxation and luxury.</p>
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
        <p class="text-muted-color small">Always here to serve you better.</p>
      </div>
    </div>
  </div>
</section>

<!-- ========== Footer ========== -->
<footer id="footer" class="spacing text-center">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302" title="LinkedIn"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees" title="GitHub"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/" title="Instagram"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com" title="Email"><i class="fa-solid fa-envelope icon-footer"></i></a>

  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/app.js"></script>

</body>
</html>
