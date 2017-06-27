<?php
  
        $servername = "localhost"; 
        $username = "group10"; 
        $password = "droptables";
        $database = "group10";
        $dbport = 3306;
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $dbport);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>