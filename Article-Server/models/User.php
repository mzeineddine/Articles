<?php
    class User{
        static function create_user($email,$pass,$user_name,$conn){
            $query = $conn->prepare("INSERT INTO users (email,pass,user_name) VALUES (?,?,?)");
            if(sql_utils::query_execution($query, "sss", [$email,$pass,$user_name])){
                return $query->affected_rows>0;
            }else return false;
        }

        static function get_user_by_email_and_pass($email,$pass,$conn){
            $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND pass = ?");
            if(sql_utils::query_execution($query, "ss", [$email,$pass])){
                $result = $query->get_result();
                $user = null;
                while($user_db = mysqli_fetch_assoc($result)){
                    $user = new UserSkeleton($user_db['user_name'], $user_db['email'], $user_db['pass'],$user_db['id']);
                } return $user;
            }
        }
    }
?>