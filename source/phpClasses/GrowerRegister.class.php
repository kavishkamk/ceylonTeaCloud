<?php

    // this class can use to admins and users
    class GrowerRegister{

        private $firstName;
        private $tele;
        private $mail;
        private $address;
        private $pwd;
        private $cpwd;

        public function __construct($firstName, $tele, $mail, $address, $pwd, $cpwd){
            $this->firstName = $firstName;
            $this->tele =$tele;
            $this->mail = $mail;
            $this->address = $address;
            $this->pwd = $pwd;
            $this->cpwd = $cpwd;
        }

        // check user input with given condition to user registration
        public function checkRegInput(){
            if(empty($this->firstName) || empty($this->tele) || empty($this->mail) || empty($this->address) || empty($this->pwd) || empty($this->cpwd)) {
                return 1;
            }
            else if(!filter_var($this->mail, FILTER_VALIDATE_EMAIL)){
                return 2;
            }
            else if(!preg_match("/^[0-9]*$/", $this->tele)){
                return 4;
            }
            else if($this->pwd != $this->cpwd){
                return 5;
            }
            else{
                return 0;
            }
        }

    }