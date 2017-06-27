<?php
session_start();

header("Access-Control-Allow-Origin: *");

require('./config.php');

if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
    $stmt = $conn->prepare("INSERT INTO sharedlistitems (user_id, list_id) VALUES (?, ?);");
    $stmt->bind_param("ss", $user_id, $list_id);

    // get posted data
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    $user_id = $data["user_id"];
    $list_id = $data["list_id"];

    if ($stmt->execute()) {
        echo "shared=" . $list_id . "with=" . $user_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>