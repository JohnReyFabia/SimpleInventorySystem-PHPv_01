<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$description 		= $_POST['description'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $sizeName 			= $_POST['sizeName'];
  $categoryName 	= $_POST['categoryName'];
  $locationName 	= $_POST['locationName'];
  $productStatus 	= $_POST['productStatus'];
  $serialNumber 		= $_POST['serialNumber'];
  $propertyNumber 		= $_POST['propertyNumber'];
  $remarks 				= $_POST['remarks'];


	$sql = "SELECT * FROM product WHERE product_name = '$description'";
		
	// Execute the query
	$result = $connect->query($sql);

	// Return true if the value exists, false otherwise
	if($result->num_rows > 0) {
		echo '<script>alert("Product already existed");window.location.href = "../product.php";</script>';
		return;
	}

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$urlDB = 'assests/images/stock/'.uniqid(rand()).'.'.$type;
	$url = '../' . $urlDB;


	
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, location_id, quantity, SerialNumber,PropertyNumber,  active, status, remarks) 
				VALUES ('$description', '$urlDB', '$sizeName', '$categoryName', $locationName, '$quantity', '$serialNumber','$propertyNumber', '$productStatus', 1, '$remarks')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo '<script>alert("' . $valid['messages'] . '"); window.location.href = "../product.php";</script>';
 
} // /if $_POST