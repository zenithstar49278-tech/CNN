<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
/* Background */
body {
    font-family: 'Segoe UI', sans-serif;
    background: radial-gradient(circle at top left, #2b1055, #1c0634);
    height: 100vh;
    margin: 0;
    overflow-x: hidden;
}

/* Glowing animated background */
body::before {
    content: "";
    position: absolute;
    width: 400px;
    height: 400px;
    background: #8a2be2;
    border-radius: 50%;
    filter: blur(200px);
    top: -100px;
    left: -100px;
    animation: glowMove 8s infinite alternate ease-in-out;
    z-index: -1;
}
@keyframes glowMove {
    to { transform: translate(50px, 50px); }
}

/* Top Navbar */
.navbar {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    color: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.navbar h1 {
    font-size: 1.5rem;
    font-weight: 600;
}
.navbar a {
    color: white;
    text-decoration: none;
    padding: 8px 14px;
    background: linear-gradient(135deg, #a855f7, #d946ef);
    border-radius: 6px;
    transition: all 0.3s ease;
    font-weight: 500;
}
.navbar a:hover {
    transform: scale(1.05);
}

/* Dashboard content */
.container {
    padding: 2rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
}

/* Glass cards */
.card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 1.5rem;
    color: white;
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}

/* Card title */
.card h3 {
    margin-top: 0;
    font-size: 1.2rem;
    border-bottom: 2px solid transparent;
    border-image: linear-gradient(90deg, #a855f7, #d946ef) 1;
    padding-bottom: 6px;
}

/* Stats number */
.card p {
    font-size: 1.8rem;
    font-weight: bold;
    margin: 0.5rem 0 0;
}

/* Buttons inside cards */
.card a {
    display: inline-block;
    margin-top: 1rem;
    padding: 8px 12px;
    background: linear-gradient(135deg, #a855f7, #d946ef);
    color: white;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
}
.card a:hover {
    transform: scale(1.05);
}
</style>
</head>
<body>
    <div class="navbar">
        <h1>Welcome, <?php echo $_SESSION['admin']; ?></h1>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="card">
            <h3>Articles</h3>
            <p>120</p>
            <a href="manage_articles.php">Manage</a>
        </div>
        <div class="card">
            <h3>Users</h3>
            <p>540</p>
            <a href="manage_users.php">Manage</a>
        </div>
        <div class="card">
            <h3>Comments</h3>
            <p>230</p>
            <a href="manage_comments.php">Manage</a>
        </div>
        <div class="card">
            <h3>Settings</h3>
            <p>⚙️</p>
            <a href="settings.php">Edit</a>
        </div>
    </div>
</body>
</html>
