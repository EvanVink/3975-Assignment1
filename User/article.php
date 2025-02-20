<?php
     
    include('../utils.php');

    session_start();
    
    if (!isset($_SESSION["userName"])) {
        header("Location: ../User/401.php");
        exit();
    }

     

    $db = getDatabase();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        header("Location: ../User/profile.php");
    }

    include('../templates/header.php');  


    $dbQuery = "SELECT Title, Body, StartDate, EndDate, FirstName, LastName FROM Article 
    INNER JOIN Users ON Article.ContributorUsername = Users.Username
    WHERE ArticleId = ?";


    $preparedstmt = $db->prepare($dbQuery);
    $preparedstmt->bindValue(1, $id);

    $result = $preparedstmt->execute();

    $data = $result->fetchArray();



    $date = date_create($data[2]);
    $date = date_format($date, ("F d, Y"));
    

    

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