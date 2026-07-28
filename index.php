<?php
// 1. Database Connection
require_once 'db.php'; 

// 2. Setup Pagination Variables
$limit = 2; // Set to 2 posts per page to easily test pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// 3. Get Search Keyword
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// 4. Fetch Posts and Count Total Rows
if (!empty($search)) {
    $searchTerm = "%" . $search . "%";

    // Count matching rows for search
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM posts WHERE title LIKE ? OR content LIKE ?");
    $countStmt->bind_param("ss", $searchTerm, $searchTerm);
    $countStmt->execute();
    $totalRows = $countStmt->get_result()->fetch_assoc()['total'];

    // Fetch paginated search results
    $stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $searchTerm, $searchTerm, $limit, $offset);
    $stmt->execute();
    $posts = $stmt->get_result();
} else {
    // Count total rows overall
    $totalRows = $conn->query("SELECT COUNT(*) AS total FROM posts")->fetch_assoc()['total'];

    // Fetch paginated rows overall
    $stmt = $conn->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $posts = $stmt->get_result();
}

$totalPages = ceil($totalRows / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog - Task 3</title>
    <!-- Bootstrap CSS for modern UI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Blog Posts</h2>

    <!-- Search Form -->
    <form action="index.php" method="GET" class="mb-4 d-flex gap-2">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Search by title or content..." 
            value="<?php echo htmlspecialchars($search); ?>"
        >
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </form>

    <!-- Posts List -->
    <div class="row">
        <?php if ($posts && $posts->num_rows > 0): ?>
            <?php while($row = $posts->fetch_assoc()): ?>
                <div class="col-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['content']); ?></p>
                            <small class="text-muted">Posted on: <?php echo $row['created_at']; ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-muted">No posts found.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination Buttons -->
    <?php if ($totalPages > 1): ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="index.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
</body>
</html>