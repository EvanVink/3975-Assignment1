<?php

    include('../utils.php');

    session_start();

    //Checking if the user is logged in
    if (!isset($_SESSION["userName"])) {
        header("Location: 401.php");
        exit();
    }

    $db = getDatabase();

    extract($_POST);


   

    $updateStatement = "UPDATE Article
    SET Title = ?, Body = ?, StartDate = ?, EndDate = ?
    WHERE ArticleId = ?";

    $preparedstmt = $db->prepare($updateStatement);
    $preparedstmt->bindParam(1, $title);
    $preparedstmt->bindParam(2, $body);
    $preparedstmt->bindParam(3, $startDate);
    $preparedstmt->bindParam(4, $endDate);
    $preparedstmt->bindParam(5, $Id);


    if ($preparedstmt->execute() == true){
        $db->close();
        header("Location: ../User/profile.php");
        die("successful update");
    } else {
        $db->close();
        header("Location: ../User/profile.php");
        die("error updating article");
    }


    


?>