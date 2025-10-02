<?php 

include 'db.php';

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $dbconnection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ad_schedule.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sail&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
     <h1>Manage Events</h1>
     <a href="ad_add_sked.php">Add Events</a>
     <table border ="1" cellpadding= "10">
         <tr>
             <th>ID</th>
             <th>Date</th>
             <th>Title</th>
             <th>Description</th>
             <th>Start</th>
             <th>End</th>
             <th>Actions</th>
         </tr>
         <?php while($row=$result->fetch_assoc()): ?>
             <tr>
                 <td><?= $row['id']?></td>
                 <td><?= $row['event_date']?></td>
                 <td><?= htmlspecialchars($row['title'])?></td>
                 <td><?= htmlspecialchars($row['description'])?></td>
                 <td><?= $row['time_start']?></td>
                 <td><?= $row['time_end']?></td>
                 <td>
                     <a href="ad_edit_sked.php?id=<?= $row['id'] ?>">Edit</a>
                     <a href="ad_del_sked.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                 </td>
             </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>