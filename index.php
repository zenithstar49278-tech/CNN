<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNN Project - Home</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2b1055, #7597de);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
            backdrop-filter: blur(10px);
            text-align: center;
            width: 350px;
        }
        .container h2 {
            color: #fff;
            margin-bottom: 20px;
        }
        .underline {
            width: 40px;
            height: 3px;
            background: #a64cf5;
            margin: 0 auto 30px;
            border-radius: 5px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: linear-gradient(90deg, #a64cf5, #6a11cb);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }
        .btn:hover {
            background: linear-gradient(90deg, #6a11cb, #a64cf5);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($isLoggedIn): ?>
            <h2>Welcome, <?php echo htmlspecialchars($username); ?> 👋</h2>
        <?php else: ?>
            <h2>Welcome to CNN Project</h2>
        <?php endif; ?>
        
        <div class="underline"></div>
        
        <?php if ($isLoggedIn): ?>
            <a href="dashboard.php" class="btn">Go to Dashboard</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn">Login</a>
            <a href="signup.php" class="btn">Sign Up</a>
        <?php endif; ?>
        <a href="news.php" class="btn">View News</a>
    </div>
</body>
</html>
