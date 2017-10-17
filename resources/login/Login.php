<?php

use App\Mappers\UserMapper;
use App\Mappers\SessionMapper;

class Login{

    private $userMapper;
    private $sessionMapper;
    private $email;
    private $password;

    public function __construct($email, $password) {

        $this->userMapper = new UserMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate()
	{ 
		$user = $this->userMapper->setUserFromRecordByEmail($this->email)->getUser();
	
		if($user){;
            $password = $user->getPassword();
            $isAdmin = $user->getIsAdmin();
            if($password == $this->password){
                $this->sessionMapper = SessionMapper::openSession($user);
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