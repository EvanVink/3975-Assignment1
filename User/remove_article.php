<?php

     
    include('../utils.php');

    session_start();
    
    if (!isset($_SESSION["userName"])) {
        header("Location: ../User/401.php");
        exit();
    }



    $db = getDatabase();

    if(!isset($_GET['id'])){
        header("Location: ../User/profile.php");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "DELETE FROM Article WHERE ArticleId = ?";

        if($preparedstmt = $db->prepare($query)){

            $preparedstmt->bindParam(1, $id);
            $preparedstmt->execute();

            $exec = $preparedstmt->execute();
            
        }

    }

    $db->close();


    if($exec == true){
        header("Location: ../User/profile.php");
        die();
    }

    
?>