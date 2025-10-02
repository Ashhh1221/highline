<?php
require 'db.php'; // Connect to DB only once

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $fname = htmlspecialchars(trim($_POST['fname'] ?? ''));
    $lname = htmlspecialchars(trim($_POST['lname'] ?? ''));
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));

    if ($fname && $lname && $email && $phone) {
        $stmt = $conn->prepare("INSERT INTO drink_registration (fname, lname, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $lname, $email, $phone);

        if ($stmt->execute()) {
            echo "✅ Registration successful! Show this screen at the event.";
        } else {
            echo "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Please fill in all required fields correctly.";
    }

    $conn->close();
}
?>