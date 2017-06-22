<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	//header("Content-Type: application/json; charset=UTF-8");

	require('./config.php');

	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO listitems (user_id, name, created, description, due_date, location, priority) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssssss", $user_id, $name, $created, $description, $dueDate, $location, $priority);

	//TODO: Point this to wherever the actual data is coming from. This is test data. 
	$jsonData = file_get_contents("php://input");
	$data = json_decode($jsonData, true);

	//TODO: Delete this - hardcoding for testing until PHP sessions are set up.
	$_SESSION["user_id"] = 1;

	$user_id = $_SESSION["user_id"];
	$name = $data["name"];
	$location = $data["location"];
	$description = $data["description"];
	$createdDate = date("F j, Y, g:i a");  
	$dueDate = date('Y-m-d H:i:s', strtotime($data["due_date"]));  
	$priority = $data["priority"];

	if ( $stmt->execute() ) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$stmt->close();
	$conn->close();
?>