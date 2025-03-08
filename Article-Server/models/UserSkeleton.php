<?php
    class UserSkeleton{
        private $user_name;
        private $email;
        private $pass;
        private $id;
        function __construct($user, $email,$pass,$id = -1){
            $this->user_name = $user;
            $this->email = $email;
            $this->pass = $pass;
            $this->id = $id;
        }
        function get_user_name(){
            return $this->user_name;
        }
        function get_email(){
            return $this->email;
        }
        function get_pass(){
            return $this->pass;
        }

        function get_id(){
            return $this->id;
        }

        function set_user_name($user_name){
            $this->user_name = $user_name;
        }
        function set_email($email){
            $this->email = $email;
        }
        function set_pass($pass){
            $this->pass = $pass;
        }

        function set_id($id){
            $this->id = $id;
        }
        function toArray() {
            return get_object_vars($this);
        }
    }  
?>