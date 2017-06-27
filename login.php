<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
// Ben: I'll change this to use the Angular stuff (it is minor, check addListItem.php to see what I mean)
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    // Ben: urgh, I'll handle this whole thing.
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        // Ben: we don't have a first_name or last_name... change to just name
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        // Ben: No pls. just do $_SESSION['user_id'] = $user["id"];
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        // Ben: urgh, I'll handle this whole thing.
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

