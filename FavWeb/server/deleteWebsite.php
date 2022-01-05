<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This deleteWebsite.php deletes selected website.
 */

session_start(); 
if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
}
include "connect.php";

$selectedId = filter_input(INPUT_POST, "selectedId", FILTER_VALIDATE_INT); //filter the param

if ($selectedId > 0 && $websiteName !== "") {
    $command = "DELETE FROM website WHERE id=?";
    $stmt = $dbh->prepare($command);
    $params = [$selectedId];
    $success = $stmt->execute($params);
    echo "success";
}
