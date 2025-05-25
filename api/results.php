<?php
session_start();

$articles = $_SESSION['articles'] ?? [];
$topic = $_SESSION['query_topic'] ?? '';

// Clear session after use (optional)
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results for "<?php echo htmlspecialchars($topic); ?>"</h2>

    <?php if (empty($articles)): ?>
        <p>No articles found.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Link</th>
            </tr>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo $article['article_id']; ?></td>
                    <td><?php echo htmlspecialchars($article['title']); ?></td>
                    <td><?php echo $article['published_date']; ?></td>
                    <td><a href="<?php echo $article['url']; ?>" target="_blank">View</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
