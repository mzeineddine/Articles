<?php
    $base = "../..";
    require $base . "/connections/connection.php";
    require $base . "/models/Question.php";
    require $base . "/models/QuestionSkeleton.php";
    require $base . "/utils.php";


    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    $questions = Question::get_questions_answers($conn);
    if(sizeof($questions)>0){
        echo json_encode(["result"=>$questions]);
        echo json_encode(["message"=>"Questions found"]);
        return;
    } else{
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"No questions found"]);
        return;
    }

?>