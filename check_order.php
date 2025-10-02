<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference_id = mysqli_real_escape_string($dbconnection, $_POST['reference_id']);

    $sql = "SELECT * FROM card_orders WHERE reference_id='$reference_id'";
    $result = mysqli_query($dbconnection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);

        echo "<h2>🔎 Order Details</h2>";
        echo "<p><strong>Name:</strong> " . $order['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $order['email'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $order['phone'] . "</p>";
        echo "<p><strong>Card Type:</strong> " . $order['card_type'] . "</p>";
        echo "<p><strong>Quantity:</strong> " . $order['quantity'] . "</p>";
        echo "<p><strong>Payment Method:</strong> " . $order['payment_method'] . "</p>";
        echo "<p><strong>Status:</strong> " . $order['payment_status'] . "</p>";
        echo "<p><strong>Reference ID:</strong> " . $order['reference_id'] . "</p>";
    } else {
        echo "<p style='color:red;'>❌ No order found with that Reference ID.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Order</title>
    <link rel="stylesheet" href="check_order.css">
</head>
<body>
    <h2>Check Your Membership Order</h2>
    <form method="POST">
        <label for="reference_id">Enter Reference ID:</label>
        <input type="text" name="reference_id" id="reference_id" required>
        <button type="submit">Check</button>
    </form>
</body>
</html>
