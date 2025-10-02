<?php
include 'db.php';

// ✅ Validate show id safely
if (!isset($_GET['id']) || intval($_GET['id']) <= 0) {
    header("Location: admin.php?error=invalid_id");
    exit;
}

$id = intval($_GET['id']);

// ✅ Fetch show
$result = $dbconnection->query("SELECT * FROM shows WHERE id = $id");
$show = $result->fetch_assoc();

if (!$show) {
    header("Location: admin.php?error=not_found");
    exit;
}

// ✅ Fetch tickets for this show
$tickets_result = $dbconnection->query("SELECT * FROM tickets WHERE movie_id = $id ORDER BY show_date ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin – <?= htmlspecialchars($show['title']) ?> </title>
  <link rel="stylesheet" href="admin_edit_show.css" />
</head>
<body>
  <div class="admin-container">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Admin Panel</h2>
      <a href="adminpanel.php">Manage Shows</a>
      <a href="add.php">Add New Show</a>
      <a href="#" class="active">Edit Show</a>
    </div>

    <!-- Main Content -->
    <main class="content">

      <h1><?= htmlspecialchars($show['title']) ?> – Admin View</h1>

      <div class="show-info">
        <div class="show-poster">
          <img src="upload/<?= htmlspecialchars($show['poster'] ?? '') ?>" alt="<?= htmlspecialchars($show['title']) ?> poster" />
        </div>

        <div class="show-details">
          <h2><?= htmlspecialchars($show['title'])?></h2>
          <p><strong>Date:</strong><?= date("d M Y",strtotime($show['show_date']))?></p>
          <p><strong>Time:</strong><?= date("H:i", strtotime($show['time_start']))?></p>
          <p><strong>Price:</strong><?= number_format($show['price'], 2) ?> THB</p>
          <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($show['description'])) ?></p>
        </div>

      </div>

      <div class="admin-actions">
       <a href="edit_shows_ad.php?id=<?= $show['id'] ?>" class="btn">✏️ Edit Show</a>
       <a href="delete_show.php?id=<?= $show['id'] ?>" class="btn delete" onclick="return confirm('Are you sure you want to delete this show?');">🗑 Delete Show</a>
      </div>

      <h2>Tickets</h2>
      <a href="add_ticket.php?movie_id=<?= $show['id'] ?>" class="btn">➕ Add Ticket</a>

      <?php if ($tickets_result->num_rows > 0): ?>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Entry Drinks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($ticket = $tickets_result->fetch_assoc()): ?>
              <tr>
                <td><?= $ticket['id'] ?></td>
                <td><?= htmlspecialchars($ticket['show_date']) ?></td>
                <td><?= number_format($ticket['price'], 2) ?> THB</td>
                <td><?= $ticket['quantity'] ?></td>
                <td><?= !empty($ticket['entry_drinks']) ? htmlspecialchars($ticket['entry_drinks']) : 'None' ?></td>
                <td>
                  <a href="edit_ticket.php?id=<?= $ticket['id'] ?>" class="btn">✏️ Edit</a>
                  <a href="delete_ticket.php?id=<?= $ticket['id'] ?>" class="btn delete" onclick="return confirm('Delete this ticket?');">🗑 Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No tickets available for this show.</p>
      <?php endif; ?>
    </main>
  </div>
</body>
</html>
