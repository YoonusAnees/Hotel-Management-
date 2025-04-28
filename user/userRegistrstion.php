<?php
include('../db/dbconnect.php');
if (isset($_POST["submit"])) {

    // Get form data
    $full_name = $_POST["Full_Name"];
    $Email = $_POST["email"];
    $Password = $_POST["Password"];
    $Nationality = $_POST["Nationality"];
    $Phone_No = $_POST["phone_no"];

    $checkEmailQuery = "SELECT * FROM `user` WHERE `email` = '$Email'";
    $result = mysqli_query($connection, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists
        $error_message = "Email already added. Please use a different email.";
    } else {
        // Insert new user
        $sql = "INSERT INTO `user`(`Full_Name`, `email`, `Password`, `Nationality`, `phone_no`) 
                VALUES ('$full_name','$Email','$Password','$Nationality','$Phone_No')";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            // Redirect to login page on success
            header("Location: login.php");
        } else {
            echo "Failed to insert data";
            die(mysqli_error($connection));
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../assets/logo/s-solid.svg">
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>serenity</title>
  </head>
  <body class="bg-body">
<header>
<nav class="navbar navbar-expand-lg navbar-light  nav-bg-color">
  <a class="navbar-brand" href="../index.php">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../componets/aboutUs.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../componets/services.php">Services</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../componets/contactUs.php">Contact Us</a>
      </li>
    </ul>

    <div class="auth">
      <a href="./login.php"><button type="button" class="btn btn-dark">Login</button></a>
      <a href=""><button type="button" class="btn btn-dark">Registration</button></a>
    </div>
  </div>
</nav>
</header>
<section class="registrationSection py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="text-center mb-4">User Registration</h3>

            <?php
            // Display SweetAlert message if email exists
            if (isset($error_message)) {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: '$error_message',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                </script>";
            }
            ?>

            <form action="" method="post">
              <div class="form-group">
                <label for="Full_Name" class="font-weight-bold">Full Name</label>
                <input type="text" class="form-control" id="Full_Name" name="Full_Name" placeholder="Enter your full name" required>
              </div>

              <div class="form-group">
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>

              <div class="form-group">
                <label for="Password" class="font-weight-bold">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Create a password" required>
              </div>

              <div class="form-group">
                <label for="phone" class="font-weight-bold">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone_no" placeholder="Enter your phone number" required>
              </div>

              <div class="form-group">
                <label class="font-weight-bold d-block">Nationality</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Nationality" value="Local" id="radioLocal" checked>
                  <label class="form-check-label" for="radioLocal">Local</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Nationality" value="International" id="radioInternational">
                  <label class="form-check-label" for="radioInternational">International</label>
                </div>
              </div>

              <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer id="footer">
  <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
  <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
  <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
  <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
  <div class="footer-info mt-2">©2025 Developed and Designed by Yoonus Anees</div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
