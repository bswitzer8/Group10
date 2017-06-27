<?php
    require('./config.php');
    session_start();

	if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) 
	{
        $user_id = $_SESSION["user_id"];    
        
        $result = $conn->query("SELECT name, id FROM users WHERE id =".$user_id." LIMIT 1");
        
        $outp = "";
        
        $rs = $result->fetch_array(MYSQLI_NUM);
         $outp .= '{"name":"'  		. $rs[0] 		. '",';
         $outp .= '"id":"'           . $rs[1].          '"}';
       
        $conn->close();
    
        echo($outp);
	}
	else 
	{
	    echo "No user logged in.";
	}
?>