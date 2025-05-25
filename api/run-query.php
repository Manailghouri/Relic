<?php
session_start(); // needed to store results

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_data"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get inputs
$topic = $_POST["topic"] ?? '';
$start_date = $_POST["start_date"] ?? '';
$end_date = $_POST["end_date"] ?? '';

if (!$topic || !$start_date || !$end_date) {
    die("❌ Missing inputs.");
}

$sql = "
    SELECT article_id, title, published_date, url
    FROM Articles
    WHERE (title LIKE ? OR content LIKE ?)
    AND published_date BETWEEN ? AND ?
    ORDER BY published_date DESC
";

$stmt = $conn->prepare($sql);
$like_topic = "%$topic%";
$stmt->bind_param("ssss", $like_topic, $like_topic, $start_date, $end_date);

if (!$stmt->execute()) {
    die("❌ Query failed: " . $stmt->error);
}

$result = $stmt->get_result();
$articles = [];

while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

$stmt->close();
$conn->close();

// Store results in session
$_SESSION['articles'] = $articles;
$_SESSION['query_topic'] = $topic;

// Redirect to result page
header("Location: results.php");
exit();
