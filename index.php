<?php  
    // Include utility functions
    include('utils.php');

    //starting session
    session_start();
    
    // Check if the user is logged in
    if (!isset($_SESSION["userName"])) {
        // If not logged in, set navigation display to false
        $displayNav = false;
        // Include the header template
        include('templates/header.php');

        echo '<body>';

        echo '<h1 class="landing_h1">THE BLOG</h1>';

        // Display login and sign-up buttons
        echo '<div class="landing_btn_container">
                <a href="../User/login.php" class="btn btn-secondary landing_login_btn">Login</a>
                <a href="../User/signup.php" class="btn btn-secondary landing_signup_btn">Sign-up</a>
            </div>';

        echo '</body>';

        include('templates/footer.php');
    } else {
        // If user is logged in, establish a database connection
        $db = getDatabase();

        // Query to fetch article details along with contributor names
        $dbQuery = "SELECT Title, Body, StartDate, EndDate, FirstName, LastName, ArticleId FROM Article
        INNER JOIN Users ON Article.ContributorUsername = Users.Username";
    
        $result = $db->query($dbQuery);
    
        include('templates/header.php');  
    
        echo '<body class="back">';
    
    
        echo '<div class="articles-container">';
        echo '<h1 class="mainText">Articles</h1>';
        echo '<div class="articles-grid">';
    
    
        // Get the current date
        $currentDate = date("F d, Y");
        
        // Loop through each article in the database
        while($data = $result->fetchArray()){
            // Format start and end dates of the article
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
    }
?>