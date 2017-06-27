<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $_POST['email'];
$result = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($result->num_rows == 0) { // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    echo "<script>window.location.replace('error.php')</script>";
} else { // User exists
    $user = $result->fetch_assoc();

    if ($_POST['password'] == $user['password']) {

        $_SESSION['user_id'] = $user["id"];

        echo "<script>window.location.replace('../cop4813')</script>";
    } else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        echo "<script>window.location.replace('error.php')</script>";
    }
}

