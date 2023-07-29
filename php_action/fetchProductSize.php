<?php

require_once 'core.php';

if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch the designated size from the 'sizes' table for the selected product
    $sizeSql = "SELECT brand_name FROM brands WHERE brand_id = (
                    SELECT brand FROM product WHERE product_id = $product_id
                )";

    $sizeResult = $connect->query($sizeSql);
    $sizeData = $sizeResult->fetch_assoc();

    if ($sizeData && isset($sizeData['brand_name'])) {
        $response = array('size' => $sizeData['brand_name']);
        echo json_encode($response);
    } else {
        echo json_encode(null); // Product not found or size is not available
    }
} else {
    echo json_encode(null); // Invalid product_id or empty request
}
?>



