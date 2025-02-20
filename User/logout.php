<?php
    //starting and destroying session
    session_start();
    session_destroy();

    //redirecting to index page
    header("Location: ../index.php");
    exit();

?>