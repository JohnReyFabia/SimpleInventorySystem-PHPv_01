<?php
require_once 'db_connect.php';

// Assuming the incoming JSON data
$jsonData = file_get_contents("php://input");

// Check if JSON data is present
if ($jsonData) {
    // Decode JSON data
    $data = json_decode($jsonData, true);

    // Check if JSON decoding was successful
    if ($data !== null) {
        // Extract user data
        $userId = $data['user_data']['userId'];
        $email = $data['user_data']['email'];


        $userQuery = "SELECT * FROM s_users WHERE user_id = '$userId'";
        $userResult = $connect->query($userQuery);
        
        $userData = $userResult->fetch_assoc();

        // Assign user data to variables
        $clientName = $userData['fname'] .' '. $userData['lname'];
        $program = $userData['program'];
        $college = $userData['college'];
        $yearLevel = $userData['year_level'];

        // Insert user data into the "orders" table
        $orderDate = date("Y-m-d"); // Assuming order_date should be the current date
        $orderStatus = 1; // Assuming the default order_status is 1
        $sql = "INSERT INTO orders (user_id, order_date, client_name, student_number, order_status, course, college, year_level) 
                    VALUES ('$userId', '$orderDate', '$clientName', '$email', '$orderStatus', '$program', '$college', '$yearLevel')";


        // Execute the SQL query for user data
        // Note: This is a basic example, and you should use prepared statements for security
        // and to prevent SQL injection.

        // Assuming you have a database connection, e.g., $conn
        $orderId;

        if ($connect->query($sql) === TRUE) {
            // Get the ID of the newly inserted order
            $orderId = $connect->insert_id;
        } else {
            echo $connect->error;
        }


        // Check if the query was successful
            // Extract order items data
            $orderItems = $data['order_items'];

            // Loop through order items and insert into the "order_item" table
            foreach ($orderItems as $item) {
                $productId = $item['product_id'];
                $brand = $item['brand'];
                $quantity = $item['quantity'];

                // Insert order item data into the "order_item" table
                $orderItemSql = "INSERT INTO order_item (order_id, product_id, brand, quantity, total, isReturned) VALUES ('$orderId', '$productId', '$brand', '$quantity', 0, false)";

                $connect->query($orderItemSql);

                // Insert borrow history data into the "borrow_history" table
                $borrowHistorySql = "INSERT INTO borrow_history (order_id, product_id, quantity_borrowed) 
                                     VALUES ('$orderId', '$productId', '$quantity')";

                // Execute the SQL query for borrow history data
                $connect->query( $borrowHistorySql);
            }

            // Respond with a success message or any additional data as needed
            $response = ['status' => 'success', 'message' => 'Order data inserted successfully'];
            echo json_encode($response);
    } else {
        // Respond with an error message for invalid JSON
        $response = ['status' => 'error', 'message' => 'Invalid JSON data'];
        echo json_encode($response);
    }
} else {
    // Respond with an error message if no JSON data is present
    $response = ['status' => 'error', 'message' => 'No JSON data found'];
    echo json_encode($response);
}

?>
