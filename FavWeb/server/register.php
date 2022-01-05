<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This register.php filters user input and does password hashing for security. Checks if the user id already exists and if not, inserts new user to the database.
 */

include "connect.php";

//filter user input
$userId = filter_input(INPUT_POST, "userId", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); //hashing
$userExist = false;

if ($userId !== null && $userId !== "" && $password !== null && $password !== "") {
    // check if user exist
    $command = "SELECT userId FROM usertable";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute();
    while ($row = $stmt->fetch()) {
        if ($userId === $row['userId']){
            $userExist = true;
        }
    }

    if(!$userExist){
        $command = "INSERT INTO usertable (userId, password) VALUES (?, ?)";
        $stmt = $dbh->prepare($command);
        $params = [$userId, $hashedPassword];
        $success = $stmt->execute($params);
        echo "Your account has been created. Now login.";
    }
    else{
        echo "User id already exist.";
    }
}





