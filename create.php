<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Create Post</title></head>
<body>
    <h2>Create New Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Post Title" required style="width: 300px;"><br><br>
        <textarea name="content" placeholder="Post Content" rows="5" cols="40" required></textarea><br><br>
        <button type="submit">Publish</button>
    </form>
    <br><a href="index.php">Back to Dashboard</a>
</body>
</html>