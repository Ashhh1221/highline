<?php 

include 'db.php';

$movie_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($movie_id <= 0) {
    die("Invalid movie ID.");
}

$show_result = mysqli_query($dbconnection, "SELECT * FROM shows WHERE id = $movie_id");
$show = $show_result->fetch_assoc();
if (!$show) {
    die("Show not found.");
}

$tickets_result = $dbconnection->query("SELECT * FROM tickets WHERE movie_id = $movie_id ORDER BY show_date ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Ticket - <?= htmlspecialchars($show['title']) ?></title>
    <link rel="stylesheet" href="buy.css">
</head>
<body>
    <div class="buy-container">
        <h1>Buy Tickets for <?= htmlspecialchars($show['title']) ?></h1>
        <p><strong>Show Date:</strong><?= htmlspecialchars($show['show_date'])?></p>
        <p><strong>Show Time:</strong> <?= date("H:i", strtotime($show['time_start'])) ?> - <?= date("H:i", strtotime($show['time_end'])) ?></p>
        <?php if($tickets_result->num_rows > 0): ?>
            <form action="process_buy.php" method="POST" class="buy-form">
                <input type="hidden" name ="movie_id" value="<?= $movie_id ?>">

                <div class="tickets-list">
                    <?php while ($ticket = $tickets_result->fetch_assoc()) :?>
                        <div class="ticket-card">
                            <div class="ticket-info">
                                <span class="ticket-date">Date: <?= htmlspecialchars($ticket['show_date']) ?></span>
                                <span class="ticket-drink">Entry drink: <?= htmlspecialchars($ticket['entry_drinks']) ?></span>
                                <span class="ticket-price">Ticket: <?= number_format($ticket['price'],2) ?> THB</span>
                                <span class="ticket-available">Available: <?= intval($ticket['quantity']) ?></span>
                            </div>
                            <div class="ticket-qty">
                                <label>
                                    Qty:
                                    <input type="number" name="quantity[<?= $ticket['id'] ?>]" min="0" max="<?= intval($ticket['quantity']) ?>" value="0">
                                </label>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <h3>Your Information</h3>
                <div class="user-info">
                 <label>Name: <input type="text" name="name" required></label>
                 <label>Email: <input type="email" name="email" required></label>
                 <label>Phone: <input type="text" name="phone" required></label>
                </div>
                <button type="submit" class="confirm-btn">Confirm Purchase</button>
            </form>
        <?php else: ?>
            <p>No tickets available for this show.</p>
        <?php endif; ?>
    </div>
</body>
</html>