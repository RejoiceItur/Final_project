<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <h1>Add Product</h1>
    <form action="demo1.php" method="post" enctype="multipart/form-data">
    <label for="product_name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        <br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <br>

        <button type="submit">Add Product</button>
    </form>

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

    // Handle image upload
    $image_path = './assets/products/'; // Specify the directory where you want to store images
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = $image_path . $image_name;

    move_uploaded_file($image_tmp, $image_path);

    // Insert data into the database
    $sql = "INSERT INTO items (seller_name,name, price, description, image_path) VALUES ('$name', '$product_name', $price, '$description', '$image_path')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
</body>

</html>