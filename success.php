<?php
/* Displays all success messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1>Success</h1>
    <p>
        <?php
        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
            echo $_SESSION['message'];
        else:
            header("location: index.php");
        endif;
        ?>
    </p>

    <button class="button button-block" onclick="location.href='index.php';">
        Home
    </button>

    <button class="button button-block" onclick="location.href='index.php';">Home</button>

</div>
</body>
</html>
