<?php
session_start();  

include("../db/dbconnect.php");

$error = "";
$success = "";  

if (isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = $_POST['Password'];

    if (empty($Email) || empty($Password)) {
        $error = "Please fill in all fields.";
    } else {
        $userQuery = "SELECT * FROM user WHERE email='$Email' AND Password='$Password'";
        $userResult = mysqli_query($connection, $userQuery);

        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $userRow = mysqli_fetch_assoc($userResult);

            $_SESSION['email'] = $userRow['email'];
            $_SESSION['Full_Name'] = $userRow['Full_Name'];
            $_SESSION['id'] = $userRow['id'];

            // Set success message in session
            $_SESSION['success'] = "Login successful! Welcome , " . $userRow['Full_Name'] . ".";

            // Redirect to main.php after displaying success message
            header("Location: login.php");
            exit();  // Ensure the script stops here
        } else {
            $error = "Invalid email or password.";
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

    <!-- SweetAlert2 and app.js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/0e824faa16.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Serenity</title>

    <style>
      .user-registration-login{
    color: #000;
    text-align: center;
    margin-top: 15px;
}

.user-registration-login a {
    color: #0b132b;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
}

.user-registration-login a:hover {
    color: #333; /* Bootstrap primary color */
    text-decoration: underline;
}
    </style>
</head>
<body class="bg-body">
<header>
<?php if (!empty($error)): ?>
<script>
  Swal.fire({
    title: 'Error!',
    text: '<?php echo $error; ?>',
    icon: 'error'
  });
</script>
<?php endif; ?>


<?php if (isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $_SESSION['success']; ?>',
                icon: 'success'
            }).then(function() {
                window.location.href = "main.php";  // Redirect to main.php after showing the success message
            });
        </script>
        <?php unset($_SESSION['success']); ?>  <!-- Clear success message after display -->
    <?php endif; ?>



    <nav class="navbar navbar-expand-lg navbar-light nav-bg-color">
        <a class="navbar-brand" href="../index.php">Serenity</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
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
                <a href="./login.php"><button type="button" class="btn btn-dark" id="login-button">Login</button></a>
                <a href="./userRegistrstion.php"><button type="button" class="btn btn-dark">Registration</button></a>
            </div>
        </div>
    </nav>
</header>

<section class="loginSection py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">User Login</h3>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>

                            <!-- <div class="form-group">
                                <label for="Password" class="font-weight-bold">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your password" required>
                            </div> -->
                            <div class="form-group">
                          <label for="Password" class="font-weight-bold">Password</label>
                           <div class="input-group">
                           <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your password" required>
                        <div class="input-group-append">
                           <span class="input-group-text" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                           <i class="fa fa-eye" id="togglePasswordIcon"></i>
                           </span>
                                      </div>
                                  </div>
                               </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Login</button>
                           
                        </form>

                        <div class="user-registration-login">
                                <a href="userRegistrstion.php" class="text-center mt-3">Havent Account?</a>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="footer" style="margin-top: 235px;">
    <a href="https://lk.linkedin.com/in/yoonus-anees-59b7b2302"><i class="fa-brands fa-linkedin icon-footer"></i></a>
    <a href="https://github.com/YoonusAnees"><i class="fa-brands fa-github icon-footer"></i></a>
    <a href="https://www.instagram.com/yoonus_anees/"><i class="fa-brands fa-instagram icon-footer"></i></a>
    <a href="mailto:yoonusanees2002@gmail.com"><i class="fa-solid fa-envelope icon-footer"></i></a>
    <div class="footer-info mt-2">
        ©2025 Developed and Designed by Yoonus Anees
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
      function togglePasswordVisibility() {
    const passwordInput = document.getElementById('Password');
    const toggleIcon = document.getElementById('togglePasswordIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  }
</script>
<script src="../assets/js/app.js"></script>
</body>
</html>
