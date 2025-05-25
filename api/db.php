<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "news_data";

echo "db.php called"

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;
?>
