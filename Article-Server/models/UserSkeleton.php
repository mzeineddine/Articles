<?php
    class User{
        private $user_name;
        private $email;
        private $pass;
        function __construct($user, $email,$pass){
            $this->user_name = $user;
            $this->email = $email;
            $this->$pass = $pass;
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

        function set_user_name($user_name){
            $this->user_name = $user_name;
        }
        function set_email($email){
            $this->email = $email;
        }
        function set_pass($pass){
            $this->pass = $pass;
        }
    }  
?>