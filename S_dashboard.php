<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/S_header.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <style>
        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .item {
            width: 24%; /* Adjusted to account for the gap */
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            border: 1px solid #ddd; /* Border added */
        }

        .item img {
            max-width: 100%;
            border: 1px solid #ddd; /* Border added */}
    </style>
</head>
<body>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> List of Equipment</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">

                <?php

                // Fetch inventory data from the database
                $sql = "SELECT product_id, product_name, product_image FROM product WHERE status = 1";
                $result = $connect->query($sql);

                // Display the inventory in a grid
                echo '<div class="item-container">';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="item">';
                        // Determine the image type based on the file extension
                        $imagePath =  $row['product_image'];
                        echo '<img src="' . $imagePath . '" alt="' . $row['product_name'] . '" style="max-width: 100%;" />';
                        echo '<p>' . $row['product_name'] . '</p>';

                        echo '<button onclick="borrowItem(' . $row['product_id'] . ')"> Add to Borrowed Cart</button>';
                        echo '</div>';
                    }
                }

                ?>
                </div> <!-- /div-action -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

</body>
</html>


<script>
    function borrowItem(productId, currentQuantity = 10){
        const quantity = prompt("Enter Quantity");

        if(quantity > currentQuantity) {
            alert("Error quantity is greater than in stock")
        }


        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        const index = cart.findIndex(item => item.product_id === productId)
        console.log(index)
        if(index > -1) {
            const updatedCart = cart.map((item, i) => {
                if(i === index) {
                    return {
                        ...item,
                        quantity: Number(item.quantity) + Number(quantity)
                     }
                }
            return item
            })
        localStorage.setItem("cart", JSON.stringify(updatedCart));
        }else {
            console.log("asd")
            cart.push({
                product_id: productId,
                quantity: Number(quantity)
            })
            console.log(cart)

            localStorage.setItem("cart", JSON.stringify(cart));
        }
    }
</script>
