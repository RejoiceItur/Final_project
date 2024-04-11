<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <title>Products</title>
  <link rel="stylesheet" href="product.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500&display=swap" rel="stylesheet">

<style>



/* CSS styles for search container */
.search-container {
    position: relative;
    display: inline-block;
}

/* CSS styles for search input */
#search {
    padding-right: 30px; /* Ensure space for the search icon */
    width: 200px; /* Adjust width as needed */
}

/* CSS styles for search button */
.search-button {
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px 10px;
    background-color: #ddd; /* Button background color */
    border: none;
    cursor: pointer;
}

/* CSS styles for search icon */
.fa-search {
    color: #555; /* Icon color */
}

/* CSS styles for product cards */
.products-container {
    display: flex;
    margin-left: 0px;
    flex-wrap: wrap;
    gap: 20px; /* Adjust the gap between cards as needed */
}

.card {
    width: calc(33.33% - 20px); /* Adjust the width of each card as needed */
    /* Add additional styling as per your design */
}

.container {
    position: relative;
    /* Add additional styling as per your design */
}

/* Add additional CSS styles for other elements as needed */



#cardwraper{
  margin-left: 0px;
}

.footer{
  display: flex;
    margin-left: 0px;
    flex-wrap: wrap;
    width: 100%;
}



  
/* pagination Style*/

/* CSS styles for pagination */

.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination-link {
  display: inline-block;
  padding: 5px 10px;
  margin: 0 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  text-decoration: none;
  color: #333;
  background-color: #fff;
  transition: background-color 0.3s ease;
}

.pagination-link:hover {
  background-color: #f0f0f0;
}
</style>


</head>

<body>
  <div id="sticker">
  <div class="navbar-1">
    <div id="nav-left">
     <a href="addproduct.php">Sell on Marketplace</a>   
     <a href="add_services.php">Add your service</a>
     <a href="delete_product.php">Delete products</a>
     <!-- <a href="#">Buy in Bulk</a>
     <a href="#">Find a Studio</a> -->
    </div>
    <div href="#" id="nav-right">
<?php

session_start(); // Start session
// Check if the user is logged in
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username']; // Retrieve username from session
  // Display a welcome message or any other content for the logged-in user
  echo "Welcome, $username!";
}
?> 
    </div>
 </div>

  <div class="nav-middle">
    <div>
      <a href="./index.php">
        <img src="assets\products\logo1.png" alt="error" style="width:140px;height:80px;">
      </a>
    </div>
    <div id="searchbar">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <label for="search">Search:</label>
        <div class="search-container">
        <input type="text" id="search" name="search" placeholder="Enter product name">
        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
    </div>
      </form>
    </div>


<!--  Search box php  -->

   


<div id="images">
  <?php
  // Disable error reporting
error_reporting(0);
  session_start(); // Start session
  // Check if the user is logged in
  if (isset($_SESSION['username'])) {
      // If logged in, display logout icon
      echo '<a href="logout.php"><i class="fas fa-sign-out-alt" style="font-size:32px; color:black"></i></a>';
  } else {
      // If not logged in, display login icon
      echo '<a href="./login.php"><i class="fas fa-sign-in-alt" style="font-size:32px; color:black"></i></a>';
  }
  ?>
  <a href="./services.php"><i class="fa fa-cogs" style="font-size:32px; color:black"></i></a>
</div>
  </div>

  <!-- <div class="navbar-2">
    <a href="#">Furniture</a>
    <a href="#">Home Decor</a>
    <a href="#">Lamps & Lighting</a>
    <a href="#">Kitchen & Dining</a>
    <a href="#">Furnishings</a>
    <a href="#">Mattresses</a>
    <a href="#">Appliances</a>
    <a href="#">Pets</a>
    <a href="#">Modular</a>
    <a href="#">Gift Cards</a>
</div> -->
</div>
<br><br><br>
  
    

    <div id="cardwraper">
      <!-- product should append here -->
      <div class="products-container">

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

// Pagination variables
$limit = 6; // Number of products per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
$start = ($page - 1) * $limit; // Offset for SQL query

// Check if search query is provided
if (isset($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search = $conn->real_escape_string($_GET['search']);

    // Query to count total products
    $countQuery = "SELECT COUNT(*) as total FROM items WHERE name LIKE '%$search%'";
    
    // Query to fetch products based on product name with pagination
    $sql = "SELECT * FROM items WHERE name LIKE '%$search%' LIMIT $start, $limit";
} else {
    // Query to count total products
    $countQuery = "SELECT COUNT(*) as total FROM items";

    // Query to fetch all products with pagination
    $sql = "SELECT * FROM items LIMIT $start, $limit";
}

// Fetch total number of products
$countResult = $conn->query($countQuery);
$totalProducts = $countResult->fetch_assoc()['total'];

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display products
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<div class="container">';
        echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
        echo '</div>';
        echo '<div class="info">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
        echo '<p><strong>Price:</strong> Rs.' . $row['price'] . '</p>';
        echo '<p><strong>Location: </strong>' . $row['location'] . '</p>';
        echo '<div class="add-to-cart">';
        echo '<form action="card.php" method="post">';
        echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
        echo '<button type="submit">More info</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No products found matching your search.";
}
echo '</div>';

