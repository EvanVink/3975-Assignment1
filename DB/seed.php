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
    

    // $db->exec($insert_data);

    $insert_data = "INSERT INTO Article (ArticleId, Title, Body, CreateDate, StartDate, EndDate, ContributorUsername)
    VALUES
    (1, 'Introduction to PHP', '
        PHP (Hypertext Preprocessor) is a popular server-side scripting  
    language used primarily for web development. It allows developers  
    to create dynamic and interactive web pages by embedding scripts  
    within HTML. PHP is known for its simplicity, flexibility, and  
    compatibility with various databases, making it a powerful tool  
    for building web applications. With built-in support for handling  
    forms, sessions, and file uploads, PHP simplifies common web  
    development tasks. Its extensive library of functions and  
    frameworks, such as Laravel and CodeIgniter, further enhances its  
    capabilities, making it a preferred choice for developers  
    worldwide.  

    One of PHP’s key strengths is its ability to work seamlessly  
    with databases like MySQL, PostgreSQL, and SQLite. By using SQL  
    queries within PHP scripts, developers can retrieve, modify, and  
    manage data efficiently. PHP also supports object-oriented  
    programming (OOP), allowing for better code organization and  
    reusability. Additionally, PHP’s active community provides  
    continuous updates, security patches, and resources to help  
    developers stay up to date with the latest best practices.  
    Whether building a simple blog or a complex web application,  
    PHP remains a versatile and powerful choice for modern web  
    development.', '2025-02-12', '2025-02-12', '2025-02-13', 'John Doe'),
    (2, 'Exploring SQLite Databases', 'In this article, we delve into SQLite databases and how to interact with them using PHP', '2025-02-12', '2025-02-12', '2025-02-14', 'Jane Smith'),
    (3, 'CSS for Beginners', 'A guide to getting started with CSS, including styling text, backgrounds, and layout', '2025-02-13', '2025-02-13', '2025-02-15', 'Alex Johnson'),
    (4, 'Advanced JavaScript Techniques', 'This article explores advanced JavaScript features such as closures, promises, and async/await', '2025-02-14', '2025-02-14', '2025-02-16', 'Mary Brown'),
    (5, 'Building Responsive Websites', 'Learn how to create websites that adapt to different screen sizes using media queries and flexible grids', '2025-02-15', '2025-02-15', '2025-02-17', 'David Wilson');";

    $delete_data = "DELETE FROM Article";
    $db->exec($delete_data);

    $db->exec($insert_data);


    echo "THIS WORKED!!!";

    $db->close();


?>