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
    $perparedstmt->bindParam(1, $_SESSION["name"]);

    $result = $perparedstmt->execute();

    

    echo '<body id="profileBody">';


    echo "<div>
    <div id='headerContainer'>
        <h1 id='mainProfile'>My Account</h1>
        <p>DashBoard</p>
    </div>

    <div id='mainContain'>

    <div>
        <ul id='profileList'>
            <li><a href='#'>Articles</a></li>
            <li>Details</li>
            <li>Logout</li>
        </ul>
    </div>


    <div>

        <table id='profileTable'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Create</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>View</th>
                </tr>
            </thead>

            <tbody>


    ";
    

    while($data = $result->fetchArray()){
        $dateStart = date_create($data[2]);
        $dateStart = date_format($dateStart, ("F d, Y"));
        $dateEnd = date_create($data[3]);
        $dateEnd = date_format($dateEnd, ("F d, Y"));
        $str = substr($data[1], 0, 50);

    


        echo "
        <tr>
        <td>{$data[5]}</td>
        <td>{$dateStart}</td>
        <td>{$dateEnd}</td>
        <td>{$data[0]}</td>
        <td>{$str}...</td>
        <td><button class='btn btn-success' type='button'><a class='link-button' href='/createArticle.php'>Create</a></button></td>
        <td><button class='btn btn-primary' type='button'><a class='link-button' href='/edit_article.php?id={$data[5]}'>Edit</a></button></td>
        <td><button class='btn btn-danger' type='button'><a class='link-button' href='/remove_article.php?id={$data[5]}'>Delete</a></button></td>
        <td><button class='btn btn-warning' type='button'><a class='link-button' href='/article.php?id={$data[5]}'>View</a></button></td>
        </tr>
        ";
    }





    echo "

            </tbody>
        </table>
    </div>
    </div>


    ";

    


    echo '
    </div>
    </body>';

    $db->close();

    include('templates/footer.php');
?>