<?php
    include('templates/header.php');    
    include('utils.php');

    $db = getDatabase();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        $id = null;
        echo "no article chosen";
    }


    $dbQuery = "SELECT Title, Body, StartDate, EndDate, ContributorUsername FROM Article WHERE ArticleId = ?";


    $preparedstmt = $db->prepare($dbQuery);
    $preparedstmt->bindValue(1, $id);

    $result = $preparedstmt->execute();

    $data = $result->fetchArray();



    $date = date_create($data[2]);
    $date = date_format($date, ("F d, Y"));
    

    

    echo '<body id="back">';


    echo "
    <div id='main'>
    
        <h1>{$data[0]}</h1>

        <h5 id='date'><i>Posted on {$date} by {$data[4]}</i></h5>

        <pre id='mainBody'>{$data[1]}</pre>
    
    </div>
    </body>
    ";

    include('templates/footer.php');
?>