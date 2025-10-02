<?php
include 'db.php';

if (!isset($_GET['id']) || intval($_GET['id']) <= 0) {
    header("Location: adminpanel.php?error=invalid_id");
    exit;
}

$id = intval($_GET['id']);
$result = $dbconnection->query("SELECT * FROM shows WHERE id = $id");
$show = $result->fetch_assoc();
if (!$show) header("Location: adminpanel.php?error=not_found");

$error = '';
$ticket_error = '';

// -------------------- Delete Ticket --------------------
if (isset($_GET['delete_ticket'])) {
    $delete_id = intval($_GET['delete_ticket']);
    $dbconnection->query("DELETE FROM tickets WHERE id=$delete_id AND movie_id=$id");
    header("Location: edit_shows_ad.php?id=$id&success=ticket_deleted");
    exit;
}

// -------------------- Fetch Ticket to Edit --------------------
$edit_ticket_data = null;
if (isset($_GET['edit_ticket'])) {
    $edit_ticket_id = intval($_GET['edit_ticket']);
    $edit_result = $dbconnection->query("SELECT * FROM tickets WHERE id=$edit_ticket_id AND movie_id=$id");
    $edit_ticket_data = $edit_result->fetch_assoc();
}

// -------------------- Handle Show Update --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_show'])) {
    $title = $dbconnection->real_escape_string($_POST['title']);
    $description = $dbconnection->real_escape_string($_POST['description']);
    $show_date = $_POST['show_date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $price = $_POST['price'];
    $poster = $show['poster'];
    $background = $show['background'];

    if (!empty($_FILES['poster']['name'])) {
        $uploadFile = "upload/" . basename($_FILES["poster"]["name"]);
        if (move_uploaded_file($_FILES["poster"]["tmp_name"], $uploadFile)) $poster = $_FILES["poster"]["name"];
        else $error = "Poster upload error.";
    }

    if (!empty($_FILES['background']['name'])) {
        $uploadFile = "upload/" . basename($_FILES["background"]["name"]);
        if (move_uploaded_file($_FILES["background"]["tmp_name"], $uploadFile)) $background = $_FILES["background"]["name"];
        else $error = "Background upload error.";
    }

    if (empty($error)) {
        $sql = "UPDATE shows SET title='$title', description='$description', show_date='$show_date',
                time_start='$time_start', time_end='$time_end', price=$price, poster='$poster', background='$background'
                WHERE id=$id";
        if ($dbconnection->query($sql) === TRUE) header("Location: edit_shows_ad.php?id=$id&success=show_updated");
        else $error = "Update error: " . $dbconnection->error;
    }
}

// -------------------- Handle Ticket Add --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_ticket'])) {
    $ticket_date = $_POST['ticket_date'];
    $ticket_price = $_POST['ticket_price'];
    $ticket_quantity = $_POST['ticket_quantity'];
    $entry_drinks = $dbconnection->real_escape_string($_POST['entry_drinks']);
    if (empty($ticket_date) || empty($ticket_price) || empty($ticket_quantity)) $ticket_error = "All fields required.";
    else {
        $sql = "INSERT INTO tickets (movie_id, show_date, price, quantity, entry_drinks)
                VALUES ($id,'$ticket_date',$ticket_price,$ticket_quantity,'$entry_drinks')";
        if ($dbconnection->query($sql) === TRUE) header("Location: edit_shows_ad.php?id=$id&success=ticket_added");
        else $ticket_error = "Ticket add error: " . $dbconnection->error;
    }
}

// -------------------- Handle Ticket Update --------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_ticket'])) {
    $ticket_id = intval($_POST['update_ticket']);
    $ticket_date = $_POST['ticket_date'];
    $ticket_price = $_POST['ticket_price'];
    $ticket_quantity = $_POST['ticket_quantity'];
    $entry_drinks = $dbconnection->real_escape_string($_POST['entry_drinks']);

    $sql = "UPDATE tickets SET show_date='$ticket_date', price=$ticket_price, quantity=$ticket_quantity, entry_drinks='$entry_drinks'
            WHERE id=$ticket_id AND movie_id=$id";
    if ($dbconnection->query($sql) === TRUE) {
        header("Location: edit_shows_ad.php?id=$id&success=ticket_updated");
        exit;
    } else {
        $ticket_error = "Ticket update error: " . $dbconnection->error;
    }
}

