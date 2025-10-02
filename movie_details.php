<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid show ID.");
}

$result = $dbconnection->query("SELECT * FROM shows WHERE id = $id");
$show = $result->fetch_assoc();

if (!$show) {
    die("Show not found.");
}

// For ticket info, fetch all tickets for this show_id (if you have a tickets table linked by movie_id)
$tickets_result = $dbconnection->query("SELECT * FROM tickets WHERE movie_id = $id ORDER BY show_date ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($show['title']) ?> - Details</title>
  <link rel="stylesheet" href="movie_details.css">
</head>
<body>

  <div class="movie-details-container">
    

    <div class="top-section">
      <!-- Movie Poster -->
      <div class="movie-poster">
        <img src="upload/<?= htmlspecialchars($show['poster'] ?? '') ?>" alt="<?= htmlspecialchars($show['title']) ?> poster" />
      </div>

      <!-- Movie Info -->
      <div class="movie-info">
        <h1><?= htmlspecialchars($show['title']) ?></h1>
        <p><strong>Show Date:</strong> <?= htmlspecialchars($show['show_date']) ?></p>
        <p><strong>Show Time:</strong> <?= date("H:i", strtotime($show['time_start'])) ?> - <?= date("H:i", strtotime($show['time_end'])) ?></p>
        <p><strong>Rules:</strong> No age registration required</p>
      </div>
    </div>

    <!-- Description Section -->
    <section class="description-section">
      <h2>Description</h2>
      <p><?= nl2br(htmlspecialchars($show['description'])) ?></p>
    </section>

    <!-- Tickets Section -->
    <section class="tickets-section">
      <h2>Tickets</h2>
      

      <form action="buy.php" method="get">
        <input type="hidden" name="id" value="<?= $show['id'] ?>">
        <button type="submit" class="buy-btn">Buy Ticket</button>
      </form>
    </section>
  </div>

  <script src="movie_details.js"></script>
</body>
</html>
