<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */
require('backend/config.php');

// Set session variables to be used on profile.php page

// Ben: I'll do the angular stuff here.
$_SESSION['email'] = $_POST['email'];

// We only have a Name field, not first and last
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
      
// Check if user with that email already exists
$result = $conn->query("SELECT * FROM users WHERE email='$email'") or die($conn->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    // Ben: I'll fix the error handling.
    $_SESSION['message'] = 'User with this email already exists!';
    header("<script>window.location.replace(‘error.php’)</script>");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    // Ben: what is the hash about? We are suppose to hash the password.. 
   // also, first_name and last_name doesn't exist. 
   // Check over the listastic.sql to see the definition por favor.
   
    $name = $first_name.' '.$last_name;
    $sql = "INSERT INTO users (name, email, password) " 
            . "VALUES ('$name','$email','$password')";

    $conn->query($sql) or die($conn->error());

}
