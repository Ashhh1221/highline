<?php 

include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = (int) $_POST['order_id'];
    $payment_method = mysqli_real_escape_string($dbconnection, $_POST['payment_method']);

    $unique_id = "CARD-" . date("Ymd") . "-" . strtoupper(substr(md5(uniqid()), 0, 6));

    $sql = "UPDATE card_orders SET payment_method='$payment_method', payment_status='Paid', reference_id='$unique_id' WHERE id=$order_id";

    if(mysqli_query($dbconnection, $sql)){
        $result = mysqli_query($dbconnection, "SELECT * FROM card_orders WHERE id = $order_id");
        $order = mysqli_fetch_assoc($result);
        
        echo "<div class='confirm-card'>";
        echo "<h2>Payment Successful!</h2>";
        echo "<p><strong>Name:</strong> " . $order['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $order['email'] . "</p>";
        echo "<p><strong>Phone:</strong> " . $order['phone'] . "</p>";
        echo "<p><strong>Card Type:</strong> " . $order['card_type'] . "</p>";
        echo "<p><strong>Quantity:</strong> " . $order['quantity'] . "</p>";
        echo "<p><strong>Payment Method:</strong> " . $order['payment_method'] . "</p>";
        echo "<p><strong>Status:</strong> " . $order['payment_status'] . "</p>";
        echo "<h3 style='color:green;'>Reference ID: " . $order['reference_id'] . "</h3>";

        echo "<a href='card.php'>Back To Home Page</a>";
        echo "</div>";
    }else{
        echo " Error updating payment: " . mysqli_error($dbconnection);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link rel="stylesheet" href="confirm_payment.css">
</head>
<body>
    
</body>
</html>