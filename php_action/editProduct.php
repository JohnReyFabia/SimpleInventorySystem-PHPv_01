<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
  $productId			= $_POST['productId'];
  $description 		    = $_POST['editDescription']; 
  $quantity 			= $_POST['editQuantity'];
  $SerialNumber 		= $_POST['editSerialNumber'];
  $PropertyNumber 		= $_POST['editPropertyNumber'];
  $sizeName 			= $_POST['editSizeName'];
  $categoryName 		= $_POST['editCategoryName'];
  $locationName 		= $_POST['editLocationName'];
  $productStatus 		= $_POST['editProductStatus'];
  $remarks 		  = $_POST['editRemarks'];

				
	$sql = "UPDATE product SET product_name = '$description', brand_id = '$sizeName', categories_id = '$categoryName', location_id = '$locationName', quantity = '$quantity', SerialNumber = '$SerialNumber',PropertyNumber = '$PropertyNumber', remarks = '$remarks', active = '$productStatus', status = 1 WHERE product_id = '$productId' ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
