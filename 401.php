<?php
    $displayNav = false;
    include('templates/header.php');    
    
    echo '<body>';

    echo '<div class="error-container">';

    echo '<h1 class="error401_h1">401</h1>';

    echo '<h2 class="error401_h2">Unauthorized Access!</h2>';

    echo '<p class="error401_p">You must be logged in to access the page</p>';

    echo '<div class="error401_btn_container">
            <a href="landing.php" class="btn btn-secondary error401_btn">Login/Sign-up</a>
          </div>';
          
    echo '</div>';

    echo '</body>';
    
    include('templates/footer.php');
?>