<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "group10", "droptables", "group10");

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

	// prepare and bind
$stmt = $conn->prepare("INSERT INTO filters (list_id, filter) VALUES (?, ?)");
$stmt->bind_param("ss", $list_id, $filter);

	//TODO: Point this to wherever the actual data is coming from. This is test data. 
$jsonData = file_get_contents('sampleData_addFilters.json');
$data = json_decode($jsonData, true);
print_r($data);

$list_id = $data["id"];

foreach ($data["filters"] as $filter) {
	if ($stmt->execute() === TRUE) {
		echo "Filter ".$filter." was succesfully added to list item ".$list_id."\n";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$stmt->close();
$conn->close();
?>