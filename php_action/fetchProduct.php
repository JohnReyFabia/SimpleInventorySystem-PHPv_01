<?php 	



require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
        product.categories_id, product.location_id, product.quantity, product.SerialNumber,
        product.PropertyNumber, product.active, product.status,product.remarks, brands.brand_name,
        categories.categories_name, locations.location_name
        FROM product 
        INNER JOIN brands ON product.brand_id = brands.brand_id 
        INNER JOIN categories ON product.categories_id = categories.categories_id
        INNER JOIN locations ON product.location_id = locations.location_id  
        WHERE product.status = 1 AND product.quantity > 0";

$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $productId = $row[0];

        // Determine active status
        $active = ($row[9] == 1) ? "<label class='label label-success'>Available</label>" : "<label class='label label-danger'>Not Available</label>";

        // Generate the Action button markup
        $button = '
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct(' . $productId . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct(' . $productId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
            </ul>
        </div>';

        // Extract the required data
        $brand = $row[12];
        $category = $row[13];
        $location = $row[14];

        $imageUrl = substr($row[2], 3);
        $productImage = "<img class='img-round' src='" . $imageUrl . "' style='height:30px; width:50px;' />";

        $output['data'][] = array(
            // image
            $productImage,
            // location
            $location,
            // product name
            $row[1],
            // quantity
            $row[6] . " pcs",
            // size
            $brand,
            // serial number
            $row[7],
            // property number
            $row[8],
            // category
            $category,
            // active
            $active,
            // active
            $row[11],
            // button
            $button
        );
    }
}

$connect->close();

echo json_encode($output);
