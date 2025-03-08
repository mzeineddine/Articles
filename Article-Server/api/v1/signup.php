<?php
    $base = "../..";
    require $base . "/connections/connection.php";

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(data_utils::missing_parm(3,$data, ["email","pass", "user_name"])){
        $email = $data["email"];
        $pass = $data["pass"];
        $pass = hash("sha3-256", $pass);
        $user_name = $data["user_name"];
        if(User::create_user($email,$pass,$user_name,$conn)){
            echo json_encode(["result"=>true]);
            echo json_encode(["message"=>"User added successfully"]);
            return;
        } else{
            echo json_encode(["result"=>false]);
            echo json_encode(["message"=>"User not added"]);
            return;
        }
    } else{
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"email, password and user name have to be filled"]);
        return;
    }
?>
