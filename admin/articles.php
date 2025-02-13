<?php
    include '../templates/header.php';
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
    <!--
</head>
<body>

    <div class="container">
        <div class="box">
        <h3>Article 1</h3>
        <h5>John Doe, Feb 1, 2025</h5>
        <p>New tech breakthrough promises to revolutionize everyday life with AI-driven smart devices.
        A groundbreaking innovation in technology is set to transform daily routines through the power of AI-powered smart devices.
        <a href="../index.php">more...</a>
        </p>
        </div>
        <div class="box">
        <h3>Article 2</h3>
        <h5>John Doe, Feb 1, 2025</h5>
        <p>New tech breakthrough promises to revolutionize everyday life with AI-driven smart devices.
        A groundbreaking innovation in technology is set to transform daily routines through the power of AI-powered smart devices.
        <a href="../index.php">more...</a>
        </p>
        </div>
        <div class="box">
        <h3>Article 3</h3>
        <h5>John Doe, Feb 1, 2025</h5>
        <p>New tech breakthrough promises to revolutionize everyday life with AI-driven smart devices.
        A groundbreaking innovation in technology is set to transform daily routines through the power of AI-powered smart devices.
        <a href="../index.php">more...</a>
        </p>
        </div>
    </div>

</body> -->

<?php
// Connect to the SQLite3 database
$db = new SQLite3('../DB/BlogDB.db');

// Query to fetch all articles (using Body as the excerpt by truncating it)
$query = "SELECT ArticleId, Title, substr(Body, 1, 200) as Excerpt, CreateDate, ContributorUsername FROM Article";
$res = $db->query($query);

// Check if any articles exist and display them
if ($res) {
    while ($article = $res->fetchArray(SQLITE3_ASSOC)) {
        // Display each article
        echo "<div class='container'>";
        echo "<h2></h2>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($article['ContributorUsername']) . "</p>";
        echo "<p><strong>Created on:</strong> " . htmlspecialchars($article['CreateDate']) . "</p>";
        echo "<p><strong>Excerpt:</strong> " . nl2br(htmlspecialchars($article['Excerpt'])) . "</p>";  // Excerpt from Body
        echo "<a href='article.php?id=" . $article['ArticleId'] . "'>Read full article</a>";
        echo "</div><hr>";
    }
} else {
    echo "<p>No articles found.</p>";
}
?>




<?php
    include '../templates/footer.php';
?>