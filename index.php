<?php
session_start();

// Database connection using PDO
try {
    $pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all posts from the database
$stmt = $pdo->query("SELECT * FROM posts ORDER BY id DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
</head>
<body>
    <?php 
    if (file_exists('header.php')) {
        include_once 'header.php';
    }
    ?>

    <h2>Welcome to the Blog</h2>

    <?php if (isset($_SESSION['username'])): ?>
        <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> | <a href="create.php">Create New Post</a> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to create posts.</p>
    <?php endif; ?>

    <hr>

    <h3>All Posts</h3>

    <?php if (empty($posts)): ?>
        <p>No posts yet. Be the first to write one!</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px;">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</body>
</html>