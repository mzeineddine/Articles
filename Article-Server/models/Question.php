<?php
    class Question{
        static function create_question($question,$answer,$conn){
            $query = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?,?)");
            if(sql_utils::query_execution($query, "ss", [$question,$answer])){
                return $query->affected_rows>0;
            }else return false;
        }

        static function get_questions_answers($conn){
            $query = $conn->prepare("SELECT * FROM questions WHERE true");
            if(sql_utils::query_execution($query, "", [])){
                $result = $query->get_result();
                $questions = [];
                while($question_db = mysqli_fetch_assoc($result)){
                    $question = new QuestionSkeleton($question_db['question'], $question_db['answer']);
                    $questions[] = $question->toArray();
                } return $questions;    
            }
        }
    }
?>