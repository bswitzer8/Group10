/* 
  Okay, so with the way I'm going to do this. we will actually only need 
 <?php
session_start();
session_unset();
session_destroy(); 
echo "User has been logged out";
?>
cause this will be a call to a php script.

*/

<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">
          <h1>Thank you for visiting Listastic!</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Login</button></a>

    </div>
</body>
</html>
