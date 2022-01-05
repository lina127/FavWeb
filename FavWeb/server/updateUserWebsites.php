<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This updateUserWebsites.php get current user's stored websites as json array.
 */

session_start();
$userId = $_SESSION["userId"];

include "connect.php";

$command = "SELECT id FROM usertable where userId=?";
$stmt = $dbh->prepare($command);
$params = [$userId];
$success = $stmt->execute($params);

//get numeric user id
$userPrimaryKey = 0;
while ($row = $stmt->fetch()) {
    $userPrimaryKey = $row["id"];
}

$command = "SELECT * FROM website where userId=? Order by visitCount DESC, websiteName ASC";
$stmt = $dbh->prepare($command);
$params = [$userPrimaryKey];
$success = $stmt->execute($params);
$websiteList = [];
while ($row = $stmt->fetch()) {
    $website = [
        "websiteName" => $row["websiteName"],
        "url" => $row["url"],
        "visitCount" => (int)$row["visitCount"],
        "userId" => (int)$row["userId"],
        "websiteId" => (int)$row["id"]
    ];
    array_push($websiteList, $website);
}
echo json_encode($websiteList);
