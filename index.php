<?php
session_start();
require_once 'db.php';

// Fetch all posts from database safely
$query = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
</head>
<body>

<?php include_once 'header.php'; ?>

<h2>Blog Posts</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($post = mysqli_fetch_assoc($result)): ?>
        <article style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 10px;">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            
            <!-- Show Edit/Delete options if logged in -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="edit.php?id=<?= $post['id'] ?>">Edit</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    | <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>
<?php include_once 'header.php'; ?>
</body>
</html>