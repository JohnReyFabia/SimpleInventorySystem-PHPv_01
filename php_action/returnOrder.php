<?php
require_once 'core.php';

$valid = array('success' => false, 'messages' => array());

$orderId = isset($_POST['orderId']) ? $_POST['orderId'] : null;

if ($orderId && isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
    // Loop through selected items and update order item status for each checked item
    foreach ($_POST['selected_items'] as $selectedItemId) {
        // Check if the checkbox is checked (selected)
        $isChecked = isset($_POST['selected_items']) && in_array($selectedItemId, $_POST['selected_items']);

        // Update order item status only if the checkbox is checked
        if ($isChecked) {
            $orderItemListSql = "UPDATE order_item SET isReturned = 1 WHERE order_item_id = {$selectedItemId}";

            if ($connect->query($orderItemListSql) !== TRUE) {
                $valid['success'] = false;
                $valid['messages'] = "Error while removing the order items";
                break; // exit the loop on error
            }
        }
    }

    if ($valid['success']) {
        // All updates were successful
        $valid['success'] = true;
        $valid['messages'] = "Successfully Removed";
    }

    $connect->close();

    header('location:'.$store_url.'orders.php?o=manord');	
} else {
   echo "Error";
}
?>
