<?php
session_start();
include 'db.php';
include 'phpqrcode/qrlib.php';// include QR code library

if (!isset($_SESSION['reference_id'])) {
    header("Location: home.php");
    exit;
}

$reference_id = $_SESSION['reference_id'];

// Fetch orders and show info
$sql = "SELECT o.*, s.title, s.show_date, s.time_start, s.time_end
        FROM ticket_orders o
        JOIN shows s ON o.show_id = s.id
        WHERE o.reference_id = '$reference_id'";
$result = mysqli_query($dbconnection, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Order not found.");
}

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
$user_info = $orders[0];

// Generate QR code
$qr_data = json_encode([
    'reference_id' => $reference_id,
    'name' => $user_info['name'],
    'email' => $user_info['email'],
    'phone' => $user_info['phone'],
    'movie' => $user_info['title'],
    'show_date' => $user_info['show_date'],
    'time_start' => $user_info['time_start'],
    'tickets' => array_map(function($o){ return ['ticket_id'=>$o['ticket_id'], 'quantity'=>$o['quantity']]; }, $orders)
]);

$qr_file = 'qrcodes/'.$reference_id.'.png';
if (!file_exists($qr_file)) {
    QRcode::png($qr_data, $qr_file, 'L', 6, 2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ticket Success</title>
<link rel="stylesheet" href="success.css">
</head>
<body>
<div class="ticket-container">
    <h1>✅ Your Ticket is Confirmed!</h1>

    <div class="ticket-card">
        <div class="ticket-header">
            <h2><?= htmlspecialchars($user_info['title']) ?></h2>
            <p>Show Date: <?= htmlspecialchars($user_info['show_date']) ?></p>
            <p>Time: <?= date("H:i", strtotime($user_info['time_start'])) ?> - <?= date("H:i", strtotime($user_info['time_end'])) ?></p>
        </div>

        <div class="ticket-body">
            <h3>User Information</h3>
            <p><strong>Name:</strong> <?= htmlspecialchars($user_info['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user_info['email']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($user_info['phone']) ?></p>

            <h3>Tickets</h3>
            <ul>
            <?php foreach ($orders as $order): ?>
                <li>Ticket ID <?= $order['ticket_id'] ?> - Quantity: <?= $order['quantity'] ?></li>
            <?php endforeach; ?>
            </ul>

            <h3>QR Code</h3>
            <img src="<?= $qr_file ?>" alt="Ticket QR Code" class="qr-code">
            <div class="back-home">
                <a href="home.php" class="back-btn">Back to Home</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
