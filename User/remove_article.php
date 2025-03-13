<?php

    // Include utility functions
    include('../utils.php');

    session_start();
    
    // Check if the user is logged in by verifying the session variable 'userName'
    if (!isset($_SESSION["userName"])) {
        // If not logged in, redirect to the 401 Unauthorized page
        header("Location: ../User/401.php");
        exit();
    }



    $db = getDatabase();

    // Check if the 'id' parameter is passed via GET request (ArticleId to delete)
    if(!isset($_GET['id'])){
        // If 'id' is not provided, redirect to the profile page
        header("Location: ../User/profile.php");
    }

    // If 'id' is set, proceed to delete the article with that ID
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // SQL query to delete the article by its ID
        $query = "DELETE FROM Article WHERE ArticleId = ?";

        // Prepare the SQL query
        if($preparedstmt = $db->prepare($query)){

            $preparedstmt->bindParam(1, $id);
            $preparedstmt->execute();

            $exec = $preparedstmt->execute();
            
        }

    }

    $db->close();


    // If the execution was successful, redirect to the user's profile page
    if($exec == true){
        header("Location: ../User/profile.php");
        die();
    }

    
?>