<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_data"; // 🔁 Change this

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get inputs
$topic = $_POST["topic"] ?? '';
$start_date = $_POST["start_date"] ?? '';
$end_date = $_POST["end_date"] ?? '';

// Validate input
if (!$topic || !$start_date || !$end_date) {
    die("❌ Please provide topic and date range.");
}

// Prepare SQL query
$sql = "
    SELECT article_id, title, published_date, url
    FROM Articles
    WHERE (title LIKE ? OR content LIKE ?)
    AND published_date BETWEEN ? AND ?
    ORDER BY published_date DESC
";

$stmt = $conn->prepare($sql);
$like_topic = "%" . $topic . "%";
$stmt->bind_param("ssss", $like_topic, $like_topic, $start_date, $end_date);

// Execute and handle results
if (!$stmt->execute()) {
    die("❌ Query failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h3>🔍 Found " . $result->num_rows . " article(s):</h3>";
    echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Date</th><th>Link</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['article_id']}</td>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>{$row['published_date']}</td>";
        echo "<td><a href='{$row['url']}' target='_blank'>View</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "❌ No articles found.";
}

$stmt->close();
$conn->close();
?>
