<?php
include ("../db/dbconnect.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
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

    // Get room details: price and capacity
    $roomQuery = "SELECT price_per_night, capacity FROM tblrooms WHERE id = '$room_id'";
    $roomResult = mysqli_query($connection, $roomQuery);

    if (!$roomResult || mysqli_num_rows($roomResult) == 0) {
        die("Invalid room selection.");
    }

    $room = mysqli_fetch_assoc($roomResult);
    $price_per_night = $room['price_per_night'];
    $capacity = $room['capacity'];

    // Check guest count against capacity
    if ($guests > $capacity) {
        echo "<script>alert('The selected room can only accommodate up to $capacity guests.'); window.history.back();</script>";
        exit;
    }

    // Check if the room is already booked for overlapping dates
    $conflictQuery = "
        SELECT * FROM tblbookings
        WHERE room_id = '$room_id' 
        AND status = 'Activated'
        AND (
            ('$check_in' BETWEEN check_in AND DATE_SUB(check_out, INTERVAL 1 DAY)) OR
            ('$check_out' BETWEEN DATE_ADD(check_in, INTERVAL 1 DAY) AND check_out) OR
            (check_in BETWEEN '$check_in' AND '$check_out') OR
            (check_out BETWEEN '$check_in' AND '$check_out')
        )
    ";
    $conflictResult = mysqli_query($connection, $conflictQuery);

    if (mysqli_num_rows($conflictResult) > 0) {
        echo "<script>alert('Sorry, this room is already booked for the selected dates.'); window.history.back();</script>";
        exit;
    }

    // Calculate total amount
    $days = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
    if ($days <= 0) {
        echo "<script>alert('Invalid check-in/check-out dates.'); window.history.back();</script>";
        exit;
    }

    $total_amount = $days * $price_per_night;
    $status = 'Activated';

    // Insert booking
    $sql = "INSERT INTO tblbookings (user_id, room_id, full_name, email, check_in, check_out, guests, special_requests, total_amount, status) 
            VALUES ('$user_id', '$room_id', '$full_name', '$email', '$check_in', '$check_out', '$guests', '$special_requests', '$total_amount', '$status')";

    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Booking successful!'); window.location.href='bookingInformation.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Fetch all room details
$roomDetailResult = mysqli_query($connection, "SELECT id, category, name, capacity FROM tblrooms");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/logo/s-solid.svg">

    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Serenity - Book Room</title>
  </head>
  <body class="bg-body">

<!-- Navbar -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
  <a class="navbar-brand" href="./main.php">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="nav-link" href="./main.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="./user-componets/aboutUs.php">About Us</a></li>
      <li class="nav-item"><a class="nav-link" href="./user-componets/services.php">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="./user-componets/contactUs.php">Contact Us</a></li>
    </ul>
    <form class="form-inline my-2 my-lg-0 mr-3" action="./user-componets/search.php" method="GET">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <div class="user-info">Hello, <?php echo $_SESSION['Full_Name']; ?>!</div>
    <div class="auth"><a href="../logout.php"><button class="btn btn-dark">Log out</button></a></div>
  </div>
</nav>
</section>

<!-- Booking Form -->
<section class="container my-4">
  <h3>Book a Room</h3>
  <form action="" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">

    <div class="form-group">
      <label>Room Type</label>
      <select name="room_id" id="room_id" class="form-control" required onchange="updateCapacity()">
        <?php while ($row = $roomDetailResult->fetch_assoc()) { ?>
          <option value="<?php echo $row['id']; ?>" data-capacity="<?php echo $row['capacity']; ?>">
            <?php echo $row['category'] . ' - ' . $row['name'] . ' (Max: ' . $row['capacity'] . ' guests)'; ?>
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
      <label>Guests <span id="capacity_info" class="text-muted"></span></label>
      <input type="number" name="guests" id="guests" class="form-control" min="1" required>
    </div>

    <div class="form-group">
      <label>Special Requests</label>
      <textarea name="special_requests" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Book Now</button>
  </form>
</section>

<footer id="footer" style="margin-top:41px;">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<!-- JS Scripts -->
<script src="../../assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>




</body>
</html>
