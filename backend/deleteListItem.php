<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require('./config.php');

	// prepare and bind
	$stmt1 = $conn->prepare("DELETE FROM filters WHERE list_id = ?");
	$stmt1->bind_param("s", $listId);

	$stmt2 = $conn->prepare("DELETE FROM sharedlistitems WHERE list_id = ?");
	$stmt2->bind_param("s", $listId);

	$stmt3 = $conn->prepare("DELETE FROM listitems WHERE list_id = ?");
	$stmt3->bind_param("s", $listId);

	//TODO: Point this to wherever the actual data is coming from. This is test data. 
	$jsonData = file_get_contents('sampleData_deleteListItem.json');
	$data = json_decode($jsonData, true);
	print_r($data);

	$listId = $data["list_id"];

	if ($stmt1->execute() === TRUE && $stmt2->execute() === TRUE && $stmt3->execute() === TRUE) {
		echo "List item ".$list_id." was successfully deleted from all tables";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$stmt->close();
	$conn->close();
?>