<?php
    $base = "..";
    require $base."/connections/connection.php";
    require $base . "/utils.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS questions (id INT AUTO_INCREMENT PRIMARY KEY,
                                                                            question VARCHAR(255),
                                                                            answer VARCHAR(255));");
    if(sql_utils::query_execution($query,"",[])){
        echo "QUESTIONS Table Created";
    }else{
        echo "QUESTIONS NOT Table Created";
    }
?>