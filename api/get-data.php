//TODO : Write script to get information from the database



<?php

// test to see if php server can be reached and processes the request

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];
    $response = "You typed: " . $query;

    echo $response; // this is what JS will receive
}

?>
