<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require('./config.php');

$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData);

$userId = 1; //$data["userId"];

$result = $conn->query("SELECT * FROM listitems INNER JOIN sharedlistitems ON listitems.id = sharedlistitems.list_id WHERE sharedlistitems.user_id = ".$userId.";");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name":"'  		. $rs["name"] 		. '",';
    $outp .= '"description":"'  . $rs["description"]. '",';
    $outp .= '"id":"'           . $rs["id"].          '",';
    $outp .= '"location":"'		. $rs["location"]	. '",';
    $outp .= '"dueDate":"'		. $rs["due_date"]	. '",';
    $outp .= '"createdDate":"'  . $rs["created"]. '",';
    $outp .= '"priority":"'		. $rs["priority"]	. '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>