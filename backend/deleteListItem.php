<?php
session_start();

header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

require('./config.php');

if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {

    // prepare and bind
    $stmt1 = $conn->prepare("DELETE FROM filters WHERE list_id = ? ");
    $stmt1->bind_param("s", $listId);

    $stmt2 = $conn->prepare("DELETE FROM sharedlistitems WHERE list_id = ?");
    $stmt2->bind_param("s", $listId);

    $stmt3 = $conn->prepare("DELETE FROM listitems WHERE id = ?");
    $stmt3->bind_param("s", $listId);


    $postdata = file_get_contents("php://input");
    $t = json_decode($postdata);

    $listId = $t->id;
    $user_id = $_SESSION["user_id"];

    if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
        echo "List item " . $list_id . " was successfully deleted from all tables";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
} else {
    echo "No user logged in.";
}

$conn->close();
?>