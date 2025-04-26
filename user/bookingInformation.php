<?php
include('../db/dbconnect.php');
session_start();

// Check if session is set
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}

// Fetch user details from the database using the email stored in the session
$email = $_SESSION['email'];
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
    // Handle error: User not found
    echo "User not found.";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>serenity</title>
  </head>
  <body  class="bg-body">
        <!--============================================== Navbar Section====================================================== -->

<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light  nav-bg-color">
  <a class="navbar-brand" href="#">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./main.php ">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <!-- <li class="nav-item">
        <a class="nav-link" href="#roomSections">Rooms</a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" href="./user-componets/aboutUs.php">About Us</a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link " href="#">Services</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link " href="./user-componets/contactUs.php">Contact Us</a>
      </li>
    </ul>
   

    <div class="user-info">
   
      Booking Infomations of , <?php echo $_SESSION['Full_Name']; ?>!
      
    </div>

    <div class="auth ">
    <a href="../logout.php"><button type="button" class="btn btn-dark">Log out</button></a>
    </div>
  </div>
</nav>
</section>


<!--============================================== Home Section====================================================== -->
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
      <img class="d-block w-100 " src="../assets/image/swimming-pool.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 " src="../assets/image/lobby-living-room-hotel.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 " src="../assets/image/swimming-pool-resort.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 " src="../assets/image/house-kitchen.jpg" alt="Forth slide">
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

<!-- ========== Info Section ========== -->

<!-- ========== Booking Info Section ========== -->
<section class="container my-5 ">
  <h3>Your Bookings</h3>
  <?php
    $user_id = $_SESSION['id'];
    $bookingQuery = "
        SELECT b.*, r.name AS room_name, r.category 
        FROM tblbookings b 
        JOIN tblrooms r ON b.room_id = r.id 
        WHERE b.user_id = '$user_id'
        ORDER BY b.check_in DESC
    ";
    $bookingResult = mysqli_query($connection, $bookingQuery);
  ?>

  <?php if (mysqli_num_rows($bookingResult) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Room</th>
            <th>Category</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Guests</th>
            <th>Special Requests</th>
            <th>Total Amount (LKR)</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($bookingResult)): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['room_name']); ?></td>
              <td><?php echo htmlspecialchars($row['category']); ?></td>
              <td><?php echo htmlspecialchars($row['check_in']); ?></td>
              <td><?php echo htmlspecialchars($row['check_out']); ?></td>
              <td><?php echo htmlspecialchars($row['guests']); ?></td>
              <td><?php echo htmlspecialchars($row['special_requests']); ?></td>
              <td><?php echo number_format($row['total_amount'], 2); ?></td>
              <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p>You have no bookings yet.</p>
  <?php endif; ?>
</section>



<footer id="footer" class="spacing text-center">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope"></i></a>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>