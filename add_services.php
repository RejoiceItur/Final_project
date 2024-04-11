<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .home-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 24px;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .submit-btn {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<a href="index.php" class="home-icon"><i class="fas fa-home"></i></a>

<div class="container">
    <h2>Service Registration Form</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="service_name">Service Name:</label>
        <input type="text" id="service_name" name="service_name" required>

        <label for="tagline">Experience:</label>
        <input type="text" id="tagline" name="tagline" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" required>

        <label for="price">Visiting Charges:</label>
        <input type="text" id="price" name="price" required>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <div class="submit-btn">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>


<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'final_proj';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set parameters and execute
    $name = $_POST['name'];
    $service_name = $_POST['service_name'];
    $tagline = $_POST['tagline'];
    $location = $_POST['location'];
    $mobile_number = $_POST['mobile_number'];
    $price = $_POST['price'];

    $target_dir = './assets/services_img/';
    $image_name = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image_name);
    $image_tmp = $_FILES['image']['tmp_name'];

    // Move uploaded file to destination
    move_uploaded_file($image_tmp, $target_file);



    // Prepare the SQL statement
    $sql = "INSERT INTO services (name, service_name, tagline, location, mobile_no, price, image_path) VALUES ('$name', '$service_name', '$tagline', '$location', '$mobile_number', '$price', '$target_file')";
    // $stmt->bind_param("sssss", $name, $service_name, $tagline, $location, $mobile_number);

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("File upload failed with error code: " . $_FILES['image']['error']);
    } else {
        if ($conn->query($sql) === TRUE) {
            echo "<p>Data inserted successfully.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
    

    

    // Close the statement and connection
    $conn->close();
}
?>

</body>
</html>
