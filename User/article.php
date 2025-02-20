<?php
     
    // Include utility functions
    include('../utils.php');

    session_start();
    
    if (!isset($_SESSION["userName"])) {
        header("Location: ../User/401.php");
        exit();
    }

     

    $db = getDatabase();

    // Check if the 'id' parameter is provided in the URL (GET request)
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        // If 'id' is not provided, redirect to the user's profile page
        header("Location: ../User/profile.php");
    }

    include('../templates/header.php');  


    // SQL query to fetch the article details by ArticleId, including article title, body, dates, and author information
    $dbQuery = "SELECT Title, Body, StartDate, EndDate, FirstName, LastName FROM Article 
    INNER JOIN Users ON Article.ContributorUsername = Users.Username
    WHERE ArticleId = ?";

    // Prepare the SQL statement to avoid SQL injection
    $preparedstmt = $db->prepare($dbQuery);
    $preparedstmt->bindValue(1, $id);

    $result = $preparedstmt->execute();

    $data = $result->fetchArray();


    // Format the start date for display
    $date = date_create($data[2]);
    $date = date_format($date, ("F d, Y"));
    

    
    // Output the article details inside the body section
    echo '<body class="back">';


    echo "
    <div class='main'>
    
        <h1 class='index_h1'>{$data[0]}</h1>

        <h5 class='date'><i>Posted on {$date} by {$data[4]} {$data[5]}</i></h5>

        <div class='mainBody'> {$data[1]}</div>
    
    </div>
    </body>
    ";

    include('../templates/footer.php');
?>