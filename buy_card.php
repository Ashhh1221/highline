<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $email = mysqli_real_escape_string($dbconnection, $_POST['email']);
    $phone = mysqli_real_escape_string($dbconnection, $_POST['phone']);
    $card_type = mysqli_real_escape_string($dbconnection, $_POST['card_type']);
    $quantity = (int) $_POST['quantity'];

    // ✅ Generate unique reference ID
    $reference_id = uniqid("REF-");

    $sql = "INSERT INTO card_orders (name, email, phone, card_type, quantity, reference_id) 
            VALUES ('$name', '$email', '$phone', '$card_type', $quantity, '$reference_id')";

    if (mysqli_query($dbconnection, $sql)) {
        $last_order_id = mysqli_insert_id($dbconnection);

        // ✅ Store reference ID in session (better than order_id)
        $_SESSION['last_order_id'] = $last_order_id;
        $_SESSION['reference_id'] = $reference_id;

        header("Location: payment.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($dbconnection);
    }
}

mysqli_close($dbconnection);
?>
