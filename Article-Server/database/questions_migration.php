<?php
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS questions (id AUTO_INCREMENT INT PRIMARY KEY,
                                                                            question VARCHAR(255),
                                                                            answer VARCHAR(255));");
    if(sql_utils::query_execution($query,"",[])){
        echo "QUESTIONS Table Created";
    }else{
        echo "QUESTIONS NOT Table Created";
    }
?>