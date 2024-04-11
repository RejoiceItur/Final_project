<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .home-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <a href="./index.php" class="home-icon"><i class="fas fa-home"></i></a>
    <div class="container">
        <h2>Add Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="product_name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <textarea class="form-control" name="location"></textarea>
            </div>
            <div class="mb-3">
                <label for="mobile_no" class="form-label">Contact details</label>
                <input type="text" class="form-control" name="mobile_no">
            </div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" multiple accept="image/*" required>
            <br>
            <br>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Add product</button>
            </div>
        </form>
    </div>


    <?php
    // Database connection parameters
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'final_proj';

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $seller_contact = $_POST['mobile_no'];
        $location = $_POST['location'];

        // Handle image upload
        $image_path = './assets/products/'; // Specify the directory where you want to store images
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = $image_path . $image_name;

        move_uploaded_file($image_tmp, $image_path);

        // Insert data into the database
        $sql = "INSERT INTO items (seller_name,name, price, description, image_path, seller_contact, location) VALUES ('$name', '$product_name', $price, '$description', '$image_path', '$seller_contact', '$location')";

        if ($conn->query($sql) === TRUE) {

            // Get the ID of the last inserted record
            $last_id = $conn->insert_id;

            // Insert a record into 'products_added' table for the added product
            $date_added = date("Y-m-d H:i:s");
            $sql = "INSERT INTO products_added (product_id, product_name,price, date_added) VALUES ($last_id, '$product_name',$price, '$date_added')";
            $conn->query($sql);


            
            echo "Product added successfully! Product ID: " . $last_id;
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>

   
</body>

</html>
