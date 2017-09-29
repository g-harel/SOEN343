<?php

include_once(__DIR__ . "/../../dataModels/mappers/SessionMapper.php");
include_once(__DIR__ . "/../../dataModels/mappers/UserMapper.php");

class Login{

    private $userMapper;
    private $sessionMapper;
    private $email;
    private $password;
	private $user;

    public function __construct() {
        $this->userMapper = new UserMapper();
        $this->sessionMapper = new sessionMapper();
    }

    public function login($email, $password){

		$userTemp = $this->userMapper->setUserFromRecordByEmail($email);
		
        if(($this->validate($email, $password)) >= 0)
		{
			$this->user = $userTemp;
		}
		else {
			$user = null;
		}
    }

    public function validate($email, $password)
	{ 
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

    public function getSession(){
		$session = $this->sessionMapper->$openSession($user);
        return $session;
        
    }

    public function logout(){
        
        
    }
}


?>