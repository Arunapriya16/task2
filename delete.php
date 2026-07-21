<?php
session_start();
require 'db.php';

if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: index.php");
exit;
?>