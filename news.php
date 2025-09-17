<?php
session_start();

// Database connection
$host = "localhost";
$dbname = "dbuwritkg0roeo";
$dbuser = "u7bkx8pwvemeg";
$dbpass = "qredcpdgqd9j";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch news from database
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNN Project - News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2b1055, #7597de);
            margin: 0;
            padding: 0;
            color: white;
        }
        header {
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
        }
        .news-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .news-card h2 {
            margin-top: 0;
            color: #ffd700;
        }
        .news-card small {
            display: block;
            margin-bottom: 10px;
            color: #ccc;
        }
    </style>
</head>
<body>
<header>
    Latest News
</header>
<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="news-card">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <small><?php echo htmlspecialchars($row['category']); ?> | <?php echo $row['created_at']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No news articles found.</p>
    <?php endif; ?>
</div>
</body>
</html>
<?php $conn->close(); ?>
