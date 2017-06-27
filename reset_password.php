<?php
/* Password reset process, updates database with new user password */
require 'backend/config.php';
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $new_password = $_POST['newpassword'];
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $conn->escape_string($_POST['email']);

        $sql = "UPDATE users SET password='$new_password' WHERE email='$email'";

        if ( $conn->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
            echo "<script>window.location.replace('success.php')</script>";
        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        echo "<script>window.location.replace('error.php')</script>";
    }

}
?>