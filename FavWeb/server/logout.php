<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This logout.php ends the session and display message.
 */

 //start session and end it
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/finalProject.css">
</head>

<body>
    <div class="logo">
        <h2>FavWeb</h2>
    </div>
    <h1>Logout Successful</h1>
    <h5> Click <a href="../index.html">HERE</a> to log in again.</h5>
</body>

</html>