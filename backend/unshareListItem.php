<?php
	session_start();

	header("Access-Control-Allow-Origin: *");
	//header("Content-Type: application/json; charset=UTF-8");

	require('./config.php');


	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
	    $stmt = $conn->prepare("DELETE FROM sharedlistitems WHERE user_id = ? AND list_id = ?");
		$stmt->bind_param("ss", $user_id, $list_id); 
		
		// get posted data
		$jsonData = file_get_contents("php://input");
		$data = json_decode($jsonData, true);
	
		$user_id =		$data["user_id"];
		$list_id = 		$data["list_id"];
		
		if ( $stmt->execute() ) {
	    	echo "deleted=".$list_id."with=".$user_id;
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	    
	}
?>