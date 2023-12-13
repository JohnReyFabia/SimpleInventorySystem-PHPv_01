<?php require_once 'includes/S_header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-check"></i> Borrowed History
            </div>
            <!-- /panel-heading -->
            <div class="panel-body">
                <?php
                // Assuming you have the user's information (clientName) from somewhere, adjust as needed
                if ($_POST && isset($_POST['client_name'])) {
                    $clientName = $_POST['client_name'];

                    // Fetch the borrowing history based on the client's name
                    $borrowHistoryQuery = "SELECT bh.borrow_id, bh.quantity_borrowed, bh.borrow_date, p.product_name
                                            FROM borrow_history bh
                                            INNER JOIN order_item oi ON bh.product_id = oi.product_id
                                            INNER JOIN product p ON oi.product_id = p.product_id
                                            INNER JOIN orders o ON bh.order_id = o.order_id
                                            WHERE o.your_column_name = '$clientName'
                                            ORDER BY bh.borrow_date DESC";

                    $borrowHistoryResult = $connect->query($borrowHistoryQuery);

                    // Display the borrowing history
                    if ($borrowHistoryResult->num_rows > 0) {
                        echo '<table class="table table-bordered">';
                        echo '<thead><tr><th>Borrow ID</th><th>Product Name</th><th>Quantity Borrowed</th><th>Borrow Date</th></tr></thead>';
                        echo '<tbody>';
                        while ($row = $borrowHistoryResult->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['borrow_id'] . '</td>';
                            echo '<td>' . $row['product_name'] . '</td>';
                            echo '<td>' . $row['quantity_borrowed'] . '</td>';
                            echo '<td>' . $row['borrow_date'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo 'No borrowing history found for ' . $clientName;
                    }
                } else {
                    echo 'Client name not provided.';
                }
                ?>
            </div>
            <!-- /panel-body -->
        </div>
    </div>
    <!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>
