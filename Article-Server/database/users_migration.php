<?php
    $base = "..";
    require $base . "/connections/connection.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS users (id AUTO_INCREMENT INT PRIMARY KEY,
                                                                        email VARCHAR(255) NOT NULL UNIQUE,
                                                                        pass VARCHAR(255) NOT NULL,
                                                                        user_name VARCHAR(255) NOT NULL);");
    if(sql_utils::query_execution($query,"",[])){
        echo "USERS Table Created";
    }else{
        echo "USERS NOT Table Created";
    }

    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS questions (id AUTO_INCREMENT INT PRIMARY KEY,
                                                                        question VARCHAR(255),
                                                                        answer VARCHAR(255));");
    if(sql_utils::query_execution($query,"",[])){
        echo "QUESTIONS Table Created";
    }else{
        echo "QUESTIONS NOT Table Created";
    }
?>