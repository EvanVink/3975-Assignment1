<?php 
include("../templates/header.php"); 
?>
<body>
    <div class = "logo">
    <h1>Admin Page</h1>
    <p>Welcome to the admin page. Here you can view, add, edit, and delete Users.</p>
    <p>Click on the links below to perform the desired action.</p>
<h1>List of Users</h1>
</div>

<?php


// $result = $db->query("SELECT COUNT(*) FROM Users");
// $row = $result->fetchArray(SQLITE3_ASSOC);


// $res = $db->query('SELECT * FROM Users');

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
        padding: 5px 10px;
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
echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Registration Date</th><th>Role</th><th>Actions</th></tr>";

// Fetch and display the rows
// while ($row = $res->fetchArray()) {
//     echo "<tr>";
//     echo "<td>{$row['StudentId']}</td>";
//     echo "<td>{$row['FirstName']}</td>";
//     echo "<td>{$row['LastName']}</td>";
//     echo "<td>{$row['School']}</td>";
//     echo "<td class='action-buttons'>";
    
    // Edit button links to edit_student.php with studentId as query parameter
//     echo "<a href='edit_student.php?studentId={$row['StudentId']}'>Edit</a>";

//     // Delete button links to insert_data.php with studentId as query parameter
//     echo "<a href='delete_student.php?studentId={$row['StudentId']}'>Delete</a>";

//     echo "<a href='display_student.php?studentId={$row['StudentId']}'>Display</a>";


//     echo "</td>";  // Close the actions column
//     echo "</tr>";
// }

// End the table
echo "</table>";
echo "</div>";


echo "<br/><br/>";
?>

<?php include("../templates/footer.php"); ?>