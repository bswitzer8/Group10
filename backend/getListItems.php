<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "group10", "droptables", "group10");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query("SELECT * FROM listitems");

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