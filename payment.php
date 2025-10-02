<?php
session_start(); // ✅ Make sure session is started
include 'db.php';

if (!isset($_SESSION['last_order_id'])) {
    die("No order found. <a href='card.php'>Go back</a>");
}

$order_id = (int) $_SESSION['last_order_id'];

$sql = "SELECT * FROM card_orders WHERE id = $order_id";
$result = mysqli_query($dbconnection, $sql);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    die("Order not found. <a href='card.php'>Go back</a>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <section class="payment">
        <h2>Complete your payment</h2>
        <p><strong>Name:</strong><?php echo $order['name']; ?></p>
        <p><strong>Email:</strong><?php echo $order['email']; ?></p>
        <p><strong>Phone:</strong><?php echo $order['phone']; ?></p>
        <p><strong>Card Type:</strong> <?php echo $order['card_type']; ?></p>
        <p><strong>Quantity:</strong> <?php echo $order['quantity']; ?></p>

        <h3>Choose Payment</h3>
        <form action="confirm_payment.php" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $order['id'] ?>">
            <div>
             <input type="radio" id="credit" name="payment_method" value="Credit Card" required>
             <label for="credit">Credit Card</label>

             <input type="radio" id="paypal" name="payment_method" value="PayPal" required>
             <label for="paypal">PayPal</label>

             <input type="radio" id="bank" name="payment_method" value="Bank Transfer" required>
             <label for="bank">Bank Transfer</label>
            </div>
            <button type="submit">Confirm Payment</button>
        </form>
    </section>
</body>
</html>