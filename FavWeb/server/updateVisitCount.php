<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This updateVisitCount.php updates selected website's visit count by +1.
 */
session_start();
if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
}
include "connect.php";

$selectedUrlId = filter_input(INPUT_POST, "selectedUrlId", FILTER_VALIDATE_INT);

if ($selectedUrlId > 0 && $selectedUrlId !== "") {
    $command = "UPDATE website SET visitCount = visitcount + 1 WHERE id=?";
    $stmt = $dbh->prepare($command);
    $params = [$selectedUrlId];
    $success = $stmt->execute($params);
    echo "success";
}
