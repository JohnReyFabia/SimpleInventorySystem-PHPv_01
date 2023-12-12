<?php require_once 'includes/header.php'; ?>

<?php 
$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();
?>

<style type="text/css">
    .ui-datepicker-calendar {
        display: none;
    }
    .fixed-date-box {
        position: fixed;
        bottom: 5%;
        right: 5%;
        background-color: #ffffff;
        border: 1px solid #ddd;
        padding: 1px;
        font-size: 14px;
        text-align: center;
    }
    .fixed-date-box h1 {
        font-weight: bold;
        margin: 0;
    }
	
</style>

<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">

<div class="row">
    <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1) { ?>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <a href="product.php" style="text-decoration:none;color:black;">
                        Total Number of Equipment
                        <span class="badge pull pull-right"><?php echo $countProduct; ?></span>    
                    </a>
                </div> <!--/panel-heading-->
            </div> <!--/panel-->
            <div class="col-md-12">
                <canvas id="totalEquipmentChart" width="400" height="200"></canvas>
            </div>
        </div> <!--/col-md-4-->

        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <a href="product.php" style="text-decoration:none;color:black;">
                        Low Stock
                        <span class="badge pull pull-right"><?php echo $countLowStock; ?></span>    
                    </a>
                </div> <!--/panel-heading-->
            </div> <!--/panel-->
            <div class="col-md-12">
                <canvas id="lowStockChart" width="400" height="200"></canvas>
            </div>
        </div> <!--/col-md-4-->

        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <a href="orders.php?o=manord" style="text-decoration:none;color:black;">
                        Number of Borrowed Equipment
                        <span class="badge pull pull-right"><?php echo $countOrder; ?></span>
                    </a>
                </div> <!--/panel-heading-->
            </div> <!--/panel-->
            <div class="col-md-12">
                <canvas id="borrowedEquipmentChart" width="400" height="200"></canvas>
            </div>
        </div> <!--/col-md-4-->

        <div class="col-md-4">
            <div class="fixed-date-box">
                <div class="cardHeader">
                    <h1><?php echo date('d'); ?></h1>
                </div>
                <div class="cardContainer">
                    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
                </div>
            </div>
            <br/>
        </div>
    <?php } ?>  
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    $(function () {
        // top bar active
        $('#navDashboard').addClass('active');

        // Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: 'title'
            },
            buttonText: {
                today: 'today',
                month: 'month'          
            }        
        });
        
        // Total Number of Equipment Chart
        var totalEquipmentCtx = document.getElementById('totalEquipmentChart').getContext('2d');
        var totalEquipmentChart = new Chart(totalEquipmentCtx, {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Borrowed'],
                datasets: [{
                    data: [<?php echo $countProduct - $countOrder; ?>, <?php echo $countOrder; ?>],
                    backgroundColor: ['#36A2EB', '#FFCE56']
                }]
            }
        });

        // Low Stock Chart
        var lowStockCtx = document.getElementById('lowStockChart').getContext('2d');
        var lowStockChart = new Chart(lowStockCtx, {
            type: 'bar',
            data: {
                labels: ['Low Stock'],
                datasets: [{
                    data: [<?php echo $countLowStock; ?>],
                    backgroundColor: '#FF6384'
                }]
            }
        });

        // Number of Borrowed Equipment Chart
        var borrowedEquipmentCtx = document.getElementById('borrowedEquipmentChart').getContext('2d');
        var borrowedEquipmentChart = new Chart(borrowedEquipmentCtx, {
            type: 'bar',
            data: {
                labels: ['Borrowed Equipment'],
                datasets: [{
                    data: [<?php echo $countOrder; ?>],
                    backgroundColor: '#1c39bb'
                }]
            }
        });
    });
</script>

<?php require_once 'includes/footer.php'; ?>
