<?php
    session_start();

    header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json; charset=UTF-8");

    require('./config.php');

	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
    	
        $postdata = file_get_contents("php://input");
        $t = json_decode($postdata);
        $id = $t->id;
        $user_id = $_SESSION["user_id"];    
        
        $result = $conn->query("SELECT * FROM listitems WHERE id = ".$id);
        
        $outp = "";
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != "") {$outp .= ",";}
            $outp .= '{"name":"'  		. $rs["name"] 		. '",';
            $outp .= '"description":"'  . $rs["description"]. '",';
            $outp .= '"id":"'           . $rs["id"].          '",';
            $outp .= '"location":"'		. $rs["location"]	. '",';
            $outp .= '"dueDate":"'		. $rs["due_date"]	. '",';
            $outp .= '"createdDate":"'  . $rs["created"]. '",';
            $outp .= '"priority":"'		. $rs["priority"]	. '"}';
        }
        $outp ='{"records":['.$outp.']}';
        $conn->close();
    
        echo($outp);
	}
	else 
	{
	    echo "No user logged in.";
	}
?>