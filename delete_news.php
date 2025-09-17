<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "u7bkx8pwvemeg";
$password = "qredcpdgqd9j";
$dbname = "dbuwritkg0roeo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Delete query
    $sql = "DELETE FROM news WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?msg=Article+Deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: admin.php");
    exit();
}

$conn->close();
?>
