<?php include("../db/dbconnect.php");

// Check for database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $rating = intval($_POST['rating']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    // Insert into database
    $sql = "INSERT INTO tblreviews (full_name, email, phone, rating, message) 
            VALUES ('$full_name', '$email', '$phone', '$rating', '$message')";

    if (mysqli_query($connection, $sql)) {
      echo "<script>
      Swal.fire({
          title: 'Thank you!',
          text: 'Thank you for your valuable review!',
          icon: 'success',
          confirmButtonText: 'OK'
      
      });
  </script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <a class="navbar-brand" href="../index.php">Serenity</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./rooms.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./aboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./services.php">Services</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./contactUs.php">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="./componets/search.php" method="GET">
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



<!-- Contact Us Section -->
<section class="container my-5 ">
  
  <div class="row">
    <div class="col-md-6 mb-5" >
      <div class="title-contactUs">Further Details We are here get in Touch</div>
     <div class="title-contactUslist">
     <p><a href="https://www.google.com/maps/place/Akurana,+%5Bno+name%5D/data=!4m2!3m1!1s0x3ae34324f9293dfd:0x8125a2e59ddf4476?sa=X&ved=1t:242&ictx=111"><i class="fa-solid fa-location-dot mr-2 title-contactUs-icon"></i></a> Serenity Villa, Akurana, Sri Lanka</p>
      <p><a href="tel:+94761310771"><a><i class="fa-solid fa-phone mr-2 title-contactUs-icon"></a></i> +94 76 131 0771</p>
      <p><a href="mailto:"><i class="fa-solid fa-envelope mr-2 title-contactUs-icon"></i></a> serenityvilla@gmail.com</p>
     </div>

      <h5 class="mt-4">Business Hours</h5>
      <p>Monday - Sunday: 8 AM to 8 PM</p>


         <!-- Review Section -->

 
  <div class="review" id="reviewSection">
    <h2 class="text-center text-color">Leave a Review</h2>
  <form action="" method="POST" class="p-4">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fullName">Full Name</label>
      <input type="text" name="full_name" class="form-control" id="fullName" placeholder="Enter your full name" required>
    </div>

    <div class="form-group col-md-6">
      <label for="emailAddress">Email Address</label>
      <input type="email" name="email" class="form-control" id="emailAddress" placeholder="Enter your email" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="phoneNumber">Phone Number</label>
      <input type="text" name="phone" class="form-control" id="phoneNumber" placeholder="Enter your phone number" required>
    </div>

    <div class="form-group col-md-6">
      <label for="rating">Rating</label>
      <select name="rating" class="form-control" id="rating" required>
        <option value="">Select a rating</option>
        <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
        <option value="4">⭐⭐⭐⭐ - Good</option>
        <option value="3">⭐⭐⭐ - Average</option>
        <option value="2">⭐⭐ - Poor</option>
        <option value="1">⭐ - Very Poor</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="reviewMessage">Your Review</label>
    <textarea name="message" class="form-control" id="reviewMessage" rows="5" placeholder="Write your experience..." required></textarea>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Submit Review</button>
</form>
         </div>





    </div>

    <div class="col-md-6">
      <div style="width: 100%"><iframe class="map" width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
      src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=srilanka,kandy,Akurana/kurugoda+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
      <a href="https://www.gps.ie/collections/personal-trackers/">
      real-time gps tracker,</a></iframe>
      </div>
    </div>
  </div>
</section>

 




<!-- ========== Footer ========== -->
<footer id="footer" class="spacing text-center ">
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
