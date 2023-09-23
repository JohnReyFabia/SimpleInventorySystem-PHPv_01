<?php
require_once 'db_connect.php';

if ($_POST) {

	

    // Get order data from the form
    $orderDate = $_POST['orderDate'];
    $clientName = $_POST['clientName'];
    $studentNumber = $_POST['studentNumber'];
    $productName = $_POST['productName'];
    $categoryId = $_POST['categoryId'];
    $quantity = $_POST['quantity'];
    $total = $_POST['totalValue'];

	
    // Insert the order data into the orders table
    $sql = "INSERT INTO orders (order_date, client_name, student_Number, order_status) VALUES ('$orderDate', '$clientName', '$studentNumber', 1)";
	$orderId; 

	if ($connect->query($sql) === TRUE) {
		// Get the ID of the newly inserted order
		$orderId = $connect->insert_id;
		echo "New record created successfully. Last inserted ID is: " . $orderId;
    } else {
        echo $connect->error;
    }



	// Insert order item data into the order_item table
	for ($i = 0; $i < count($productName); $i++) {
		$product = $productName[$i];
		$category = $categoryId[$i];
		$quantityItem = $quantity[$i];
		$totalItem = $total[$i];

		$orderItemSql = "INSERT INTO order_item ( order_id, product_id, categoryId, quantity, total) 
						 VALUES ( '$orderId', '$product', '$category', '$quantityItem', '$totalItem')";

		$connect->query($orderItemSql);
	}

	// If everything was successful, send a success message
	$response = array(
		"status" => "success",
		"message" => "Order created successfully!",
		"orderId" => $orderId
	);

    // echo json_encode($response); // Return the response as JSON

	header("Location: ../orders.php?o=add&alert=success&order_id=" .$orderId);
	die();
}
