<?php

    $db = new SQLite3('BlogDB.db');

    $password = 'P@$$w0rd';

    $SQL_create_table_user = "CREATE TABLE IF NOT EXISTS Users
    (
        Username VARCHAR(50) NOT NULL,
        Password VARCHAR(100) NOT NULL,
        FirstName VARCHAR(30) NOT NULL,
        LastName VARCHAR(30) NOT NULL,
        RegistrationDate DATE NOT NULL,
        isApproved BOOLEAN NOT NULL,
        Role TEXT NOT NULL,
        PRIMARY KEY (Username)
    )";

    $SQL_create_table_article = "CREATE TABLE IF NOT EXISTS Article
    (
        ArticleId Integer PRIMARY KEY,
        Title VARCHAR(255) NOT NULL,
        Body Text NOT NULL,
        CreateDate DATE NOT NULL,
        StartDate DATE NOT NULL,
        EndDate DATE NOT NULL,
        ContributorUsername VARCHAR(50) NOT NULL,
        FOREIGN KEY (ContributorUsername) REFERENCES Users(Username)
    )";

    $db->exec($SQL_create_table_user);
    $db->exec($SQL_create_table_article);

    $insert_data = "INSERT INTO Users (Username, Password, FirstName, LastName, RegistrationDate, isApproved, Role)
        VALUES
        ('a@a.a', '$password', 'a', 'a', '2025-12-2', 'TRUE', 'admin'),
        ('c@c.c', '$password', 'c', 'c', '2025-12-2', 'FALSE', 'contributor')
    ";

    $db->exec($insert_data);

    echo "THIS WORKED!!!";

    $db->close();


?>