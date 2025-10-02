<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $dbconnection->real_escape_string($_POST['title']);
    $show_date = $_POST['show_date'];
    $description = $dbconnection->real_escape_string($_POST['description']);
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $price = $_POST['price'];

    $sql = "INSERT INTO shows (title, show_date, description, time_start, time_end, price)
            VALUES ('$title', '$show_date', '$description', '$time_start', '$time_end', '$price')";
    
    if ($dbconnection->query($sql)) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error: " . $dbconnection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add New Show</title>
  <link rel="stylesheet" href="add.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Inter&family=Poppins&display=swap" rel="stylesheet" />
</head>
<body>
  <h1>Add New Show</h1>
  <?php if (!empty($error)): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post">
    <label>Title:<br>
      <input type="text" name="title" required>
    </label><br><br>
    
    <label>Show Date:<br>
      <input type="date" name="show_date" required>
    </label><br><br>
    
    <label>Description:<br>
      <textarea name="description" rows="5" cols="30" required></textarea>
    </label><br><br>
    
    <label>Start Time:<br>
      <input type="time" name="time_start" required>
    </label><br><br>
    
    <label>End Time:<br>
      <input type="time" name="time_end" required>
    </label><br><br>
    
    <button type="submit">Add Show</button>
  </form>
  <p><a href="adminpanel.php">Back to Admin Panel</a></p>
</body>
</html>
