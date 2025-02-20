<?php
include '../templates/header.php';
if (!isset($_SESSION["userName"])) {
    header("Location: login.php");
    exit();
}
$userRole = $_SESSION["role"];
if ($userRole != "Admin") {
    header("Location: ../User/401.php");
    exit();
}
$db = new SQLite3('../DB/BlogDB.db');


if (isset($_GET['ArticleId'])) { 
    $article = $_GET['ArticleId'];

    $stm = $db->prepare('SELECT * FROM Article WHERE ArticleId = ?');
    $stm -> bindValue(1, $article, SQLITE3_INTEGER);

    $res = $stm->execute();

    if ($res) {
        $article = $res->fetchArray(SQLITE3_ASSOC);     
        echo "<div class='container'>";
        echo "<h2>" . htmlspecialchars($article['Title']) . "</h2>";
        echo "<p>" . htmlspecialchars($article['ContributorUsername']) . ", " . htmlspecialchars($article['CreateDate']) . "</p>";
        echo "<p>" . nl2br($article['Body']) . "</p>"; //! Deleted htmlspecialchars to allow html tags
        echo "</div><hr>";
    } else {
        echo "<p>No article found.</p>";
    }
    

}

include '../templates/footer.php';

?>