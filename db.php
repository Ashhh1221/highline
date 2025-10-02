<?php

$dbconnection = mysqli_connect('localhost','root','','highline_film');
if (!$dbconnection) {
    die("Connection failed: " . mysqli_connect_error());
} 

?>
