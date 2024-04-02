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
    </head>
<body>
  <!-- <a href="./product.html">Product Page</a> -->
  <div id="sticker">
    <div class="navbar-1">
      <div id="nav-left">
       <a href="#">Sell on Pepperfry</a>   
       <a href="#">Become a Franchisee</a>
       <a href="#">Buy in Bulk</a>
       <a href="#">Find a Studio</a>
      </div>
      <div href="#" id="nav-right">
       <a href="#">Enter pincode
           <img id="edit_1" src="https://img.icons8.com/external-anggara-basic-outline-anggara-putra/24/external-edit-basic-ui-anggara-basic-outline-anggara-putra.png" alt="">
       </a>
       <a href="#">Find Pepperfry Studio</a>
      </div>
   </div>
  
    <div class="nav-middle">
      <div>
        <a href="./index.php">
          <img src="./images/logo new.png" alt="error">
        </a>
      </div>
      <div id="searchbar">
        <form>
          <input type="text" placeholder="Your door to happiness opens with a search" id="search">
          <img src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="error">
        </form>
      </div>
      <div id="images">
        <a href="#"><img
            src="https://img.icons8.com/external-vectorslab-flat-vectorslab/53/external-Help-Chat-customer-support-vectorslab-flat-vectorslab-2.png"
            alt="error"></a>
        <a href="./login.php"><img src="https://img.icons8.com/material-sharp/256/user.png" alt="error"></a>
        <a href="#"><img src="https://img.icons8.com/ios/256/like.png" alt="error"></a>
        <a href="./card.php"><img
            src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/256/external-Add-To-Cart-mobile-shopping-smashingstocks-detailed-outline-smashing-stocks-4.png"
            alt="error"></a>
      </div>
    </div>
  
    <div class="navbar-2">
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


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // JavaScript to handle "Contact" button click event and make AJAX request
$(document).ready(function() {
    $(".contact-button button").click(function() {
        // Get the product ID associated with the clicked button
        var productId = $(this).closest('.product-container').data('id');

        // Make AJAX request to get contact details
        $.ajax({
            url: 'get_contact_details.php', // URL of the server-side script
            type: 'GET',
            data: { product_id: productId }, // Pass the product ID as parameter
            success: function(response) {
                // Display the seller's contact details received from the server
                alert("Seller Contact: " + response);
            },
            error: function(xhr, status, error) {
                // Handle error if any
                console.error(xhr.responseText);
            }
        });
    });
});

</script> -->

  </body>
  <script>
    // let data=JSON.parse(localStorage.getItem("cart"))
    // console.log(data)
    // if(data.length>0){
    //     let emptyCart=document.getElementById("emptyCart")
    //     emptyCart.style.display="none"
    // }

//   let Container = document.getElementById("cart");
//  function display(){
//     Container.innerHTML=""
//     data.forEach(ele => {
//         let card=document.createElement("div")
//         let img=document.createElement("img");
//         let detail=document.createElement("div")
//         let name=document.createElement("h4");
//         let category=document.createElement("p");
//         category.setAttribute("class","category")
//         let price=document.createElement("p");
//         price.setAttribute("class","price")
//         let buy=document.createElement("button");
//         buy.setAttribute("id","buy");
//         let qunt=document.createElement("div")
//         qunt.setAttribute("id","qunt")
//         let Increment=document.createElement("button");
//         Increment.setAttribute("class","qunt")
//         let Decrement=document.createElement("button");
//         Decrement.setAttribute("class","qunt")
//         let quantity=document.createElement("p");
//         let cros=document.createElement("div")
//         cros.setAttribute("id","removebtn")
//         let remove=document.createElement("button")
//         remove.setAttribute("id","remove")
//         quantity.textContent=ele.quantity;
//         buy.textContent="Buy Now";
//         Increment.textContent="+";
//         Decrement.textContent="-";
//         remove.innerText="X";
//         img.src=ele.img
//         category.textContent=ele.category;
//         price.textContent=`₹${ele.price}`;
//         name.textContent=ele.name
//         remove.addEventListener("click",()=>{
//           data=data.filter((element)=>{
//             return element.id!==ele.id
//           })
//           localStorage.setItem("cart",JSON.stringify(data))
//           display()
//         });
//         buy.addEventListener("click",()=>{
//           window.location.href="./payment.html"
//         });
        
//         Increment.addEventListener("click",()=>{
//           ele=ele.quantity++
//           localStorage.setItem("cart",JSON.stringify(data))
//           display()
//         })
//         Decrement.addEventListener("click",()=>{
//           if(ele.quantity>1)
//           ele=ele.quantity--
//           localStorage.setItem("cart",JSON.stringify(data))
//           display()
//         })
//         detail.append(name,category,price)
//         qunt.append(Increment,quantity,Decrement)
//         cros.append(remove)
//         card.append(img,detail,qunt,buy,cros) 
//         Container.append(card);
//     });
//  }
 display()
  </script>
</html>
