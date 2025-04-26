<?php
include("../db/dbconnect.php");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $Room_Name = $_POST['name'];
    $Room_catagory = $_POST['category']; // fixed: 'type' ➡ 'category'
    $Description = $_POST['description'];
    $Price = $_POST['price_per_night'];
    $Capacity = $_POST['capacity'];
    $Status = $_POST['status'];

    $fileName = $_FILES["filetoUpload"]["name"];
    $tempfilename = $_FILES["filetoUpload"]["tmp_name"];
    $target_dir = "itemimages/";
    $target_file = $target_dir . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Create folder if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check image file
    if ($tempfilename) {
        $check = getimagesize($tempfilename);
        $uploadOk = $check !== false ? 1 : 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "File already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filetoUpload"]["size"] > 10000000) {
        echo "File too large.<br>";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Invalid file type.<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && move_uploaded_file($tempfilename, $target_file)) {
        $sql = "INSERT INTO tblrooms (name, category, description, price_per_night, capacity, status, image_path) 
                VALUES ('$Room_Name', '$Room_catagory', '$Description', '$Price', '$Capacity', '$Status', '$fileName')";

        try {
            if (mysqli_query($connection, $sql)) {
                header("location:showRooms.php");
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } catch (Exception $e) {
            echo "Message: " . $e->getMessage();
        }
    } else {
        echo "File upload failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddBooks</title>
    <style>
   * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Header Styling */
        header {
            width: 100%;
            max-width: 1200px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        header h1 {
            font-size: 2rem;
            color: #ff4b2b;
        }

        /* Navigation Bar Styling */
        nav {
            width: 100%;
            max-width: 1200px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-radius: 5px;
            margin-bottom: 10px;
            color: #fff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff4b2b;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin: 0 1rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ff4b2b;
        }

        .cta {
            background: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .cta:hover {
            background: #e6392f;
        }

        /* Upload Container Styling */
        #upload_container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #upload_container h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        #upload_container input[type="text"],
        #upload_container input[type="number"],
        #upload_container select {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.2rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
        }

        #upload_container input[type="text"]:focus,
        #upload_container input[type="number"]:focus,
        #upload_container select:focus {
            border-color: #ff4b2b;
        }

        #choose {
            padding: 0.8rem 1.2rem;
            border-radius: 8px;
            background: #ff4b2b;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            margin-bottom: 1.2rem;
        }

        #choose:hover {
            background: #e6392f;
            transform: translateY(-2px);
        }

        input[type="submit"] {
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            border: none;
            background: #333;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover {
            background: #555;
            transform: translateY(-2px);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 1rem;
                padding: 1rem 0;
            }

            #upload_container {
                padding: 2rem 1rem;
                width: 90%;
            }

            .logo, .nav-links a, .cta {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">Seranity</div>
            <ul class="nav-links">
                <!-- <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li> -->
                <!-- <li><a href="#">Products</a></li> -->
                <!-- <li><a href="#">Contact</a></li> -->
            </ul>
            <a href="admindashboard.php" class="cta">Back To Admin Panel</a>
        </nav>
    </header>

    <!-- Product Upload Section -->
    <section id="upload_container">
        <h2>Upload Rooms</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" id="name" placeholder="Room Name" required>
            <select name="category" id="category" required>
                <option value="">Select The Room</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
                <option value="Double">Double</option>
                <option value="Standard">Standard</option>
            </select>
            <input type="text" name="description" id="description" placeholder="description" required>
            <input type="text" name="price_per_night" id="price_per_night" placeholder="price_per_night" required>
            <input type="text" name="capacity" id="capacity" placeholder="capacity" required>
          
            <select name="status" id="status" required>
                <option value="">Availability</option>
                <option value="Available">Available</option>
                <option value="Booked">Booked</option>
              
            </select>

            

            <input type="file" name="filetoUpload" id="imageUpload" required hidden>
            <button type="button" id="choose" onclick="upload()">Choose Image</button>
            <input type="submit" value="Upload" name="submit">
        </form>
    </section>

    <script>
        var roomname = document.getElementById("name");
        var choose = document.getElementById("choose");
        var uploadImage = document.getElementById("imageUpload");

        function upload() {
            uploadImage.click();
        }

        uploadImage.addEventListener("change", function() {
            var file = this.files[0];
            if (roomname.value == "") {
                roomname.value = file.name;
            }
            choose.innerHTML = "Selected: " + file.name;
        });
    </script>

</body>
</html>


