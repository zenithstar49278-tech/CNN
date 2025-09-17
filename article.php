<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "u7bkx8pwvemeg", "qredcpdgqd9j", "dbuwritkg0roeo");

$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    // Handle thumbnail upload
    $thumbnail = $_FILES['thumbnail']['name'];
    $target = "../images/" . basename($thumbnail);
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target);

    $conn->query("INSERT INTO articles (title, content, thumbnail, category_id) 
                  VALUES ('$title', '$content', '$thumbnail', $category_id)");
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Article</title></head>
<body>
<h2>Add New Article</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>
    <label>Content:</label><br>
    <textarea name="content" required></textarea><br>
    <label>Category:</label><br>
    <select name="category_id" required>
        <?php while($cat = $categories->fetch_assoc()) { ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php } ?>
    </select><br>
    <label>Thumbnail:</label><br>
    <input type="file" name="thumbnail" required><br><br>
    <button type="submit">Add Article</button>
</form>
</body>
</html>
