<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * login.php: Hash user entered password and check if it matches with the hashed password in the database where userId is same with user entered id.
 */
session_start();
include "connect.php";

// filter user input
$userId = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hash password

//Varify the user
$command = "SELECT * FROM usertable";
$stmt = $dbh->prepare($command);
$success = $stmt->execute();

$isUserVarified = false;
while($row = $stmt->fetch()){
    if ($userId === $row["userId"] && password_verify($password, $row["password"])){
        $isUserVarified = true;
        break;
    }
}
//echo $isUserVarified; //debug

//start session if login is successful
if($isUserVarified){
    session_start();
    $_SESSION["userId"] = $userId;
}
else {
    // end session if login is unsuccessful
    session_unset();
    session_destroy();
}

