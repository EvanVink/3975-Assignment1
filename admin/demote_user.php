<?php
include("../templates/header.php");

$db = new SQLite3('../DB/BlogDB.db');


if (isset($_GET['Username'])) {
    $username = $_GET['Username'];

    $stm = $db->prepare('UPDATE Users SET isApproved = ? WHERE Username = ?');
    $stm->bindValue(1, 'FALSE', SQLITE3_TEXT); 
    $stm->bindValue(2, $username, SQLITE3_TEXT);  
    $stm->execute();



    // Inform the user
    echo "
    <br>
    <h4>User with username: {$username} has been disapproved successfully.</h4>";
    echo "
    <br>
    <p><a href=\"admin_page.php\" style=\"padding: 10px 20px; font-size: 16px; color: #333; background-color: #f0f0f0; 
text-decoration: none; border: 2px solidrgb(166, 179, 166); border-radius: 4px; transition: background-color 0.2s, color 0.2s;\">Back to List of Users</a></p>";
} else {
    echo "<p>No Username specified.</p>";
}

include("../templates/footer.php");

?>