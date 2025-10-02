<?php 

include 'db.php';

$id = $_GET['id'] ?? 0;

$stmt = $dbconnection->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if(!$event){
    die("Event not found");
}

if($_SERVER['REQUEST_METHOD']=== 'POST') {
    $date = $_POST['event_date'];
    $title = $POST['title'];
    $desc = $_POST['description'];
    $start = $_POST['time_start'];
    $end = $_POST['time_end'];

    $stmt = $dbconnection->prepare("UPDATE events SET event_date = ?, title = ?, description = ?, time_start = ?, time_end = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $date, $title, $desc, $start, $end, $id);
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
    <title>Edit schedule</title>
    <link rel="stylesheet" href="ad_edit_sked.css">
</head>
<body>
    <div class="main">
        <h1>Edit Event</h1>
        <form method ="POST">
            Date: <input type="date" name="event_date" vale="<?= $event['event_date'] ?>" required><br>
            Title: <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required><br>
            Description: <input name="description" value="<?= htmlspecialchars($event['description']) ?>" required><br>
            Start Time: <input type="time" name="time_start" value="<?= $event['time_start'] ?>" required><br>
            End Time: <input type="time" name="time_end" value="<?= $event['time_end'] ?>" required><br>
            <button type="submit">Update event</button>       
        </form>
    </div>
</body>
</html>