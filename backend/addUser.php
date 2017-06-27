<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require('./config.php');

// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
print_r($data);

$name = $data["name"];
$email = $data["email"];
$password = $data["password"];

if ($stmt->execute() === true) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>