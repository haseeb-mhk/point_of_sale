<?php
// Check if products data is received
if(isset($_POST['products'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind insert statement
    $stmt = $conn->prepare("INSERT INTO Products_table (ProductName, StockQuantity) VALUES (?, ?)");

    // Bind parameters
    $stmt->bind_param("si", $productName, $quantity);

    // Iterate through products data and insert into database
    foreach($_POST['products'] as $product) {
        $productName = $product['productName'];
        $quantity = $product['quantity'];
        $stmt->execute();
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    echo "Products inserted successfully!";
} else {
    echo "No products data received.";
}
?>
