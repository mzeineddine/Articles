<?php
    $base = "..";
    require $base."/connections/connection.php";
    $query = $conn->prepare("CREATE TABLE IF NOT EXISTS questions (id INT AUTO_INCREMENT PRIMARY KEY,
                                                                            question VARCHAR(255),
                                                                            answer VARCHAR(255));");
    if ($query->execute()) {
        echo "QUESTIONS Table Created";
        return true;
    }else {
        echo "QUESTIONS NOT Table Created";
        return false;
    }
?>