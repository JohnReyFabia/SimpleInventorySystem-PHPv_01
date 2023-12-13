<?php

require_once 'db_connect.php';


// SQL query to select all products
$sql = "SELECT * FROM product";

$result = $connect->query($sql);

// Initialize an array to store the results
$products = array();

if ($result->num_rows > 0) {
    // Fetch each row and add it to the array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    // If no results
    $products = array("message" => "No products found");
}

// Close the database connection
$connect->close();

// Output the result as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>