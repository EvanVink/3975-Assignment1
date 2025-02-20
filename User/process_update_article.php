<?php
    // Include utility functions
    include('../utils.php');

    session_start();

    //Checking if the user is logged in
    if (!isset($_SESSION["userName"])) {
        header("Location: ../User/401.php");
        exit();
    }

    $db = getDatabase();

    // Extract the variables from the POST data for easier use (e.g. $title, $body, etc.)
    extract($_POST);


   
    // SQL query to update the article with the provided data
    $updateStatement = "UPDATE Article
    SET Title = ?, Body = ?, StartDate = ?, EndDate = ?
    WHERE ArticleId = ?";

    // Prepare the SQL statement to prevent SQL injection
    $preparedstmt = $db->prepare($updateStatement);
    $preparedstmt->bindParam(1, $title);
    $preparedstmt->bindParam(2, $body);
    $preparedstmt->bindParam(3, $startDate);
    $preparedstmt->bindParam(4, $endDate);
    $preparedstmt->bindParam(5, $Id);


    // Execute the prepared statement
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