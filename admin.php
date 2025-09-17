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

// Fetch all news
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - CNN Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #3f0d7e, #2d006b);
            color: white;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(162, 0, 255, 0.7);
        }
        h1 {
            color: #fff;
            margin-bottom: 20px;
        }
        a.button {
            display: inline-block;
            background: #a200ff;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        a.button:hover {
            background: #7e00c4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid rgba(255,255,255,0.2);
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="add_news.php" class="button">Add News</a>
    <a href="logout.php" class="button">Logout</a>

    <h2>All News</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Headline</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit_news.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
                <a href="delete_news.php?id=<?php echo $row['id']; ?>" class="button" onclick="return confirm('Delete this news?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
<?php $conn->close(); ?>
