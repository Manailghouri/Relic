//TODO : Write script to get information from the database



<?php
    // dummytext.php
    // connect to database using db.php

    header('Content-Type: text/plain');
    echo "This is some dummy text from the PHP script!";

    // accept a get request (for an MVP, allow the user to enter custom queries)
    // run that query on the db
    // return the query results


    // get request content
    $query = $_POST['query'] ?? null;

    if (!$query) {
        echo json_encode(["status" => "error", "message" => "No query provided"]);
        exit();
    }

    // --- Run the query ---
    $result = $conn->query($query);

    if (!$result) {
        echo json_encode(["status" => "error", "message" => $conn->error]);
        exit();
    }

    // --- Return results ---
    if ($result === true) {
        // For queries like INSERT/UPDATE/DELETE
        echo json_encode(["status" => "success", "message" => "Query executed successfully"]);
    } else {
        // For SELECT queries
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        echo json_encode(["status" => "success", "data" => $rows]);
    }

    $conn->close();
?>