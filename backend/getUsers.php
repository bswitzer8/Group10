<?php
    session_start();

    header("Access-Control-Allow-Origin: *");
   
    require('./config.php');

	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
        $user_id = $_SESSION["user_id"];    
        
        $result = $conn->query("SELECT * FROM users WHERE id !=".$user_id);
        
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