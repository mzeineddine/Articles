<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "articles";
    $conn = new mysqli($host,$user,$pass,$db_name);
    if($conn->error){
        die();
    }
?>