<?php
include('../db/dbconnect.php');
session_start();

// Fetch rooms for dropdown (outside POST block)
$roomQuery = "SELECT id, name, category FROM tblrooms WHERE status != 'Booked'";
$resultRoom = mysqli_query($connection, $roomQuery);   
if (!$resultRoom) {
    die("Room query failed: " . mysqli_error($connection));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $guests = $_POST['guests'];
    $special_requests = mysqli_real_escape_string($connection, $_POST['special_requests']);

    $full_name = $_SESSION['Full_Name'];
    $email = $_SESSION['email'];

    // Get room price
    $priceQuery = "SELECT price_per_night FROM tblrooms WHERE id=$room_id";
    $priceResult = mysqli_query($connection, $priceQuery);
    if (!$priceResult || mysqli_num_rows($priceResult) == 0) {
        die("Invalid room selection.");
    }

    $priceRow = mysqli_fetch_assoc($priceResult);
    $price_per_night = $priceRow['price_per_night'];

    // Calculate total amount
    $days = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    if ($days <= 0) {
        echo "<script>alert('Invalid check-in/check-out dates.'); window.history.back();</script>";
        exit;
    }
    $total_amount = $days * $price_per_night;
    $status = 'Activated';

    // Insert booking without phone
    $sql = "INSERT INTO tblbookings (user_id, room_id, full_name, email, check_in, check_out, guests, special_requests, total_amount, status) 
            VALUES ('$user_id', '$room_id', '$full_name', '$email', '$check_in', '$check_out', '$guests', '$special_requests', '$total_amount', '$status')";

    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Booking successful!'); window.location.href='bookingInformation.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Serenity - Book Room</title>
  </head>
  <body class="bg-body">

<!-- Navbar -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
  <a class="navbar-brand" href="#">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="nav-link" href="#homeSection">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#roomSections">Rooms</a></li>
      <li class="nav-item"><a class="nav-link" href="#aboutUs">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0 mr-3">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <div class="user-info">Hello, <?php echo $_SESSION['Full_Name']; ?>!</div>
    <div class="auth"><a href="../logout.php"><button class="btn btn-dark">Log out</button></a></div>
  </div>
</nav>
</section>

<!-- Booking Form -->
<section class="container my-5">
  <h3>Book a Room</h3>
  <form action="" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
    <div class="form-group">
      <label>Room Type</label>
      <select name="room_id" class="form-control" required>
        <?php while ($row = $resultRoom->fetch_assoc()) { ?>
          <option value="<?php echo $row['id']; ?>">
            <?php echo $row['category'] . ' - ' . $row['name']; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label>Check-in Date</label>
      <input type="date" name="check_in" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Check-out Date</label>
      <input type="date" name="check_out" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Guests</label>
      <input type="number" name="guests" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Special Requests</label>
      <textarea name="special_requests" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Book Now</button>
  </form>
</section>

<!-- Footer -->
<footer id="footer" class="spacing text-center">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope"></i></a>
  <div class="footer-info mt-2">©2025 Developed and Designed by Yoonus Anees</div>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
