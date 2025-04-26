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
     
        $error_message = "Email already added. Please use a different email.";
    } else {
     
        $sql = "INSERT INTO `user`(`Full_Name`, `email`, `Password`, `Nationality`, `phone_no`) 
                VALUES ('$full_name','$Email','$Password','$Nationality','$Phone_No')";
        $result = mysqli_query($connection, $sql);

        if ($result) {
          
            header("Location:login.php");
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>serenity</title>
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
    <a href="./login.php"><button type="button" class="btn btn-dark">Login</button></a>
    <a href=""> <button type="button" class="btn btn-dark">Registration</button></a>
    </div>
  </div>
</nav>
</header>
<section class="registrationSection">
<div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Registration </h2>

            <?php
            // Display error message if email exists
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>$error_message</div>";
            }
            ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="Full_Name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="Full_Name" name="Full_Name" required>
                </div>
               
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="text" class="form-control" id="Password" name="Password" required>
                </div>
               
                <div class="mb-3">
                <label for="phone" class="form-label">Phone_Number</label>
                <input type="text" class="form-control" id="phone" name="phone_no" required>
                </div>

                <div class="mb-3">
                <div class="form-check">

                <input class="form-check-input" type="radio" name="Nationality" value="Local" id="radioDefault1" checked>
                <label class="form-check-label" for="radioDefault1">
                      Local
                  </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="Nationality" value="International" id="radioDefault2" >
                 <label class="form-check-label" for="radioDefault2">
                      International
                 </label>
                </div>

                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Registrarse</button>
                
            </form>
        </div>
    </div>
</section>
<footer>

</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

