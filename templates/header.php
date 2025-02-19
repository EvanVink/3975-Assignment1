<?php
    session_start();
    //!Created disable nav bar for landing page.
    $displayNav = isset($displayNav) ? $displayNav : true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
    <title>The Blog</title>
</head>

<?php if ($displayNav): ?>
<header>
<nav class="navbar">
    <div class="nav-container">

        <?php
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
                echo '<a class="navbar-brand" href="../admin/admin_page.php">
                    <span class="blog-title">THE BLOG</span>
                </a>';
            } else {
                echo '<a class="navbar-brand" href="../index.php">
                    <span class="blog-title">THE BLOG</span>
                </a>';
            }
        ?>


        <ul class="nav-menu">
            <?php
            if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
                echo '<li><a href="../admin/admin_page.php">User List</a></li>';
                echo '<li><a href="../admin/articles.php">Article</a></li>';
                echo '<li><a href="../User/createArticle.php">Create Article</a></li>';
                echo '<li><a href="../User/logout.php">Logout</a></li>';
            } else {
                echo '<li><a href="../index.php">Article</a></li>';
                echo '<li><a href="../User/createArticle.php">Create Article</a></li>';
                echo '<li><a href="../User/profile.php">Profile</a></li>';
                echo '<li><a href="../User/logout.php">Logout</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
</header>
<?php endif; ?>