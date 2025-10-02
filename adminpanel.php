<?php
include 'db.php';

$result = $dbconnection->query("SELECT * FROM shows ORDER BY show_date ASC");
$first_show = $dbconnection->query("SELECT id FROM shows ORDER BY show_date ASC LIMIT 1")->fetch_assoc();
$first_show_id = $first_show ? $first_show['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Panel - Shows</title>
  <link rel="stylesheet" href="adminpanel.css" />
</head>
<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="adminpanel.php" class="active">Manage Shows</a>
    <a href="add.php">Add New Show</a>
    <a href="admin_movies.php?id=<?= $first_show_id ?>">Edit Show</a>
    <a href="ad_schedule.php">Movie Schedule</a>
  </div>
  <div class="main">
    <h1>Manage Shows</h1>
    <a href="add.php" class="add-btn">+ Add New Show</a>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Show Date</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['id']) ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['show_date']) ?></td>
          <td><?= htmlspecialchars($row['time_start']) ?></td>
          <td><?= htmlspecialchars($row['time_end']) ?></td>
          <td class="action-links">
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this show?');">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
