<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$conn = new mysqli("localhost", "group10", "droptables", "group10");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// prepare and bind
	$stmt = $conn->prepare("DELETE FROM filters WHERE list_id = ? AND filter = ?");
	$stmt->bind_param("s", $listId, $filter);

	//TODO: Point this to wherever the actual data is coming from. This is test data. 
	$jsonData = file_get_contents('sampleData_deleteFilterFromListItem.json');
	$data = json_decode($jsonData, true);
	print_r($data);

	$listId = $data["list_id"];
	$filter = $data["filter"];

	if ($stmt->execute() === TRUE) {
		echo "Filter ".$filter." was successfully removed from list item ".$listId;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$stmt->close();
	$conn->close();
?>