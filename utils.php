<?php

    //This function is used to sanitize the input data and prevents SQL injection.
    function sanitize_input($data) {
        $data = trim($data);    //Removes leading and trailing whitespaces
        $data = stripslashes($data);    //Removes backslashes
        $data = htmlspecialchars($data);    //Converts special characters into HTML entities
        
        return $data;
    }


    //Function to connect to 'BlogDB.db' database.
    function getDatabase() {
        
        $dbPath = __DIR__ . '/DB/BlogDB.db';

        //Creating database if it doesn't exist.
        $db = new SQLite3($dbPath);

        if (!$db) {
            die("Connection failed: " . $db->lastErrorMsg());
        }

        return $db;
    }
    
?>