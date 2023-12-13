<?php    

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, student_number FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 


$orderItemSql = "SELECT order_item.product_id, order_item.quantity, order_item.total,
product.product_name, product.remarks, brands.brand_name FROM order_item
   INNER JOIN product ON order_item.product_id = product.product_id
   LEFT JOIN brands ON brands.brand_id = product.brand_id
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '<style>
.star img {
    visibility: visible;
}</style>
<table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
               <tbody>
                 
                  <tr>
                     <td rowspan="8" colspan="2" style="border-left:1px solid black;" background-image="logo1.png"><img src="./logo1.png" alt="logo" width="110px;"></td>
                     <td colspan="3" >ORIGINAL</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="font-style: italic;font-weight: 600;text-decoration: underline;font-size: 25px;">CS Laboratory Inventory System</td>
                  </tr>
                  <tr>
                     <td colspan="3" >Palawan State University </td>
                  </tr>
                  <tr>
                     <td colspan="3" >Bgy. Tiniguiban, Puerto Princesa City</td>
                  </tr>
                  <tr>
                     <td colspan="3" >Tele: 1234567890,1478523690.</td>
                  </tr>
                  <tr>
                     <td colspan="3" >Email: email0@email.co.in</td>
                  </tr>
   
                  <tr>
                     <td colspan="2" style="padding: 0px;vertical-align: top;border-right:1px solid black;">
                        <table align="left" cellpadding="0" cellspacing="0" style="border: thin solid black; width: 100%">
                           <tbody>
                              <tr>
                                 <td style="width: 74px;vertical-align: top;" rowspan="3">TO, </td>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: red">&nbsp;'.$clientName.'</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: black">&nbsp;</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: black">&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                        <table align="left" cellspacing="0" style="width: 100%; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-right-color: black; border-bottom-color: black; border-left-color: black;">
                           <tbody>
                     
                           </tbody>
                        </table>
                     </td>
                     <td style="padding: 0px;vertical-align: top;" colspan="3">
                        <table align="left" cellpadding="0" cellspacing="0" style="width: 100%">
                           <tbody>
                              <tr>
                                 <td style="border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;border-right: 1px solid black;    ">Date: '.$orderDate.'</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 123px;text-align: center;background-color: black;color: white;border-right: 1px solid white;border-left: 1px solid black;border-bottom: 1px solid black;-webkit-print-color-adjust: exact;">#
                     </td>
                     <td style="width: 50%;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: white;border-bottom-color: black;color: white;background-color: black;-webkit-print-color-adjust: exact;">Description Of Goods</td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: #fff;border-bottom-color: black;background-color: black;color: white;-webkit-print-color-adjust: exact;">Quantity</td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: #fff;border-bottom-color: black;background-color: black;color: white;-webkit-print-color-adjust: exact;">Size
                     </td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: black;border-bottom-color: black;color: white;background-color: black;-webkit-print-color-adjust: exact;">Remarks</td>
                  </tr>';
                  $x = 1;
            while($row = $orderItemResult->fetch_array()) {       
                        
               $table .= '<tr style="text-align: center">
                     <td style="border-left: 1px solid black;border-right: 1px solid black;height: 27px;">'.$x.'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[3].'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[1].'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[5].'</td>
                     <td style="border-left: 1px solid black;border-right: 1px solid black;height: 27px;">'.$row[4].'</td>
                  </tr>
               ';
            $x++;
            } 
$connect->close();

echo $table;