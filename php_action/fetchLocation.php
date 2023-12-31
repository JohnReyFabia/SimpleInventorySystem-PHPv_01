<?php 	

require_once 'core.php';

$sql = "SELECT location_id, location_name, location_active, location_status FROM locations WHERE location_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeLocation = ""; 

 while($row = $result->fetch_array()) {
 	$locationId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeLocation = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeLocation = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editLocationModel" onclick="editLocation('.$locationId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeLocation('.$locationId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 		
 		$activeLocation,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);