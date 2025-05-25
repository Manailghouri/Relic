<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_data"; // ✅ Change this to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Get SQL query from the form
$query = $_POST["query"] ?? null;

if (!$query) {
    die("❌ No SQL query provided.");
}

// Run the query
$result = $conn->query($query);

if ($result === true) {
    echo "✅ Query executed successfully.";
} elseif ($result) {
    echo "<h3>✅ Query Results:</h3><table border='1'><tr>";

    // Print table headers
    while ($field = $result->fetch_field()) {
        echo "<th>{$field->name}</th>";
    }
    echo "</tr>";

    // Print rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
