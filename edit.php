<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) {
    die("Invalid show ID.");
}

$result = $dbconnection->query("SELECT * FROM shows WHERE id = $id");
$show = $result->fetch_assoc();
if (!$show) {
    die("Show not found.");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $dbconnection->real_escape_string($_POST['title']);
    $show_date = $_POST['show_date'];
    $description = $dbconnection->real_escape_string($_POST['description']);
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $price = $_POST['price'];

    $sql = "UPDATE shows SET
            title = '$title',
            show_date = '$show_date',
            description = '$description',
            time_start = '$time_start',
            time_end = '$time_end',
            price = '$price'
            WHERE id = $id";

    if ($dbconnection->query($sql)) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error updating show: " . $dbconnection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Show</title>
  <link rel="stylesheet" href="edit.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Inter&family=Poppins&display=swap" rel="stylesheet" />
</head>
<body>
  <h1>Edit Show</h1>
  <?php if ($error): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Title:<br>
      <input type="text" name="title" value="<?= htmlspecialchars($show['title']) ?>" required>
    </label><br><br>

    <label>Show Date:<br>
      <input type="date" name="show_date" value="<?= htmlspecialchars($show['show_date']) ?>" required>
    </label><br><br>

    <label>Description:<br>
      <textarea name="description" rows="5" cols="30" required><?= htmlspecialchars($show['description']) ?></textarea>
    </label><br><br>

    <label>Start Time:<br>
      <input type="time" name="time_start" value="<?= htmlspecialchars($show['time_start']) ?>" required>
    </label><br><br>

    <label>End Time:<br>
      <input type="time" name="time_end" value="<?= htmlspecialchars($show['time_end']) ?>" required>
    </label><br><br>


    <button type="submit">Update Show</button>
  </form>
  <p><a href="adminpanel.php">Back to Admin Panel</a></p>
</body>
</html>
