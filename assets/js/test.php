<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? 'Guest';
    echo "Hello, " . htmlspecialchars($name) . "!";
} else {
    echo "Please submit the form.";
}
?>
