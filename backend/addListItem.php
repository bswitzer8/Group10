<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$conn = new mysqli("localhost", "group10", "droptables", "group10");

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO listitems (user_id, name, created, description, due_date, location, priority) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssss", $user_id, $name, $created, $description, $dueDate, $location, $priority);

	//TODO: Point this to wherever the actual data is coming from. This is test data. 
	$jsonData = file_get_contents('sampleData_addListItem.json');
	$data = json_decode($jsonData, true);
	print_r($data);

	//TODO: Delete this - hardcoding for testing until PHP sessions are set up.
	$_SESSION["user_id"] = 1;

	$user_id = $_SESSION["user_id"];
	$name = $data["name"];
	$location = $data["location"];
	$description = $data["description"];
	$createdDate = date('Y-m-d H:i:s', strtotime($data["createdDate"]));  
	$dueDate = date('Y-m-d H:i:s', strtotime($data["dueDate"]));  
	$priority = $data["priority"];

	if ($stmt->execute() === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$stmt->close();
	$conn->close();
?>