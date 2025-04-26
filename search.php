<?php
include("./db/dbconnect.php");

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
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
        <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#roomSection">Rooms</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
      </ul>
      <div class="auth ml-2">
        <a href="./user/login.php" class="btn btn-dark">Login</a>
        <a href="./user/userRegistrstion.php" class="btn btn-dark">Registration</a>
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
            <img src="./admin/itemimages/<?php echo htmlspecialchars($room['image_path']); ?>" class="card-img-top" alt="Room Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($room["name"]); ?></h5>
              <p class="card-text">Category: <?php echo htmlspecialchars($room["category"]); ?></p>
              <p class="card-text">Price: LKR <?php echo number_format($room["price_per_night"], 2); ?></p>
              <p class="card-text">Capacity: <?php echo htmlspecialchars($room["capacity"]); ?></p>
              <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                <a href="./user/login.php"><button type="button" class="btn btn-primary">Book Now</button></a>
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
<footer id="footer" class="text-center " >
  <div>
    <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin mx-2"></i></a>
    <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github mx-2"></i></a>
    <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram mx-2"></i></a>
    <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope mx-2"></i></a>
  </div>
  <div class="footer-info mt-2">
    ©2025 Developed and Designed by Yoonus Anees
  </div>
</footer>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="./assets/js/app.js"></script>
</body>
</html>
