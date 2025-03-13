<?php  
include("../utils.php");

session_start();

// Redirect to 401 page if user is not logged in
if (!isset($_SESSION["userName"])) {
    header("Location: ../User/401.php");
    exit();
}

$userRole = $_SESSION["role"];
// Redirect to 401 page if user is not an admin
if ($userRole != "admin") {
    header("Location: ../User/401.php");
    exit();
}

include("../templates/header.php"); 
?>

<body>
    <div class="logo">
        <h1>Admin Page</h1>
        <h1>List of Users</h1>
    </div>

<?php

// Connect to the database
$db = getDatabase();
// $db = new SQLite3('../DB/BlogDB.db'); // Alternative database connection

// Query to count total users (not used later in the code)
$result = $db->query("SELECT COUNT(*) FROM Users");
$row = $result->fetchArray(SQLITE3_ASSOC);

// Fetch all users from the database
$res = $db->query('SELECT * FROM Users');

// Table styling for displaying users
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
        background-color: rgb(160, 156, 156);
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

// Display users in a table
echo "<div class='table-container'>";
echo "<table>";
echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Registration Date</th><th>IsApproved</th><th>Role</th><th>Actions</th></tr>";

// Loop through all users and display their details
while ($row = $res->fetchArray()) {
    echo "<tr>";
    echo "<td>{$row['Username']}</td>";
    echo "<td>{$row['FirstName']}</td>";
    echo "<td>{$row['LastName']}</td>";
    echo "<td>{$row['RegistrationDate']}</td>";
    echo "<td>{$row['IsApproved']}</td>";
    echo "<td>{$row['Role']}</td>";
    echo "<td class='action-buttons'>";
    
    // Buttons to approve or disapprove a user
    echo "<a href='#' onclick='event.preventDefault(); changeUserStatus(\"{$row['Username']}\", 1)'>Approve</a>";
    echo "<a href='#' onclick='event.preventDefault(); changeUserStatus(\"{$row['Username']}\", 0)' style='color: white; background-color: red; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Disapprove</a>";

    echo "</td>";  
    echo "</tr>";
}
echo "</table>";
echo "</div>";

echo "<br/><br/>";
?>

<script>
    // Function to send an AJAX request to update user approval status
    function changeUserStatus(username, status) {
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'Username=' + encodeURIComponent(username) + '&IsApproved=' + encodeURIComponent(status)
        })
        .then(response => response.text())
        .then(data => {
            console.log('Server Response:', data);
            location.reload(); // Reload page to update the UI
        })
        .catch(error => console.error('Error:', error));
    }
</script>

<?php
// Handle POST request to update user approval status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Username']) && isset($_POST['IsApproved'])) {
    $username = $_POST['Username'];
    $isApproved = $_POST['IsApproved'];

    // Prepare SQL statement to update user approval status
    $stm = $db->prepare('UPDATE Users SET IsApproved = ? WHERE Username = ?');
    
    if (!$stm) {
        die("SQL Prepare Failed: " . $db->lastErrorMsg());
    }

    // Bind parameters to prevent SQL injection
    $stm->bindValue(1, $isApproved, SQLITE3_INTEGER);
    $stm->bindValue(2, $username, SQLITE3_TEXT);

    $result = $stm->execute();

    // Display success or error message
    if ($result) {
        echo "User status updated successfully!";
    } else {
        echo "Database update failed!";
    }

    exit(); 
}
?>

<?php include("../templates/footer.php"); ?>
