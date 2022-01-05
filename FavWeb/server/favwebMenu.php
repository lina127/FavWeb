<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date: Dec.9.2021
 * 
 * This favwebMenu.php is a main menu. It starts the session and if session is not set, it throws an error message to re-login.
 */
session_start();
include "connect.php";

if (isset($_SESSION["userId"])) {
    $userId = $_SESSION["userId"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>FavWeb</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/mainPage.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/finalProject.css">


</head>

<body>
    <?php // if session is set, proceed
    if (isset($_SESSION["userId"])) {
    ?>
        <div class="row">
            <div class="logo col">
                <h2>FavWeb <span id="currentUser">Welcome, <?= $_SESSION["userId"] ?></span></h2>
            </div>
            <div class="col logout">
                <button type="button" class="btn btn-outline-warning float-end" id="logoutButton">Logout</button>
            </div>
        </div>
        <button type="button" class="btn btn-outline-primary" id="newFormDisplay">+Add Website</button>

        <form id="newForm">
            <div class="mb-3">
                <label for="newWebsiteName" class="form-label">Website Name</label>
                <input type="text" class="form-control" id="newWebsiteName" required>
            </div>
            <div class="mb-3">
                <label for="newUrl" class="form-label">URL</label>
                <input type="text" class="form-control" id="newUrl" aria-describedby="sameUrl" required>
                <div id="sameUrl" class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="addNewWebsiteButton">Add</button>
        </form>
        <table class="table table-striped" id="maintable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">URL</th>
                    <th scope="col">Browse</th>
                    <th scope="col">Visits#</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            // get current user's website list and store it in websiteList 
          
            <tbody id="websiteTable">
            </tbody>
        </table>
    <?php

    }
    //if session is not set, throw error message 
    else {
    ?>
        <h1>Login Error! Access denied.</h1>
        <a href="../index.html">Try again.</a>
    <?php
    }
    ?>
</body>

</html>