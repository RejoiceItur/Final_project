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
                    
                    // Retrieve form data
                    $mobile = $_POST['mobile'];
                    $password = $_POST['password'];
                    
                    // Validate mobile number and password
                    $sql = "SELECT * FROM users WHERE mobile = '$mobile' AND password = '$password'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // User authenticated successfully
                        $user = $result->fetch_assoc(); // Fetch user data
                        $username = $user['fullname']; // Assuming 'name' is the column name for the user's name
    
     // Redirect to index.php with username as a parameter
     header("Location: index.php?username=" . urlencode($username));

                        // You can redirect the user to another page or perform other actions here
                    } else {
                        // Invalid mobile number or password
                        header("Location: login.php");
                    }
                    
                    // Close the database connection
                    $conn->close();
                    ?>