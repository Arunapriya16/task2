<?php
session_start();
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all posts from database
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Posts Table</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn { text-decoration: none; padding: 5px 10px; border-radius: 3px; }
        .edit { background-color: #2196F3; color: white; }
        .delete { background-color: #f44336; color: white; }
    </style>
</head>
<body>

    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <a href="create.php">Create New Post</a> | <a href="logout.php">Logout</a>

    <h3>Blog Posts Table</h3>

    <?php if (empty($posts)): ?>
        <p>No posts found in the database table.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= $post['id'] ?></td>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><?= htmlspecialchars($post['content']) ?></td>
                        <td><?= $post['created_at'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $post['id'] ?>" class="btn edit">Edit</a>
                            <a href="delete.php?id=<?= $post['id'] ?>" class="btn delete" onclick="return confirm('Delete this post?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>