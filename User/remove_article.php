<?php
    
    if (!isset($_SESSION["userName"])) {
        header("Location: https://3975blog-yujin-mitchell-evan.azurewebsites.net/User/login.php");
        exit();
    }



    $db = getDatabase();


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
        header("Location: https://3975blog-yujin-mitchell-evan.azurewebsites.net/User/profile.php");
        die();
    }

    
?>