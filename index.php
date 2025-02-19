<?php
    include('templates/header.php');    
    include('utils.php');

    
    if (!isset($_SESSION["userName"])) {
        header("Location: ../User/login.php");
        exit();
    }

    $db = getDatabase();

    $dbQuery = "SELECT Title, Body, StartDate, EndDate, FirstName, LastName, ArticleId FROM Article
    INNER JOIN Users ON Article.ContributorUsername = Users.Username";

    $result = $db->query($dbQuery);

    echo '<body class="back">';


    echo '<div class="articles-container">';
    echo '<h1 class="mainText">Articles</h1>';
    echo '<div class="articles-grid">';


    $currentDate = date("F d, Y");
    
    while($data = $result->fetchArray()){
        $dateStart = date_create($data[2]);
        $dateStart = date_format($dateStart, ("F d, Y"));
        $dateEnd = date_create($data[3]);
        $dateEnd = date_format($dateEnd, ("F d, Y"));

        if(($currentDate >= $dateStart && $currentDate <= $dateEnd)){

            $str = substr($data[1], 0, 100);

            echo "
                <div class='card border-secondary mb-3 article-card'>
                    <h5 class='card-header'>{$data[0]}</h5>
                    <div class='card-body'>
                        <h5 class='card-title'>{$data[4]} {$data[5]}  -  {$dateStart}</h5>
                        <p class='card-text cardText'>{$str}... <a href='/User/article.php?id={$data[6]}' class='cardButton'>Read More</a></p>
                    </div>
                </div>
            ";
        }

    }

    echo '</div>';
    echo '</div>';
    echo '</body>';

    closeDBConnection($db);

    include('templates/footer.php');
?>