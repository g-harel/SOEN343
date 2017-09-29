<?php

include_once(__DIR__ . "/../../dataModels/mappers/SessionMapper.php");
include_once(__DIR__ . "/../../dataModels/mappers/UserMapper.php");

class Login{

    private $userMapper;
    private $sessionMapper;
    private $email;
    private $password;

    public function __construct() {
        $this->userMapper = new UserMapper();
        $this->sessionMapper = new sessionMapper();
    }

    public function login($email, $password){

        $user = $this->userMapper->setUserFromRecordByEmail($email);
        
        if($user){
            $this->$email = $email;
            $this->password = $user->getPassword();
            $isAdmin = $user->getIsAdmin();
    
            if($password == $this->password){
                $this->sessionMappper = new SessionMapper();
                $this->sessionMapper->openSession($user);
                return $isAdmin;
            }
            else{
                return -1;
            }
        }
        else{
            return -1;
        }
    }

    public function validate(){ 
               
    }

    public function getSession(){
        
        
    }

    public function logout(){
        
        
    }
}


?>