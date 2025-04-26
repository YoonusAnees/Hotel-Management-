<?php
include("../db/dbconnect.php");
session_start();

if (isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = $_POST['Password'];

    if (empty($Email) || empty($Password)) {
        echo "Please fill in all fields.";
        exit(); 
    }

    $userQuery = "SELECT * FROM user WHERE email='$Email' AND Password='$Password'";
    $userResult = mysqli_query($connection, $userQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userRow = mysqli_fetch_assoc($userResult);

        // Set session variables
        $_SESSION['email'] = $userRow['email'];
        $_SESSION['Full_Name'] = $userRow['Full_Name'];
        $_SESSION['id'] = $userRow['id'];

        header("Location: main.php");
        exit();
    } else {
      echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Serenity</title>
  </head>
  <body>
  <header>
<nav class="navbar navbar-expand-lg navbar-light  nav-bg-color ">
  <a class="navbar-brand" href="#">Serenity</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item dropdown">
      <li class="nav-item">
        <a class="nav-link " href="#">Services</a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">Contact Us</a>
      </li>
    </ul>
   

    <div class="auth">
   <a href="./login.php"> <button type="button" class="btn btn-dark">Login</button></a>
   <a href="./userRegistrstion.php"> <button type="button" class="btn btn-dark">Registration</button></a>
    </div>
  </div>
</nav>
</header>

<section class="loginSection">
<div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>User Login </h2>
            <form action="" method="post">
                
               
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="text" class="form-control" id="Password" name="Password" required>
                </div>
               
                

                
                
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                
            </form>
        </div>
    </div>
</section>
<footer class="footer">
<ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
    </ul>

    <p class="text-center text-body-secondary">© 2025 Company, Inc</p>

</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>