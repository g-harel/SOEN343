<?php

include_once(__DIR__ . "/../../dataModels/mappers/SessionMapper.php");
include_once(__DIR__ . "/../../dataModels/mappers/UserMapper.php");

class Login{

    private $userMapper;
    private $sessionMapper;
    private $email;
    private $password;
<<<<<<< HEAD
    
    public function __construct($email, $password) {
=======
	private $user;

    public function __construct() {
>>>>>>> 3ce55c9c5cb256b2369e6347008f61fc355e182b
        $this->userMapper = new UserMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate(){ 

<<<<<<< HEAD
        $user = $this->userMapper->setUserFromRecordByEmail($this->email)->getUser();
        
        if($user){
            $password = $user->getPassword();
            $isAdmin = $user->getIsAdmin();  
=======
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
    
>>>>>>> 3ce55c9c5cb256b2369e6347008f61fc355e182b
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
<<<<<<< HEAD

=======
               
>>>>>>> 3ce55c9c5cb256b2369e6347008f61fc355e182b
    }

    public function getSession(){
		$session = $this->sessionMapper->$openSession($user);
        return $session;
        
    }

    public function logout(){
        
        
    }
}


?>