<?php
    $displayNav = false;
    include('templates/header.php');

    echo '<body>';

    echo '<h1 class="landing_h1">THE BLOG</h1>';

    echo '<div class="landing_btn_container">
            <a href="login.php" class="btn btn-secondary landing_login_btn">Login</a>
            <a href="signup.php" class="btn btn-secondary landing_signup_btn">Sign-up</a>
          </div>';

    echo '</body>';

    include('templates/footer.php');
?>