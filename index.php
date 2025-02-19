<?php
    include('templates/header.php');    
    include('utils.php');

    // class ArticleData{

    // }

    $db = getDatabase();

    $dbQuery = "SELECT Title, Body, StartDate, EndDate, ContributorUsername, ArticleId FROM Article";

    $result = $db->query($dbQuery);

    echo '<body id="back">';


    echo '<div>
    
    <h1 id="mainText">The Blog Articles:</h1>
    
    ';

    while($data = $result->fetchArray()){
        $date = date_create($data[2]);
        $date = date_format($date, ("F d, Y"));
        $str = substr($data[1], 0, 100);

        echo "

            <div class='card' id='theCards'>
                <h5 class='card-header'>{$data[0]}</h5>
                <div class='card-body'>
                    <h5 class='card-title'>{$data[4]}  -  {$date}</h5>
                    <p class='card-text' id='cardText'>{$str}... <a href='/article.php?id={$data[5]}' id='cardButton'>more</a></p>
                </div>
            </div>
           
        ";
       
    }


    echo '
    </div>
    </body>';

    $db->close();

    include('templates/footer.php');
?>