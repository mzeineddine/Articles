<?php
    $base = "../..";
    require $base . "/connections/connection.php";
    require $base . "/models/User.php";
    require $base . "/models/UserSkeleton.php";
    require $base . "/utils.php";

    if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    if(data_utils::missing_parm(2,$data, ["email","pass"])){
        $email = $data["email"];
        $pass = $data["pass"];
        $pass = hash("sha3-256", $pass);
        $user = User::get_user_by_email_and_pass($email,$pass,$conn);
        if($user){
            echo json_encode(["result"=>$user]);
            echo json_encode(["message"=>"User found"]);
            return;
        } else{
            echo json_encode(["result"=>false]);
            echo json_encode(["message"=>"User not found"]);
            return;
        }
    } else{
        echo json_encode(["result"=>false]);
        echo json_encode(["message"=>"Both email and password have to be filled"]);
        return;
    }
?>
