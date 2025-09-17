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

$admin_id = $_SESSION['admin']['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['dp'])) {
    $file = $_FILES['dp'];

    // Check if file is an image
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo "Only JPG and PNG files are allowed.";
        exit();
    }

    // Create uploads directory if not exists
    $uploadDir = "uploads/dp/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Rename file to avoid duplicates
    $fileName = "dp_" . $admin_id . "_" . time() . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Save file path in database
        $sql = "UPDATE admins SET profile_pic = '$filePath' WHERE id = $admin_id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['admin']['profile_pic'] = $filePath;
            header("Location: admin.php?msg=Profile+picture+updated");
            exit();
        } else {
            echo "Database update failed: " . $conn->error;
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>

<!-- Simple HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Picture</title>
</head>
<body>
    <h2>Upload Your Display Picture</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="dp" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
