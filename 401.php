<?php
    include('templates/header.php');

    echo '<h1 class="error401_h1">401</h1>';
    echo '<h2 class="error401_h2">Unauthorized Access!</h2>';
    echo '<p class="error401_p">You must be logged in to access the page</p>';
    echo '<a href="landing.php">Login</a>';

    include('templates/footer.php');
?>