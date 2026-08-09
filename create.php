<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=blog;charset=utf8mb4", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->execute([$title, $content]);
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Create Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="content" placeholder="Content" required></textarea><br><br>
        <button type="submit">Publish</button>
    </form>
</body>
</html>