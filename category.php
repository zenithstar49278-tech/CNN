<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "u7bkx8pwvemeg", "qredcpdgqd9j", "dbuwritkg0roeo");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $conn->query("INSERT INTO categories (name) VALUES ('$name')");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Category</title></head>
<body>
<h2>Add New Category</h2>
<form method="POST">
    <label>Category Name:</label><br>
    <input type="text" name="name" required><br><br>
    <button type="submit">Add Category</button>
</form>
</body>
</html>

