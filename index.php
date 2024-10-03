<?php
$conn = new mysqli("localhost", "root", "", "shoe_business");

// Fetch metrics
$total_sales = $conn->query("SELECT SUM(total_sale) AS total_sales FROM sales")->fetch_assoc()['total_sales'];
$total_cost = $conn->query("SELECT SUM(cost_price * quantity_in_stock) AS total_cost FROM shoes")->fetch_assoc()['total_cost'];
$profit = $total_sales - $total_cost;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoe Business Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Sales</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo $total_sales; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Total Cost</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo $total_cost; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Profit</div>
                    <div class="card-body">
                        <h5 class="card-title">$<?php echo $profit; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
