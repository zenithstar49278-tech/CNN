<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
session_start();
$conn = new mysqli("localhost", "u7bkx8pwvemeg", "qredcpdgqd9j", "dbuwritkg0roeo");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // For demo only

    $result = $conn->query("SELECT * FROM admins WHERE username='$username' AND password='$password'");
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
/* Background */
body {
    font-family: 'Segoe UI', sans-serif;
    background: radial-gradient(circle at top left, #2b1055, #1c0634);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    overflow: hidden;
}

/* Subtle animated glow */
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
}
@keyframes glowMove {
    to { transform: translate(50px, 50px); }
}

/* Login card */
.login-box {
    position: relative;
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
    border-radius: 14px;
    padding: 2rem;
    width: 340px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    color: white;
}

/* Title with animated underline */
.login-box h2 {
    text-align: center;
    font-weight: 600;
    position: relative;
    margin-bottom: 2rem;
}
.login-box h2::after {
    content: "";
    position: absolute;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #a855f7, #d946ef);
    left: 50%;
    transform: translateX(-50%);
    bottom: -8px;
    border-radius: 2px;
    animation: underlineGrow 0.8s ease-out forwards;
}
@keyframes underlineGrow {
    from { width: 0; }
    to { width: 40px; }
}

/* Labels */
.login-box label {
    font-weight: bold;
    display: block;
    margin-bottom: 0.4rem;
    font-size: 14px;
}

/* Inputs */
.login-box input {
    width: 100%;
    padding: 12px;
    margin-bottom: 1.2rem;
    border: none;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    background: rgba(255,255,255,0.15);
    color: white;
    transition: all 0.3s ease;
}
.login-box input:focus {
    box-shadow: 0 0 8px rgba(168,85,247,0.8);
    background: rgba(255,255,255,0.25);
}

/* Button */
.login-box button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(135deg, #a855f7, #d946ef);
    color: white;
    font-size: 16px;
    cursor: pointer;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}
.login-box button::before {
    content: "";
    position: absolute;
    top: 0; left: -50%;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,0.3);
    transform: skewX(-20deg);
    transition: all 0.5s ease;
}
.login-box button:hover::before {
    left: 150%;
}
.login-box button:hover {
    transform: scale(1.03);
}

/* Error message */
.error {
    color: #ffb4b4;
    text-align: center;
    margin-bottom: 1rem;
}
</style>
</head>
<body>
<div class="login-box">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
