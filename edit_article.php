<?php
    

    include('templates/header.php');    
    include('utils.php');

    
    if (!isset($_SESSION["userName"])) {
        header("Location: login.php");
        exit();
    }



    $db = getDatabase();















    $db->close();

    include('templates/footer.php');
?>