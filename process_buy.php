<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $show_id = isset($_POST['movie_id']) ? intval($_POST['movie_id']) : 0;
    if ($show_id <= 0) {
        die("Invalid show ID.");
    }

    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $email = mysqli_real_escape_string($dbconnection, $_POST['email']);
    $phone = mysqli_real_escape_string($dbconnection, $_POST['phone']);
    $quantities = $_POST['quantity'] ?? [];

    $reference_id = uniqid('TICKET-'); // unique reference ID

    foreach ($quantities as $ticket_id => $qty) {
        $qty = intval($qty);
        if ($qty > 0) {
            $sql = "INSERT INTO ticket_orders (show_id, ticket_id, name, email, phone, quantity, status, reference_id)
                    VALUES ($show_id, $ticket_id, '$name', '$email', '$phone', $qty, 'Pending', '$reference_id')";
            mysqli_query($dbconnection, $sql);
        }
    }

    $_SESSION['reference_id'] = $reference_id;
    header("Location: success.php");
    exit;

} else {
    header("Location: home.php");
    exit;
}
?>
