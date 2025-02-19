<?php
    include('templates/header.php');    
    include('utils.php');

    
    if (!isset($_SESSION["userName"])) {
        header("Location: login.php");
        exit();
    }



    $db = getDatabase();

    $dbQuery = "SELECT Title, Body, StartDate, EndDate, ContributorUsername, ArticleId FROM Article WHERE ContributorUsername = ?";

    $perparedstmt = $db->prepare($dbQuery);
    $perparedstmt->bindParam(1, $_SESSION["userName"]);

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

                        while($data = $result->fetchArray()){
                            $dateStart = date_create($data[2]);
                            $dateStart = date_format($dateStart, ("F d, Y"));
                            $dateEnd = date_create($data[3]);
                            $dateEnd = date_format($dateEnd, ("F d, Y"));
                            $str = strip_tags(substr($data[1], 0, 50));

                            echo "
                            <tr>
                                <td>{$data[5]}</td>
                                <td>{$dateStart}</td>
                                <td>{$dateEnd}</td>
                                <td>{$data[0]}</td>
                                <td>{$str}...</td>
                                <td>
                                    <button class='btn btn-outline-primary' type='button'>
                                        <a class='link-button-edit dashboard-link' href='/edit_article.php?id={$data[5]}'>Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <button class='btn btn-outline-danger' type='button'>
                                        <a class='link-button-delete dashboard-link' href='/remove_article.php?id={$data[5]}'>Delete</a>
                                    </button>
                                </td>
                                <td>
                                    <button class='btn btn-outline-warning' type='button'>
                                        <a class='link-button-view dashboard-link' href='/article.php?id={$data[5]}'>View</a>
                                    </button>
                                </td>
                            </tr>";
                        }

                    echo "</tbody>
                    </table>
                </div>";
            echo '</div>'; // Close content-wrapper
            echo '</div>';                 
    echo '</body>';

    closeDBConnection($db);

    include('templates/footer.php');
?>