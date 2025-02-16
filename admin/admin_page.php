<?php 
include("../templates/header.php"); 
include("../utils.php");
?>
<body>
    <div class = "logo">
    <h1>Admin Page</h1>
    <p>Welcome to the admin page. Here you can view, add, edit, and delete Users.</p>
    <p>Click on the links below to perform the desired action.</p>
<h1>List of Users</h1>
</div>

<?php

//! If database table is not displaying, change this function to original of your code
$db = getDatabase();
// $db = new SQLite3('../DB/BlogDB.db');

$result = $db->query("SELECT COUNT(*) FROM Users");
$row = $result->fetchArray(SQLITE3_ASSOC);


$res = $db->query('SELECT * FROM Users');

echo realpath('BlogDB.db');


echo "<style>
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 20px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color:rgb(160, 156, 156);
        border-color: black;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .table-container {
        overflow-x: auto;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .action-buttons a {
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid #ddd;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
    }

    .action-buttons a:hover {
        background-color: #45a049;
    }
</style>";

echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Registration Date</th><th>isApproved</th><th>Role</th><th>Actions</th></tr>";

while ($row = $res->fetchArray()) {
    echo "<tr>";
    echo "<td>{$row['Username']}</td>";
    echo "<td>{$row['FirstName']}</td>";
    echo "<td>{$row['LastName']}</td>";
    echo "<td>{$row['RegistrationDate']}</td>";
    echo "<td>{$row['isApproved']}</td>";
    echo "<td>{$row['Role']}</td>";
    echo "<td class='action-buttons'>";
    
    echo "<a href='#' onclick='promoteUser(\"{$row['Username']}\")'>Approve</a>";
    
    echo "<a href='#' onclick='demoteUser(\"{$row['Username']}\")' style='color: white; background-color: red; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Disapprove</a>";

    echo "</td>";  
    echo "</tr>";
}

echo "</table>";
echo "</div>";


echo "<br/><br/>";
?>

<script>
function promoteUser(username) {
    fetch('promote_user.php?Username=' + encodeURIComponent(username), {
        method: 'GET'
    })
    .then(() => {
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}
</script>

<script>
function demoteUser(username) {
    fetch('demote_user.php?Username=' + encodeURIComponent(username), {
        method: 'GET'
    })
    .then(() => {
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}
</script>
<?php include("../templates/footer.php"); ?>