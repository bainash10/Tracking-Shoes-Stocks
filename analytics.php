<?php
$conn = new mysqli("localhost", "root", "", "shoe_business");

// Total sales
$total_sales = $conn->query("SELECT SUM(total_sale) AS total_sales FROM sales")->fetch_assoc()['total_sales'];

// Total cost
$total_cost = $conn->query("SELECT SUM(cost_price * quantity_in_stock) AS total_cost FROM shoes")->fetch_assoc()['total_cost'];

// Break-even point (when total revenue = total cost)
$break_even_sales = $total_cost;

echo "Total Sales: $" . $total_sales;
echo "Total Cost: $" . $total_cost;
echo "Break-even Sales: $" . $break_even_sales;
?>
<canvas id="breakEvenChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('breakEvenChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Cost', 'Revenue'],
        datasets: [{
            label: 'Break Even',
            data: [<?php echo $total_cost; ?>, <?php echo $total_sales; ?>],
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    }
});
</script>