// Pagination links
$totalPages = ceil($totalProducts / $limit);
// Pagination links with CSS styles
echo '<div class="pagination">';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '" class="pagination-link">' . $i . '</a>';
}
echo '</div>';

// Close the database connection
$conn->close();
?>

    </div>



  </div>
  <br><br><br><br><br>
  <div class="footer">
    <div class="top">
        <div>
            <h3>Useful Links</h3>
            <a href="#"><p>About Us</p></a>
            <a href="#"><p>Our Blog</p></a>
            <a href="#"><p>Careers</p></a>
            <a href="#"><p>Corporate Governance</p></a>
            <a href="#"><p>Pepperfry In the News</p></a>
            <a href="#"><p>Find A Studio</p></a>
            <a href="#"><p>Gift Cards</p></a>
            <a href="#"><p>Brands</p></a>
            <a href="#"><p>Customer Reviews</p></a>
        </div>
        <div>
            <h3>Partners</h3>
            <a href="#"><p>Sell With Us</p></a>
            <a href="#"><p>Become a Franchisee</p></a>
            <a href="#"><p>Become a Pep Homie</p></a>
            <a href="#"><p>Design For Us</p></a>
            <a href="#"><p>Pepperfry Marketplace Policies</p></a>
            <a href="#"><p>Login to Your Merchant Dashboard</p></a>
            <a href="#"><p>Important : GST and You</p></a>
            <a href="#"><p>Corporate Enquiries</p></a>
        </div>
        <div>
            <h3>Need Help?</h3>
            <a href="#"><p>Contact Us</p></a>
            <a href="#"><p>Returns & Refund</p></a>
            <a href="#"><p>Track Your Order</p></a>
            <a href="#"><p>FAQs</p></a>
            <a href="#"><p>Buy on Phone</p></a>
        </div>
        <div>
          <a href="https://play.google.com/store/apps/details?id=com.app.pepperfry&pli=1"><img src="./images/downloadApp.jpg" alt="error"></a>  
          
        </div>
    </div>
    <div class="bottom">
        <div>
            <h3>Popular Categories</h3>
            <a href="#">
            <p>Queen Size Beds, King Size Beds, Coffee Tables, Dining Sets, Recliners, Sofa cum Beds, Rocking Chairs, Cabinets, Book Shelves, TV Unit, Wardrobes, Outdoor Furniture, Bar Cabinets, Wall Shelves, Photo Frames, Bed Sheets, Mattresses, Table Cloth, Living Room Furniture, Study Tables, Dining Room Furniture, Office Furniture, Bed Room Furniture, Dining Table, Beds, Sofas, Sofa Set, Trundle Bed</p>
            </a>
        </div>
        <div>
            <h3>Popular Brands</h3>
            <a href="#">
            <p>Mintwud, Woodsworth, CasaCraft, Amberville, Mudramark, Bohemiana, Clouddio, Spacewood, Durian, Green Soul, Godrej Interio, Nilkamal, Orange Tree , HomeTown , Duroflex , Sleepyhead , Peps India , NestAsia , Jaipur Rugs , Obettee , Eliante by Jainsons , @Home, Kapoor E Illuminaton , Ellementry , Chumbak , Philips , Jaipur Fabric , Maspar , India Circus by Krsnaa Mehta</p>
            </a>
        </div>
        <div>
            <h3>Cities we deliver to</h3>
            <a href="#">
            <p>Bengaluru, Mumbai, Navi Mumbai, Delhi, Hyderabad, Pune, Chennai, Gurgaon, Kolkata, Noida, Goa, Ghaziabad, Ahmedabad, Coimbatore, Faridabad, Jaipur, Lucknow, Kochi, Visakhapatnam, Chandigarh, Vadodara, Nagpur, Thiruvananthapuram, Indore, Mysore, Bhopal, Surat, Jalandhar, Patna, Ludhiana, Nashik, Madurai, Kanpur, Aurangabad and many more</p>
            </a>
        </div>
    </div>
    <hr>
    <div class="accept">
        <div>
        <h3>We accept</h3>
        <a href="#">
        <img id="accepting" src="./images/cards.jpg" alt="error">
        </a>
        </div>
        <div>
            <h3>Like what you see? You'll like us even more here</h3>
            <a href="#">
            <img id="accepting"  src="./images/apps.jpg" alt="error">
            </a>
        </div>
    </div>
    <hr>
    <div class="ending">
        <div>
            
            <a href="#"><p>Buy In Bulk</p></a>
            <a href="#"><p>Write A Testimonial</p></a>
        </div>
        <div>
            <a href="#"><p>Whitehat</p></a>
            <a href="#"><p>Site Map</p></a>
            <a href="#"><p>Terms Of Use</p></a>
            <a href="#"><p>Privacy Policy</p></a>
            <a href="#"><p>Your Data & Security</p></a>
            <a href="#"><p>Grievance Redressal</p></a>
        </div>
    </div>
</div>


</body>


</html>
