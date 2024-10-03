<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "shoe_business");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $cost_price = $_POST['cost_price'];
    $selling_price = $_POST['selling_price'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO shoes (name, cost_price, selling_price, quantity_in_stock, date_added)
            VALUES ('$name', '$cost_price', '$selling_price', '$quantity', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New shoe added to inventory!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST">
    <label>Shoe Name:</label>
    <input type="text" name="name" required><br>
    
    <label>Cost Price:</label>
    <input type="number" step="0.01" name="cost_price" required><br>
    
    <label>Selling Price:</label>
    <input type="number" step="0.01" name="selling_price" required><br>
    
    <label>Quantity:</label>
    <input type="number" name="quantity" required><br>
    
    <button type="submit">Add Shoe</button>
</form>
