<?php
include 'db.php';

// Validate movie_id
$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;
if ($movie_id <= 0) {
    header("Location: adminpanel.php?error=invalid_id");
    exit;
}

// Fetch show info
$result = $dbconnection->query("SELECT * FROM shows WHERE id = $movie_id");
$show = $result->fetch_assoc();
if (!$show) {
    header("Location: adminpanel.php?error=not_found");
    exit;
}

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $show_date = $_POST['show_date'];
    $movie_start = $_POST['movie_start'];
    $start_time = $_POST['start_time'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $entry_drinks = $_POST['entry_drinks'];

    $stmt = $dbconnection->prepare("INSERT INTO tickets (movie_id, show_date, movie_start, start_time, price, quantity, entry_drinks) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdis", $movie_id, $show_date, $movie_start, $start_time, $price, $quantity, $entry_drinks);

    if ($stmt->execute()) {
        $success = "Ticket added successfully!";
    } else {
        $error = "Error adding ticket: " . $dbconnection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Ticket - <?= htmlspecialchars($show['title']) ?></title>
<link rel="stylesheet" href="edit_shows_ad.css">
<style>
/* Extend your edit_shows_ad.css style for ticket form */
.ticket-container {
    background: #e0e5ec;
    padding: 30px 40px;
    border-radius: 20px;
    box-shadow: 
        9px 9px 16px #b8b9be,
        -9px -9px 16px #ffffff;
    max-width: 500px;
    margin: 50px auto;
}

.ticket-container h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #2c2c2c;
}

.ticket-container form label {
    display: block;
    font-weight: 600;
    margin: 15px 0 6px;
    color: #555;
}

.ticket-container form input[type="text"],
.ticket-container form input[type="date"],
.ticket-container form input[type="time"],
.ticket-container form input[type="number"] {
    width: 100%;
    padding: 12px 15px;
    border: none;
    outline: none;
    border-radius: 12px;
    background: #e0e5ec;
    box-shadow: 
        inset 3px 3px 6px #b8b9be,
        inset -3px -3px 6px #ffffff;
    font-size: 0.95rem;
    color: #333;
    transition: 0.2s ease-in-out;
}

.ticket-container form input:focus {
    box-shadow: 
        inset 2px 2px 5px #b8b9be,
        inset -2px -2px 5px #ffffff,
        0 0 0 2px #8eb5f0;
}

.ticket-container form button {
    display: inline-block;
    margin-top: 20px;
    margin-right: 10px;
    padding: 12px 20px;
    border-radius: 15px;
    border: none;
    background: #e0e5ec;
    color: #333;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.95rem;
    box-shadow: 
        6px 6px 12px #b8b9be,
        -6px -6px 12px #ffffff;
    transition: all 0.2s ease-in-out;
}

.ticket-container form button:hover {
    box-shadow: 
        inset 3px 3px 6px #b8b9be,
        inset -3px -3px 6px #ffffff;
}

.ticket-container form button:active {
    box-shadow: 
        inset 1px 1px 2px #b8b9be,
        inset -1px -1px 2px #ffffff;
}

.error {
    background: #ffe5e5;
    color: #d9534f;
    padding: 12px;
    border-radius: 12px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    text-align: center;
    box-shadow: 
        inset 3px 3px 6px #b8b9be,
        inset -3px -3px 6px #ffffff;
}

.success {
    background: #e5ffe5;
    color: #28a745;
    padding: 12px;
    border-radius: 12px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    text-align: center;
    box-shadow: 
        inset 3px 3px 6px #b8b9be,
        inset -3px -3px 6px #ffffff;
}
</style>
</head>
<body>
<div class="ticket-container">
    <h1>Add Ticket for "<?= htmlspecialchars($show['title']) ?>"</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Show Date</label>
        <input type="date" name="show_date" required>

        <label>Movie Start Time</label>
        <input type="time" name="movie_start" required>

        <label>Show Start Time</label>
        <input type="time" name="start_time" required>

        <label>Price (THB)</label>
        <input type="number" name="price" step="0.01" required>

        <label>Quantity</label>
        <input type="number" name="quantity" required>

        <label>Entry Drinks</label>
        <input type="text" name="entry_drinks" placeholder="Optional">

        <button type="submit">➕ Add Ticket</button>
        <button type="button" onclick="history.back()">⬅ Back</button>
    </form>
</div>
</body>
</html>
