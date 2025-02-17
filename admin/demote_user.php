<?php

$db = new SQLite3('../DB/BlogDB.db');


if (isset($_GET['Username'])) { 
    $username = $_GET['Username'];

    $stm = $db->prepare('UPDATE Users SET IsApproved = ? WHERE Username = ?');
    $stm->bindValue(1, 0, SQLITE3_TEXT); 
    $stm->bindValue(2, $username, SQLITE3_TEXT);  
    $stm->execute();

}

?>