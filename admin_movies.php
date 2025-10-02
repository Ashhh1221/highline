<?php
include 'db.php';

$result = $dbconnection->query("SELECT * FROM shows ORDER BY show_date ASC");

$grouped = [];
while ($row = $result->fetch_assoc()) {
    $month = date("F", strtotime($row['show_date']));
    $grouped[$month][] = $row;
}

// Get first show for quick "Edit Show" link
$first_show_id = 0;
$first = $dbconnection->query("SELECT id FROM shows ORDER BY id ASC LIMIT 1");
if ($first && $first->num_rows > 0) {
    $row = $first->fetch_assoc();
    $first_show_id = $row['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Movies</title>
  <link rel="stylesheet" href="admin_movies.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Admin Panel</h2>
      <a href="adminpanel.php">Manage Shows</a>
      <a href="add.php">Add New Show</a>
      <a href="edit_shows_ad.php?id=<?= $first_show_id ?>" class="active">Edit Show</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="admin-header">
        <h1>🎬 Manage Movies</h1>
      </div>

      <div class="container">
        <?php foreach ($grouped as $month => $events): ?>
          <h2 class="month-title"><?= htmlspecialchars($month) ?></h2>
          <?php foreach ($events as $event): ?>
            <div class="movie-card">
              <div class="poster">
                <?php if (!empty($event['poster'])): ?>
                  <img src="upload/<?= htmlspecialchars($event['poster']) ?>" alt="Poster">
                <?php else: ?>
                  <div class="no-poster">No Poster</div>
                <?php endif; ?>
              </div>

              <div class="info">
                <h3><?= htmlspecialchars($event['title']) ?></h3>
                <p><?= htmlspecialchars(substr($event['description'], 0, 100)) ?>...</p>
                <span class="time"><?= date("d M Y", strtotime($event['show_date'])) ?> | <?= date("H:i", strtotime($event['time_start'])) ?> - <?= date("H:i", strtotime($event['time_end'])) ?></span>
                <p><strong>Price:</strong> <?= number_format($event['price'], 2) ?> THB</p>

                <div class="actions">
                  <a href="edit_shows_ad.php?id=<?= $event['id'] ?>" class="btn">✏️ Edit</a>
                  <a href="delete_show.php?id=<?= $event['id'] ?>" class="btn delete" onclick="return confirm('Delete this movie?');">🗑 Delete</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
    </div>
</body>
</html>
