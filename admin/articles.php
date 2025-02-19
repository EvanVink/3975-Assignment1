<?php
    include '../templates/header.php';
    include("../utils.php");
    if (!isset($_SESSION["userName"])) {
        header("Location: login.php");
        exit();
    }

?>
<style>
         .container {
            display: flex;
            flex-direction: column;
            border: 1px solid #000;
            padding: 10px;
        }

        .box {
            margin-bottom: 10px;
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }

        .box:last-child {
            margin-bottom: 0;
        }

        a {
            text-decoration: none;
        }

        body {
            padding-bottom: 50px;
        }

    </style>


<?php

$db = getDatabase();

$query = "SELECT ArticleId, Title, substr(Body, 1, 100) as Excerpt, CreateDate, ContributorUsername FROM Article";
$res = $db->query($query);

if ($res) {
    while ($article = $res->fetchArray(SQLITE3_ASSOC)) {
        echo "<div class='container'>";
        echo "<h2>" . htmlspecialchars($article['Title']) . "</h2>";
        echo "<p>" . htmlspecialchars($article['ContributorUsername']) . ", " . htmlspecialchars($article['CreateDate']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($article['Excerpt']));  
        echo "<a href='show_article.php?ArticleId={$article['ArticleId']}'> more...</a></p>";
        echo "</div><hr>";

    }
} else {
    echo "<p>No articles found.</p>";
}
?>




<?php
    include '../templates/footer.php';
?>