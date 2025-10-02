<?php
$conn = new mysqli("localhost", "root", "", "highline_film");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM shows ORDER BY show_date ASC");

$grouped = [];
while ($row = $result->fetch_assoc()) {
    $month = date("F", strtotime($row['show_date']));
    $grouped[$month][] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link rel="stylesheet" href="ticket.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sail&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header"  id="mainHeader">
        <div class="logo">
            <h1>HighLine</h1>
        </div>
        <div class="nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="ticket.php" class="active" >Ticket</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="card.php">Member</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="search">
            <input type="text" placeholder="Search...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
  <div class="container">
    <h1>Upcoming Screenings</h1>

    <?php foreach ($grouped as $month => $events): ?>
      <h2 class="month-title"><?= htmlspecialchars($month) ?></h2>
      <?php foreach ($events as $event): ?>
        <div class="ticket-card">
          <div class="date"><?= date("d", strtotime($event['show_date'])) ?></div>
          <div class="info">
            <h3><?= htmlspecialchars($event['title']) ?></h3>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <span class="time"><?= date("H:i", strtotime($event['time_start'])) ?> - <?= date("H:i", strtotime($event['time_end'])) ?></span>
            <a href="movie_details.php?id=<?= $event['id'] ?>" class="buy">Buy Ticket</a>

          </div>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
  <script src="ticket.js"></script>
  <footer class="highline-footer">
        <div class="footer-links">
            <a href="#">FAQ</a>
            <a href="ticket.php">Tickets</a>
            <a href="schedule.php">Events</a>
            <a href="contact.php">Contact</a>
            <a href="#">Terms & Privacy</a>
        </div>

        <div class="social-icon">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>

        <div class="footer-credit">
            <p>Site by Highline Studio</p>
            <p>© 2025 Highline Film. All rights reserved.</p>
            <p><a href="#">Legal Notice</a></p>
        </div>

        <div class="payment-icon">
             <img src="Logo/visa.png" alt="Visa">
             <img src="Logo/paypal.png" alt="PayPal">
             <img src="Logo/master.png" alt="Mastercard">
             <img src="Logo/scan.png" alt="Bank">
             <img src="Logo/credit-card.png" alt="Membercard">
        </div>
  </footer>
  
</body>
</html>