<?php

/*
 * I, Yehyun Kim, 000848388 certify that this material is my original 
 * work. No other person's work has been used without due acknowledgement.
 * 
 * Date:Dec.9.2021
 * 
 * This connect.php checkes if it connects to the database(sa000848388).
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=sa000848388",
        "root",
        ""
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
