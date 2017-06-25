<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
//	header("Content-Type: application/json; charset=UTF-8");
	
	require('./config.php');


	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
		$jsonData = file_get_contents("php://input");
		$posted = json_decode($jsonData, true);
		$data = $posted["data"];
		
		$id = $data["id"];
		$user_id = $_SESSION["user_id"];
		
		$sql = "SELECT * FROM listitems where id = ".$id.";";
		$result = $conn->query($sql);
	
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
	
			//Set the bound variables to the data passed in.  If that is null, set it to what's already in the DB.
			$name = $data["name"] ?: $row["name"];
			$description = $data["description"] ?: $row["description"];
			$dueDate = date('Y-m-d H:i:s', strtotime($data["due_date"]))  ?: $row["due_date"];
			$location = $data["location"] ?: $row["location"];
			$priority = $data["priority"] ?: $row["priority"];
			
		} else 
		{
			echo "No list item was found";
		}
	
		// prepare and bind
		$stmt = $conn->prepare("UPDATE listitems SET name = ?, description = ?, due_date = ?, location = ?, priority = ? WHERE id = ?;");
		$stmt->bind_param("ssssss", $name, $description, $dueDate, $location, $priority, $id);
	
		if ($stmt->execute() === TRUE) {
			echo "Record ".$id." was updated successfully.";
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