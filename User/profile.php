<?php  
    // Include utility functions
    include('../utils.php');

    session_start();
    
    // Check if the user is logged in by verifying the session variable 'userName'
    if (!isset($_SESSION["userName"])) {
        // If not logged in, redirect to the 401 Unauthorized page
        header("Location: ../User/401.php");
        exit();
    }


    include('../templates/header.php');  


    $db = getDatabase();

    // SQL query to select articles that belong to the logged-in user
    $dbQuery = "SELECT Title, Body, StartDate, EndDate, ContributorUsername, ArticleId FROM Article WHERE ContributorUsername = ?";



    // Prepare the SQL statement to prevent SQL injection
    $perparedstmt = $db->prepare($dbQuery);
    $perparedstmt->bindParam(1, $_SESSION["userName"]);

    // Execute the prepared statement
    $result = $perparedstmt->execute();

    echo '<body class="profileBody">';
        echo '<div class="page-wrapper">';
        echo '<div class="content-wrapper">';

        echo "  <div class='headerContainer'>
                    <h1 class='mainProfile'>My Account</h1>
                    <h2 class='subheader'>Dashboard</p>
                </div>
                <div class = 'profile_container'>

                    <table class='profileTable'>
                        <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>View</th>
                            </tr>
                        </thead>

                        <tbody>";

                        // Loop through each article retrieved from the database
                        while($data = $result->fetchArray()){
                            $dateStart = date_create($data[2]);
                            $dateStart = date_format($dateStart, ("F d, Y"));
                            $dateEnd = date_create($data[3]);
                            $dateEnd = date_format($dateEnd, ("F d, Y"));
                            // Limit the title and body text to a specific length for display
                            $title = substr($data[0], 0, 15);
                            $str = strip_tags(substr($data[1], 0, 30));

                            echo "
                            <tr>
                                <td>{$data[5]}</td>
                                <td>{$dateStart}</td>
                                <td>{$dateEnd}</td>
                                <td>{$title}</td>
                                <td>{$str}...</td>
                                <td>
                                    <button class='btn btn-outline-primary' type='button'>
                                        <a class='link-button-edit dashboard-link' href='edit_article.php?id={$data[5]}'>Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <button class='btn btn-outline-danger' type='button'>
                                        <a class='link-button-delete dashboard-link' href='remove_article.php?id={$data[5]}'>Delete</a>
                                    </button>
                                </td>
                                <td>
                                    <button class='btn btn-outline-warning' type='button'>
                                        <a class='link-button-view dashboard-link' href='article.php?id={$data[5]}'>View</a>
                                    </button>
                                </td>
                            </tr>";
                        }

                    echo "</tbody>
                    </table>
                </div>";
            echo '</div>';
            echo '</div>';                 
    echo '</body>';

    closeDBConnection($db);

    include('../templates/footer.php');
?>