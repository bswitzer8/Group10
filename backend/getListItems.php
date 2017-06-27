<?php
    session_start();
    
    header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json; charset=UTF-8");
    
    require('./config.php');

	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{

        $user_id = $_SESSION["user_id"];
        
        $result = $conn->query("SELECT * FROM listitems WHERE user_id = ".$user_id);
        
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
        
        $result2 = $conn->query("SELECT f.filter, f.list_id FROM filters f JOIN listitems l ON f.list_id = l.id WHERE user_id= ".$user_id);
        while($rs2 = $result2->fetch_array(MYSQLI_ASSOC)) {
            if ($outpf != "") {$outpf .= ",";}
            
            $outpf .= '{"name":"'  		. $rs2["filter"] 		. '",';
            $outpf .= '"list_id":"'		. $rs2["list_id"]	. '"}';
        }
        
        
        $outp ='{"records":['.$outp.'], "filters": ['.$outpf.']}';
        $conn->close();
        
        echo($outp);
    }
    else {
        echo "No user logged in.";
    }
?>