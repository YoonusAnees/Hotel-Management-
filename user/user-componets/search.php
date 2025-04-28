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

$rooms = [];
$query = '';

if (isset($_GET['query'])) {
    $query = trim($_GET['query']);
    $search_term = "%" . $query . "%";

    $stmt = $connection->prepare("SELECT * FROM tblrooms WHERE name LIKE ? OR category LIKE ?");
    $stmt->bind_param("ss", $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
    $rooms = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="icon" type="image/x-icon" href="../../assets/logo/s-solid.svg">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <title>Serenity</title>
</head>
<body class="bg-body">

<!-- ========== Navbar Section ========== -->
<section id="navbar">
<nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
  <a class="navbar-brand" href="main.php">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../main.php">Home</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="./rooms.php">Rooms</a></li>
      <li class="nav-item"><a class="nav-link" href="./aboutUs.php">About Us</a></li>
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

<section class="room-section container" id="roomSection">
  <h2 class="my-4">Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
  <div class="row">
    <?php if (!empty($rooms)): ?>
      <?php foreach ($rooms as $room): ?>
        <div class="col-12 col-md-6 col-lg-4 d-flex  mb-4">          
          <div class="card">
            <img src="../../admin/itemimages/<?php echo htmlspecialchars($room['image_path']); ?>" class="card-img-top" alt="Room Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($room["name"]); ?></h5>
              <p class="card-text">Category: <?php echo htmlspecialchars($room["category"]); ?></p>
              <p class="card-text">Price: LKR <?php echo number_format($room["price_per_night"], 2); ?></p>
              <p class="card-text">Capacity: <?php echo htmlspecialchars($room["capacity"]); ?></p>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                <a href="../booking.php"><button type="button" class="btn btn-primary">Book Now</button></a>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <p class="text-muted">No rooms found matching your search.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ========== Footer ========== -->
<!-- ========== Footer ========== -->
<footer id="footer" class="spacing text-center">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../assets/js/app.js"></script>
</body>
</html>
