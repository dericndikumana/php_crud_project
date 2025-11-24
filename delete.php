<?php
session_start();
include "connect.php";

// Make sure user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Check if id is provided
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Delete student
$delete_query = mysqli_query($connect, "DELETE FROM students WHERE id='$id'");

if ($delete_query) {
    $_SESSION['message'] = "Student well deleted";
} else {
    $_SESSION['message'] = "Error deleting student";
}

header("Location: dashboard.php");
exit;
?>
