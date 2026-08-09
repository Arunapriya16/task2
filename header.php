<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav style="background: #f4f4f4; padding: 12px; margin-bottom: 20px; font-family: sans-serif;">
    <a href="index.php" style="margin-right: 15px; font-weight: bold; text-decoration: none;">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'editor'])): ?>
            <a href="create.php" style="margin-right: 15px; font-weight: bold; text-decoration: none;">Create Post</a>
        <?php endif; ?>
        <span style="float: right;">
            Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> (<?= htmlspecialchars($_SESSION['role'] ?? 'user') ?>) | 
            <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
        </span>
    <?php else: ?>
        <a href="login.php" style="margin-right: 15px; font-weight: bold; text-decoration: none;">Login</a>
        <a href="register.php" style="font-weight: bold; text-decoration: none;">Register</a>
    <?php endif; ?>
</nav>