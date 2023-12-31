<?php

require_once 'core.php';

$sql = "
SELECT
    orders.order_id,
    orders.order_date,
    orders.client_name,
	orders.student_Number,
    product.active
FROM
    orders
INNER JOIN order_item ON order_item.order_id = orders.order_id
INNER JOIN product ON product.product_id = order_item.product_id
WHERE
    orders.order_status = 1
";
$result = $connect->query($sql);




$output = array('data' => array());

if ($result->num_rows > 0) {

	$paymentStatus = "";
	$x = 1;

	while ($row = $result->fetch_array()) {
		$orderId = $row[0];

		// echo json_encode($row); die();

		$countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $orderId";
		$countUnreturnedOrderItemSql = "SELECT COUNT(*) FROM order_item WHERE order_id = $orderId AND isReturned = 0";
		$itemCountResult = $connect->query($countOrderItemSql);
		$itemcountUnreturnedOrderItemResult = $connect->query($countUnreturnedOrderItemSql);
		$itemCountRow = $itemCountResult->fetch_row();
		$itemCountUnreturnedOrderItemRow = $itemcountUnreturnedOrderItemResult->fetch_row();


		// active 
		if ($row["active"] == 1) {
			$paymentStatus = "<label class='label label-success'>Not Available</label>";
		} else if ($row["active"] == 2) {
			$paymentStatus = "<label class='label label-info'>Still Available</label>";
		} else {
			$paymentStatus = "<label class='label label-warning'>Available</label>";
		} // /else

		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="orders.php?o=editOrd&i=' . $orderId . '" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		<li><a href="orders.php?o=returnOrd&i=' . $orderId . '" id="returnOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Return</a></li>
	    <li><a type="button" onclick="printOrder(' . $orderId . ')"> <i class="glyphicon glyphicon-print"></i> Print </a></li>
	    
	     </ul>
	</div>';

		$output['data'][] = array(
			// image
			$x,
			// order date
			$row[1],
			// client name
			$row[2],
			// client contact
			$row["student_Number"],
			$itemCountRow,
			($itemCountUnreturnedOrderItemRow[0] > 0) ? "<label class='label label-warning'>Pending</label>" : "<label class='label label-success'>Available</label>",
			// button
			$button
			
		);
		$x++;
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
