<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>card</title>
        <link rel="stylesheet" href="product.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500&display=swap" rel="stylesheet">


    <style>
    /* Style for the cart container */
    #cart {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 20px;
    }

    /* Style for each product container */
    .product-container {
        width: 300px;
        margin: 10px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style for product image */
    .product-container img {
        width: 80%;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    /* Style for product details */
    .product-details h2 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .product-details p {
        margin-bottom: 10px;
        font-size: 14px;
    }

    /* Style for empty cart message */
    #emptyCart {
        text-align: center;
        margin-top: 20px;
    }

    /* Style for the empty cart image */
    #emptyCart img {
        width: 200px;
        height: auto;
        margin-bottom: 20px;
    }

    /* Style for the empty cart button */
    #emptyCart button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style for the empty cart button hover effect */
    #emptyCart button:hover {
        background-color: #0056b3;
    }
</style>








    </head>
<body>
  <!-- <a href="./product.html">Product Page</a> -->
  <div id="sticker">
    <div class="navbar-1">
      <div id="nav-left">
      <a href="addproduct.php">Sell on Marketplace</a>   
     <a href="add_services.php">Add your service</a>
     <a href="delete_product.php">Delete products</a>
      </div>
      <div href="#" id="nav-right">
       <!-- <a href="#">Enter pincode
           <img id="edit_1" src="https://img.icons8.com/external-anggara-basic-outline-anggara-putra/24/external-edit-basic-ui-anggara-basic-outline-anggara-putra.png" alt="">
       </a>
       <a href="#">Find Pepperfry Studio</a> -->
      </div>
   </div>
  
    <div class="nav-middle">
      <div>
        <a href="./index.php">
          <img src="assets\products\logo1.png" alt="error" style="width:140px;height:80px;">
        </a>
      </div>
      <div id="searchbar">
        <form>
          <input type="text" placeholder="Your door to happiness opens with a search" id="search">
          <img src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="error">
        </form>
      </div>
      <div id="images">
        <!-- <a href="#"><img
            src="https://img.icons8.com/external-vectorslab-flat-vectorslab/53/external-Help-Chat-customer-support-vectorslab-flat-vectorslab-2.png"
            alt="error"></a>
        <a href="./login.php"><img src="https://img.icons8.com/material-sharp/256/user.png" alt="error"></a>
        <a href="#"><img src="https://img.icons8.com/ios/256/like.png" alt="error"></a>
        <a href="./card.php"><img
            src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/256/external-Add-To-Cart-mobile-shopping-smashingstocks-detailed-outline-smashing-stocks-4.png"
            alt="error"></a> -->
      </div>
    </div>
  
    <div class="navbar-2">
      <!-- <a href="#">Furniture</a>
      <a href="#">Home Decor</a>
      <a href="#">Lamps & Lighting</a>
      <a href="#">Kitchen & Dining</a>
      <a href="#">Furnishings</a>
      <a href="#">Mattresses</a>
      <a href="#">Appliances</a>
      <a href="#">Pets</a>
      <a href="#">Modular</a>
      <a href="#">Gift Cards</a> -->
  </div>
  </div>  
    <!-- Your existing HTML code -->

    

    <div id="cart">
    <?php
        // session_start();

        // Check if the cart is not empty
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


//       session_start(); // Start session

// if (isset($_SESSION['user_id'])) {
//     $userId = $_SESSION['user_id']; // Retrieve user ID from session



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if product_id is set in the POST request
    if (isset($_POST["product_id"])) {
        $selectedProductId = $_POST["product_id"];

        // Query to fetch details of the selected product
        $sql = "SELECT * FROM items WHERE id = $selectedProductId";
        $result = $conn->query($sql);

        // Display details of the selected product
        if ($result->num_rows > 0) {
            $selectedProduct = $result->fetch_assoc();
            echo '<div class="product-container">';
          echo '<div class="product-details">';
          echo '<h2>' . $selectedProduct['name'] . '</h2>';
          echo '<img src="' . $selectedProduct['image_path'] . '" alt="' . $selectedProduct['name'] . '">';
          echo '<p><strong>Seller name:</strong> ' . $selectedProduct['seller_name'] . '</p>';
          echo '<p><strong>Description:</strong> ' . $selectedProduct['description'] . '</p>';
          echo '<p><strong>Price:</strong> Rs.' . $selectedProduct['price'] . '</p>';
          echo '<p><strong>Location: </strong>' . $selectedProduct['location'] . '</p>';
          echo '<p><strong>Mobile no:</strong> ' . $selectedProduct['seller_contact'] . '</p>';
          echo '</div>';
          // echo '<div class="contact-button">';
          // echo '<button>Contact</button>';
          // echo '</div>';
          echo '</div>';

        }}} 
        
    
        else {
          echo '<div id="emptyCart">
          <img src="https://www.rentomojo.com/public/images/error/no-cart.png" alt="" />
          <h1>No Items in Cart</h1>
          <p>
              Add a few items to your cart and come back here for an express checkout process!
          </p>
          <div><button id="emptbtn"><a href="./product.php"> Browse catalogue</a></button></div>
      </div>';
        }

        ?>
    </div>


  </body>
  
</html>