$tickets_result = $dbconnection->query("SELECT * FROM tickets WHERE movie_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Show - <?= htmlspecialchars($show['title']) ?></title>
<link rel="stylesheet" href="edit_shows_ad.css">
</head>
<body>
<div class="dashboard">

  <!-- Main Content -->
  <div class="main-content">
    <header>
      <h1>Edit Show: <?= htmlspecialchars($show['title']) ?></h1>
    </header>

    <!-- Show Edit Form -->
    <div class="edit-container">
      <?php if ($error): ?><p class="error"><?= htmlspecialchars($error) ?></p><?php endif; ?>

      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_show" value="1">
        <label>Title</label>
        <input type="text" name="title" value="<?= htmlspecialchars($show['title']) ?>" required>

        <label>Show Date</label>
        <input type="date" name="show_date" value="<?= htmlspecialchars($show['show_date']) ?>" required>

        <label>Description</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($show['description']) ?></textarea>

        <label>Start Time</label>
        <input type="time" name="time_start" value="<?= htmlspecialchars($show['time_start']) ?>" required>

        <label>End Time</label>
        <input type="time" name="time_end" value="<?= htmlspecialchars($show['time_end']) ?>" required>

        <label>Price (THB)</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($show['price']) ?>" required>

        <label>Poster</label>
        <input type="file" name="poster" accept="image/*">
        <?php if (!empty($show['poster'])): ?>
          <p>Current: <img src="upload/<?= htmlspecialchars($show['poster']) ?>" class="poster-preview"></p>
        <?php endif; ?>

        <button type="submit" class="btn">Update Show</button>
        <button type="button" onclick="history.back()" class="btn cancel-btn">⬅ Back</button>
      </form>
    </div>

    <!-- Ticket Section -->
    <div class="edit-container">
      <h2>Manage Tickets</h2>
      <?php if ($ticket_error): ?><p class="error"><?= htmlspecialchars($ticket_error) ?></p><?php endif; ?>

      <?php if ($edit_ticket_data): ?>
      <!-- Edit Ticket Form -->
      <form method="post">
        <input type="hidden" name="update_ticket" value="<?= $edit_ticket_data['id'] ?>">
        <label>Show Date</label>
        <input type="date" name="ticket_date" value="<?= $edit_ticket_data['show_date'] ?>" required>

        <label>Price (THB)</label>
        <input type="number" name="ticket_price" step="0.01" value="<?= $edit_ticket_data['price'] ?>" required>

        <label>Quantity</label>
        <input type="number" name="ticket_quantity" min="1" value="<?= $edit_ticket_data['quantity'] ?>" required>

        <label>Entry Drinks</label>
        <input type="text" name="entry_drinks" value="<?= htmlspecialchars($edit_ticket_data['entry_drinks']) ?>">

        <button type="submit" class="btn">Update Ticket</button>
        <button type="button" onclick="window.location='edit_shows_ad.php?id=<?= $id ?>'" class="btn cancel-btn">⬅ Cancel</button>
      </form>
      <?php else: ?>
      <!-- Add Ticket Form -->
      <form method="post">
        <input type="hidden" name="add_ticket" value="1">
        <label>Show Date</label>
        <input type="date" name="ticket_date" required>

        <label>Price (THB)</label>
        <input type="number" name="ticket_price" step="0.01" required>

        <label>Quantity</label>
        <input type="number" name="ticket_quantity" min="1" required>

        <label>Entry Drinks</label>
        <input type="text" name="entry_drinks" placeholder="e.g. Beer, Soft Drink">

        <button type="submit" class="btn">Add Ticket</button>
      </form>
      <?php endif; ?>

      <!-- Existing Tickets -->
      <h3 style="margin-top:20px;">Existing Tickets</h3>
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
            <td><?= number_format($ticket['price'],2) ?> THB</td>
            <td><?= $ticket['quantity'] ?></td>
            <td><?= htmlspecialchars($ticket['entry_drinks']) ?></td>
            <td>
              <a href="edit_shows_ad.php?id=<?= $id ?>&edit_ticket=<?= $ticket['id'] ?>" class="btn">Edit</a>
              <a href="edit_shows_ad.php?id=<?= $id ?>&delete_ticket=<?= $ticket['id'] ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <?php else: ?>
        <p>No tickets found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>
