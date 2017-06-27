<?php
    session_start();

    require('./config.php');

	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
        $jsonData = file_get_contents("php://input");
		$data = json_decode($jsonData, true);
	
		$list_id = 		$data["list_id"];
        

        
        $result = $conn->query("SELECT users.name, users.id FROM users INNER JOIN sharedlistitems ON users.id = sharedlistitems.user_id WHERE sharedlistitems.list_id = ".$list_id.";");
        
        $outp = "";
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != "") {$outp .= ",";}
            $outp .= '{"name":"'  		. $rs["name"] 		. '",';
            $outp .= '"id":"'           . $rs["id"].          '"}';
        }
        $outp ='['.$outp.']';
        $conn->close();
    
        echo($outp);
	}
	else 
	{
	    echo "No user logged in.";
	}
?>