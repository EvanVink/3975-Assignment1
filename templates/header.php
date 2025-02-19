<?php
    //!Created disable nav bar for landing page.
    $displayNav = isset($displayNav) ? $displayNav : true;
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!--Bootstrap CDN--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <title>The Blog</title>
</head>    
<?php if ($displayNav): ?>
<header>
    <div class="logo">
        <h1>THE BLOG</h1>
    </div>

        <nav>

            <?php

            session_start();

                if($_SESSION["role"] == "admin"){

                    echo "
                    <ul class='nav-links'>
                        <li><a href='../index.php'>Articles</a></li>
                        <li><a href='../profile.php'>Profile</a></li>
                        <li><a href='../logout.php'>Log Out</a></li>
                        <li><a href='/admin/admin_page.php'>Admin page (for testing)</a></li>
                        <li><a href='/admin/articles.php'>Admin Articles (for testing)</a></li>
                        <li><a href='/DB/seed.php'>Seed data (for testing)</a></li>
                    </ul>
                    ";
                } else {
                    
                    echo "

                    <ul class='nav-links'>
                        <li><a href='../index.php'>Articles</a></li>
                        <li><a href='../profile.php'>Profile</a></li>
                        <li><a href='../logout.php'>Log Out</a></li>
                    </ul>
                    ";
                }

            ?>


        </nav>
<?php endif; ?>
</header>
