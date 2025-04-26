<?php
include("./db/dbconnect.php");

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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
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
        <li class="nav-item active">
          <a class="nav-link" href="#homeSection">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#roomSection">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div class="auth ml-2">
        <a href="./user/login.php"><button type="button" class="btn btn-dark">Login</button></a>
        <a href="./user/userRegistrstion.php"><button type="button" class="btn btn-dark">Registration</button></a>
      </div>
    </div>
  </nav>
</section>

<!-- ========== Home Section ========== -->
<section id="homeSection">
  <div class="her">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="./assets/image/swimming-pool.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./assets/image/lobby-living-room-hotel.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./assets/image/swimming-pool-resort.jpg" alt="Third slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./assets/image/house-kitchen.jpg" alt="Fourth slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</section>



<!-- ========== Room Section ========== -->

<section class="room-section container" id="roomSection">
    <div class="row">
        <?php if ($resultRoom && mysqli_num_rows($resultRoom) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultRoom)): ?>
                <div class="col-12 col-md-6 col-lg-4 d-flex  mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="./admin/itemimages/<?php echo htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["name"]); ?></h5>
                            <p class="card-text">
                                Room Type: <?php echo htmlspecialchars($row["category"]); ?><br>
                                Price: LKR <?php echo htmlspecialchars(number_format($row["price_per_night"], 2)); ?><br>
                                Available: <?php echo htmlspecialchars($row["capacity"]); ?><br>
                                Status: <?php echo htmlspecialchars($row["status"]); ?>
                            </p>
                            <a href="./user/login.php" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No Rooms found.</p>
        <?php endif; ?>
    </div>
</section>


<!-- ========== Footer ========== -->
<footer id="footer" class="spacing text-center">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope"></i></a>
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
<script src="./assets/js/app.js"></script>
</body>
</html>
