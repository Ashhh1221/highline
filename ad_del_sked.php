<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

$stmt = $dbconnection->prepare("DELETE FROM event WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin.php");
exit;