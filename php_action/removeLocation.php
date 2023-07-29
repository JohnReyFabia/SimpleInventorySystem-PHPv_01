<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$locationId = $_POST['locationId'];

if($locationId) { 

 $sql = "UPDATE locations SET location_status = 2 WHERE location_id = {$locationId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the location";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST