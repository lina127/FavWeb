<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This addWebsite.php get numeric user id(userPK) and checks if they saved identical url website. If not, inserts new website into the website database.
 */

session_start();
if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
}
include "connect.php";

//filter user input
$websiteName = filter_input(INPUT_POST, "newWebsiteName", FILTER_SANITIZE_SPECIAL_CHARS);
$url = filter_input(INPUT_POST, "newUrl", FILTER_SANITIZE_SPECIAL_CHARS);

//get numeric user id(userPK) from the usertable where userId matches
$command = "SELECT id FROM usertable where userId=?";
$stmt = $dbh->prepare($command);
$params = [$userId];
$success = $stmt->execute($params);

$userPrimaryKey = 0;
while ($row = $stmt->fetch()) {
    $userPrimaryKey = $row["id"];
}

// checks if user already stored same website url
$command = "SELECT url FROM website where userId=?";
$stmt = $dbh->prepare($command);
$params = [$userPrimaryKey];
$success = $stmt->execute($params);
$isUrlExist = false;
while ($row = $stmt->fetch()) {
    if($url === $row["url"]){
        $isUrlExist = true;
        break;
    }
}

// if the parameters are not null, blank and the url does not exist, it inserts the website to the database 
if ($websiteName !== null && $websiteName !== "" && $url !== null && $url !== "" && !$isUrlExist) {
    $command = "INSERT INTO website (websiteName, url, userId) VALUES (?,?,?)";
    $stmt = $dbh->prepare($command);
    $params = [$websiteName, $url, $userPrimaryKey];
    $success = $stmt->execute($params);
    echo "success";
}
else{
    echo "Url already exists";
}