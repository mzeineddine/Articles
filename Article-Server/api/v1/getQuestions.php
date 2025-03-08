<?php
    $base = "../..";
    require $base . "/connections/connection.php";

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    $questions = Question::get_questions_answers($conn);
    if(sizeof($questions)>0){
        echo json_encode(["result"=>true]);
        echo json_encode(["message"=>"Questions found"]);
        return;
    } else{
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"No questions found"]);
        return;
    }

?>