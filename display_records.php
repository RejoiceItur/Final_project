<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>

body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
}

.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('background-image.jpg');
    background-size: cover;
    background-position: center;
    z-index: -1;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
}

.container {
    position: relative;
    z-index: 1;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    color: #fff;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.data-section {
    margin-bottom: 40px;
}

.table-container {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 10px;
    color: #fff;
}

th {
    background-color: rgba(255, 255, 255, 0.1);
}

.total-count {
    margin-top: 10px;
    text-align: right;
}

.download-btn {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.download-btn:hover {
    background-color: #0056b3;
}

footer {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
}
</style>
</head>
<body>

<div class="background">
    <div class="overlay"></div>
</div>

<div class="container">
    <header>
        <h1>Welcome to the Admin Dashboard</h1>
    </header>

    <section class="data-section">



<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'final_proj';

// Include PHPExcel library
require 'PHPExcel/Classes/PHPExcel.php';

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();



// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display table data
function displayTableData($conn, $tableName) {
    // Retrieve data from the table
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        echo "<div class='table-container'>";
        // Display table header
        echo "<h2>New Users Data</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Date added</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["date_added"] . "</td></tr>";
        }
        echo "</table>";
        echo "<div class='total-count'>Total Records: " . $result->num_rows . "</div>";
        echo "<a href='new_user_data.php'><button>Download Data</button></a>";
        echo "</div>";

        
        
    } else {
        echo "<div class='table-container'>";
        echo "No data found in $tableName table.";
        echo "</div>";
    }
}






function displayTableData1($conn, $tableName) {
    // Retrieve data from the table
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        echo "<div class='table-container'>";
        // Display table header
        echo "<h2>New products added Data</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Product name</th><th>Price</th><th>Date added</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["product_name"] . "</td><td>" . $row["price"] . "</td><td>" . $row["date_added"] . "</td></tr>";
        }
        echo "</table>";
        echo "<div class='total-count'>Total Records: " . $result->num_rows . "</div>";
        echo "<a href='products_added_data.php'><button>Download Data</button></a>";
        echo "</div>";

        
    } else {
        echo "<div class='table-container'>";
        echo "No data found in $tableName table.";
        echo "</div>";
    }
}


function displayTableData2($conn, $tableName) {
    // Retrieve data from the table
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        echo "<div class='table-container'>";
        // Display table header
        echo "<h2>Data of products which are deleted</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Product name</th><th>Seller name</th><th>Date deleted</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["product_name"] . "</td><td>" . $row["seller_name"] . "</td><td>" . $row["date_deleted"] . "</td></tr>";
        }
        echo "</table>";
        echo "<div class='total-count'>Total Records: " . $result->num_rows . "</div>";
        echo "<a href='products_deleted_data.php'><button>Download Data</button></a>";
        echo "</div>";

        

    } else {
        echo "<div class='table-container'>";
        echo "No data found in $tableName table.";
        echo "</div>";
    }
}


function displayTableData3($conn, $tableName) {
    // Retrieve data from the table
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        echo "<div class='table-container'>";
        // Display table header
        echo "<h2>Data of products present on the webpage</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Seller name</th><th>Product name</th><th>Price</th><th>Mobile no.</th><th>Location</th></tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["seller_name"] . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td>" . $row["seller_contact"] . "</td><td>" . $row["location"] . "</td></tr>";
        }
        echo "</table>";
        echo "<div class='total-count'>Total Records: " . $result->num_rows . "</div>";
        echo "</div>";

        // echo "<a href='new_user_data.php'><button>Go to New User Data</button></a>";

    } else {
        echo "<div class='table-container'>";
        echo "No data found in $tableName table.";
        echo "</div>";
    }
}


// Display data from each table
displayTableData($conn, "new_users");
displayTableData1($conn, "products_added");
displayTableData2($conn, "products_deleted");
displayTableData3($conn, "items");

// Close the database connection
$conn->close();
?>

</section>

<footer>
    <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
</footer>
</div>

</body>
</html>