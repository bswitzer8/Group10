<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require('./config.php');

// prepare and bind
$stmt = $conn->prepare("INSERT INTO filters (list_id, filter) VALUES (?, ?)");
$stmt->bind_param("ss", $list_id, $filter);

$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
$filter = $data["filter"];

$list_id = $data["id"];

foreach ($data["filters"] as $filter) {
    if ($stmt->execute() === true) {
        echo "Filter " . $filter . " was succesfully added to list item " . $list_id . "\n";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>