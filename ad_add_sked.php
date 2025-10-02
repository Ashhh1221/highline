<?php 

include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $date = $_POST['event_date'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $start = $_POST['time_start'];
    $end = $_POST['time_end'];
    $stmt = $dbconnection->prepare("INSERT INTO events (event_date, title, description, time_start, time_end) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $date, $title, $desc, $start, $end);
    $stmt->execute();

    header("Location: ad_schedule.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule</title>
    <link rel="stylesheet" href="ad_add_sked.css">
</head>
<body>
    <div class="head">
        <h1>Add Event</h1>
        <form method="POST">
         Date: <input type="date" name="event_date" required><br>
         Title: <input type="text" name="title" required><br>
         Description: <input name="description" required></input><br>
         Start Time: <input type="time" name="time_start" required><br>
         End Time: <input type="time" name="time_end" required><br>
         <button type="submit">Add event</button>
        </form>
    </div>
</body>
</html>