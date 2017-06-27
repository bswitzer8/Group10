<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	//header("Content-Type: application/json; charset=UTF-8");

	require('./config.php');


	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO listitems (user_id, name, created, description, due_date, location, priority) VALUES (?, ?, ?, ?, ?, ?, ?);");
		$stmt->bind_param("sssssss", $user_id, $name, $created, $description, $dueDate, $location, $priority);
		
		// get posted data
		$jsonData = file_get_contents("php://input");
		$data = json_decode($jsonData, true);
	
		$user_id =		$_SESSION["user_id"];
		$name = 		$data["name"];
		$location = 	$data["location"];
		$description =	$data["description"];
		$createdDate =	date("F j, Y, g:i a");  
		$dueDate =		date('Y-m-d H:i:s', strtotime($data["due_date"]));  
		$priority = 	$data["priority"];
		$filters =		$data["filters"];
		
		// SELECT LAST_INSERT_ID();
		// I want to return the list_id 
		
		if ( $stmt->execute() ) {
			$id = $stmt->insert_id;
			
			$items = "";
			foreach($filters as $filt)
			{
				$items += $filt." ";
				$stmt = $conn->prepare("INSERT INTO filters (list_id, filter) VALUES (?, ?)");
				$stmt->bind_param("ss", $id, $filt);
				$stmt->execute();
			}
			
			echo "Added list_id=".$id."items=".$items;
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$stmt->close();
	} 
	else
	{
		echo "No user logged in.";
	}

	$conn->close();
?>