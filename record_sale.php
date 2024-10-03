<?php
$conn = new mysqli("localhost", "root", "", "shoe_business");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shoe_id = $_POST['shoe_id'];
    $quantity_sold = $_POST['quantity_sold'];

    $shoe = $conn->query("SELECT * FROM shoes WHERE id=$shoe_id")->fetch_assoc();
    $total_sale = $shoe['selling_price'] * $quantity_sold;

    $sql = "INSERT INTO sales (shoe_id, quantity_sold, total_sale, sale_date) 
            VALUES ('$shoe_id', '$quantity_sold', '$total_sale', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Update inventory
        $new_quantity = $shoe['quantity_in_stock'] - $quantity_sold;
        $conn->query("UPDATE shoes SET quantity_in_stock='$new_quantity' WHERE id=$shoe_id");

        echo "Sale recorded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <label>Shoe:</label>
    <select name="shoe_id">
        <?php
        $result = $conn->query("SELECT * FROM shoes");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['name']} (Stock: {$row['quantity_in_stock']})</option>";
        }
        ?>
    </select><br>
    
    <label>Quantity Sold:</label>
    <input type="number" name="quantity_sold" required><br>
    
    <button type="submit">Record Sale</button>
</form>
