<?php
require_once 'db_connect.php';

if ($_POST) {
	// Get order data from the form
	$clientName = $_POST['clientName'];

	// Check if the client has an order item that is not returned
	$sql = "SELECT oi.order_id FROM order_item oi
			LEFT JOIN orders o ON oi.order_id = o.order_id
			WHERE o.client_name = '$clientName' AND oi.isReturned = 0";

	$result = $connect->query($sql);

	if ($result->num_rows > 0) {
		echo '<script>alert("Still have unreturned items");window.location.href = "../orders.php?o=add";</script>';
		return;
	} 



    // Get order data from the form
    $orderDate = $_POST['orderDate'];
    $clientName = $_POST['clientName'];
    $studentNumber = $_POST['studentNumber'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $year_level = $_POST['yearLevel'];

    $productName = $_POST['productName'];
    $size = $_POST['size'];
	$categoryId = $_POST['categoryId'];
    $quantity = $_POST['quantity'];
    $total = $_POST['totalValue'];

	
    // Insert the order data into the orders table
    $sql = "INSERT INTO orders (order_date, client_name, student_Number, order_status, course, college, year_level) VALUES ('$orderDate', '$clientName', '$studentNumber', 1, '$course', '$college', '$year_level')";
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
		$currentSize = $size[$i];

		$orderItemSql = "INSERT INTO order_item ( order_id, product_id, brand, quantity, total) 
						 VALUES ( '$orderId', '$product', '$currentSize', '$quantityItem', '$totalItem')";

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
