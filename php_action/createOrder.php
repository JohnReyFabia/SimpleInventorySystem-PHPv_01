<?php
require_once 'db_connect.php';

if ($_POST) {
    // Get order data from the form
    $orderDate = $_POST['orderDate'];
    $clientName = $_POST['clientName'];
    $clientContact = $_POST['clientContact'];
    $productName = $_POST['productName'];
    $categories = $_POST['categoriesValue']; // Assuming this is the categories_id
    $quantity = $_POST['quantity'];
    $total = $_POST['totalValue'];

    // Insert the order data into the orders table
    $sql = "INSERT INTO orders (order_date, client_name, client_contact) VALUES ('$orderDate', '$clientName', '$clientContact')";
	$orderId = $orderid; // Get the ID of the newly inserted order

	// Insert order item data into the order_item table
	for ($i = 0; $i < count($productName); $i++) {
		$product = $productName[$i];
		$category = $categories[$i];
		$quantityItem = $quantity[$i];
		$totalItem = $total[$i];

		$orderItemSql = "INSERT INTO order_item ( product_id, categories_id, quantity, total) 
						 VALUES ( '$product', '$category', '$quantityItem', '$totalItem')";

		$connect->query($orderItemSql);
	}

	// If everything was successful, send a success message
	$response = array(
		"status" => "success",
		"message" => "Order created successfully!",
		"orderId" => $orderId
	);

    if ($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
    } else {
        // If there was an error, send an error message
        $response = array(
            "status" => "error",
            "message" => "Error: " . $connect->error
        );
    }

    echo json_encode($response); // Return the response as JSON
}
