<?php
// Set the content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Create an associative array with a single key "message" and a string value
    $response = array(
        "message" => "Hello, this is a simple PHP API!"
    );
    echo json_encode($response);
} else {
    http_response_code(405);
    $error = array(
        "error" => "Method not allowed. Please use a GET request."
    );
    echo json_encode($error);
}
