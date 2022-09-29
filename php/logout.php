<?php
session_start();
include "config.php";

$query = "UPDATE users SET status = 'Offline Now' WHERE id = '{$_SESSION['user_id']}'";
$result = mysqli_query($conn, $query);
session_unset();
header('location: ../login.php');