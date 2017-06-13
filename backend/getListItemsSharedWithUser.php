<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "group10", "droptables", "group10");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$jsonData = file_get_contents('sampleData_getSharedItemsByUser.json');
$data = json_decode($jsonData, true);

$userId = $data["userId"];

$result = $conn->query("SELECT * FROM listitems INNER JOIN sharedlistitems ON listitems.user_id = sharedlistitems.user_id AND listitems.id = sharedlistitems.list_id WHERE sharedlistitems.user_id = ".$userId.";");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name":"'  		. $rs["name"] 		. '",';
    $outp .= '"description":"'  . $rs["description"]. '",';
    $outp .= '"location":"'		. $rs["location"]	. '",';
    $outp .= '"dueDate":"'		. $rs["due_date"]	. '",';
    $outp .= '"createdDate":"'  . $rs["created"]. '",';
    $outp .= '"priority":"'		. $rs["priority"]	. '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>