<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT p.*, c.categories_name FROM product p INNER JOIN categories c ON c.categories_id = p.categories_id WHERE product_id = $productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);