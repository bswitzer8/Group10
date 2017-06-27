<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
// Ben: I'll change this to use the Angular stuff (it is minor, check addListItem.php to see what I mean)
$email = $_POST['email'];
$result = $conn->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    // Ben: urgh, I'll handle this whole thing.
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( $_POST['password'] == $user['password'] ) {

        // Ben: No pls. just do $_SESSION['user_id'] = $user["id"];
        $_SESSION['user_id'] = $user["id"];

        header("location: app/views/main.html");
    }
    else {
        // Ben: urgh, I'll handle this whole thing.
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}

