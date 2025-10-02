<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id) {
    $dbconnection->query("DELETE FROM shows WHERE id = $id");
}
header("Location: adminpanel.php");
exit;
