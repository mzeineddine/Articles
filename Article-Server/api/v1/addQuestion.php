<?php
    $base = "../..";
    require $base . "/connections/connection.php";
    require $base . "/models/Question.php";
    require $base . "/utils.php";

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(data_utils::missing_parm(2,$data, ["question","answer"])){
        $question = $data["question"];
        $answer = $data["answer"];  
        if(Question::create_question($question,$answer,$conn)){
            echo json_encode(["result"=>true]);
            echo json_encode(["message"=>"Question added successfully"]);
            return;
        } else{
            echo json_encode(["result"=>false]);
            echo json_encode(["message"=>"Question not added"]);
            return;
        }
    } else{
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"Both question and answer have to be filled"]);
        return;
    }
?>